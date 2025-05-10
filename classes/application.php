<?php
// Include the Database configuration file to establish a connection
require_once 'Database.php';
require_once 'User.php';
require_once 'business_type.php';
require_once 'session.php';
class Application
{
    private $conn;
    private $table = "applications";
    private $lastError;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Function to handle the application creation
    public function apply($nationalId, $businessName, $businessTypeId, $businessAddress, $taxCertificate, $nationalIdFile, $healthReportFile, $taxClearanceFile)
    {
        $bType = new BusinessType();
        $businessType = $bType->getBusinessTypeById($businessTypeId);
        
    
        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO $this->table (user_id, nationalId, businessName, businessType, businessAddress, taxCertificate, nationalIdFile, healthReportFile, taxClearanceFile, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->conn->error);
            $this->conn->close();
            return false;
        }

        $stmt->bind_param(
            "ssssssssss",
            $_SESSION['user']['user_id'],
            $nationalId,
            $businessName,
            $businessType['business_type_name'],
            $businessAddress,
            $taxCertificate,
            $nationalIdFile,
            $healthReportFile,
            $taxClearanceFile,
            $businessType['amount']
        );

        if ($stmt->execute()) {
            $stmt->close();
            $this->conn->close();
            return true;
        } else {
            $this->lastError = $stmt->error;
            echo($this->lastError);
            $stmt->close();
            $this->conn->close();
            return false;
        }
    }

    // Get all applications by a user
    public function getUserApplications()
    {
        $stmt = $this->conn->prepare("SELECT * FROM applications WHERE user_id = ?");
        $stmt->bind_param("s", $_SESSION['user']['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all applications with user details
    public function getAllApplications()
    {
        $stmt = $this->conn->prepare("SELECT a.*, u.fullname as business_owner FROM applications a INNER JOIN users u ON a.user_id = u.user_id");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Approve an application
    public function approveApplication($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET status='Approved' WHERE application_id=?");
        $stmt->bind_param("i", $application_id);
        return $stmt->execute();
    }

    // Reject an application
    public function rejectApplication($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET status='Rejected' WHERE application_id=?");
        $stmt->bind_param("i", $application_id);
        return $stmt->execute();
    }

    // Get the count of applications by status
    public function getCountByStatus($status)
    {
        $query = "SELECT COUNT(*) as count FROM applications WHERE status = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] ?? 0;
    }

    // Get the total revenue from paid applications
    public function getTotalRevenue()
    {
        $query = "SELECT SUM(amount) as total FROM applications WHERE paymentStatus = 'Paid'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['total'];
    }

    // Get approved applications
    public function getApprovedApplications()
    {
        $query = "SELECT a.*, u.fullname as business_owner FROM applications a INNER JOIN users u ON a.user_id = u.user_id WHERE a.status = 'Approved'";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Verify payment status
    public function verifyPaymentStatus($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET verificationStatus='paidVerified' WHERE application_id=?");
        $stmt->bind_param("i", $application_id);
        return $stmt->execute();
    }

    // Get count of new payments (Pending)
    public function getNewPaymentsCount()
    {
        $query = "SELECT COUNT(*) as count FROM applications WHERE paymentStatus = 'Pending'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['count'];
    }

    // Get count of verified payments (Paid)
    public function getVerifiedPaymentsCount()
    {
        $query = "SELECT COUNT(*) as count FROM applications WHERE paymentStatus = 'Paid'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['count'];
    }

    // Get count of failed payments (Not Paid)
    public function getFailedPaymentsCount()
    {
        $query = "SELECT COUNT(*) as count FROM applications WHERE paymentStatus = 'Not Paid'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['count'];
    }

    // Calculate approval rate
    public function getApprovalRate()
    {
        $totalApplicationsQuery = "SELECT COUNT(*) as total FROM applications";
        $approvedApplicationsQuery = "SELECT COUNT(*) as approved FROM applications WHERE status = 'Approved'";

        $totalResult = $this->conn->query($totalApplicationsQuery);
        $approvedResult = $this->conn->query($approvedApplicationsQuery);

        $totalApplications = $totalResult->fetch_assoc()['total'];
        $approvedApplications = $approvedResult->fetch_assoc()['approved'];

        if ($totalApplications == 0) {
            return 0;
        }

        return ($approvedApplications / $totalApplications) * 100;
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    public function updateCertificateStatus($application_id, $newStatus)
    {
        $allowedStatuses = ['certified', 'revoked'];
        if (!in_array($newStatus, $allowedStatuses)) {
            return false; // Invalid status
        }

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("UPDATE applications SET certificateStatus = ?, expiryDate = ?, issueDate = ? WHERE application_id = ?");
        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }

        // Set the dates based on the status
        $expiryDate = null;
        $issueDate = null;

        if ($newStatus === 'certified') {
            $issueDate = date('Y-m-d H:i:s'); // Current time
            $expiryDate = date('Y-m-d H:i:s', strtotime('+1 year')); // One year from now
        } elseif ($newStatus === 'revoked') {
            $issueDate = null; // No issue date for revoked
            $expiryDate = null; // No expiry date for revoked
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("sssi", $newStatus, $expiryDate, $issueDate, $application_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
?>
