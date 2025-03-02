<?php
// Include the Database configuration file to establish a connection
require_once 'Database.php';
require_once 'user.php';

class Application
{
    private $conn;
    private $table = "applications";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function apply($nationalId, $businessName, $businessType, $businessAddress, $taxCertificate, $nationalIdFile, $healthReportFile, $taxClearanceFile, $amount)
    {
        $uploadDir = "uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        function sanitizeFileName($filename)
        {
            return preg_replace("/[^a-zA-Z0-9\._-]/", "_", $filename);
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $files = [
            'nationalIdFile' => $nationalIdFile,
            'healthReportFile' => $healthReportFile,
            'taxClearanceFile' => $taxClearanceFile
        ];

        $filePaths = [];
        foreach ($files as $key => $file) {
            if (!isset($file['name']) || empty($file['name']) || !isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
                error_log("Invalid or missing file for $key.");
                return false;
            }

            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                error_log("Invalid file type for $key: " . $fileExtension);
                return false;
            }

            if ($file['size'] > 5 * 1024 * 1024) {
                error_log("File size exceeds limit for $key.");
                return false;
            }

            $filePath = $uploadDir . sanitizeFileName(basename($file['name']));
            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                error_log("File upload error for $key.");
                return false;
            }
            $filePaths[$key] = $filePath;
        }

        if (count($filePaths) !== 3) {
            error_log("File upload issue: Not all files were stored.");
            return false;
        }

        $stmt = $this->conn->prepare("INSERT INTO $this->table (user_id, nationalId, businessName, businessType, businessAddress, taxCertificate, nationalIdFile, healthReportFile, taxClearanceFile, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->conn->error);
            $this->conn->close();
            return false;
        }

        $stmt->bind_param(
            "sssssssssi",
            $_SESSION['user']['user_id'],
            $nationalId,
            $businessName,
            $businessType,
            $businessAddress,
            $taxCertificate,
            $filePaths['nationalIdFile'],
            $filePaths['healthReportFile'],
            $filePaths['taxClearanceFile'],
            $amount
        );

        if ($stmt->execute()) {
            $stmt->close();
            $this->conn->close();
            return true;
        } else {
            error_log("Error executing statement: " . $stmt->error);
            $stmt->close();
            $this->conn->close();
            return false;
        }
    }

    public function getUserApplications()
    {
        $stmt = $this->conn->prepare("SELECT * FROM applications WHERE user_id = ?");
        $stmt->bind_param("s", $_SESSION['user']['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllApplications()
    {
        $stmt = $this->conn->prepare("SELECT a.*, u.fullname as business_owner FROM applications a INNER JOIN users u ON a.user_id = u.user_id");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function approveApplication($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET status='Approved' WHERE application_id=?");
        $stmt->bind_param("i", $application_id);
        return $stmt->execute();
    }

    public function rejectApplication($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET status='Rejected' WHERE application_id=?");
        $stmt->bind_param("i", $application_id);
        return $stmt->execute();
    }

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

    public function getTotalRevenue()
    {
        $query = "SELECT SUM(amount) as total FROM applications WHERE paymentStatus = 'Paid'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['total'];
    }

    public function getApprovedApplications()
    {
        $query = "SELECT a.*, u.fullname as business_owner FROM applications a INNER JOIN users u ON a.user_id = u.user_id WHERE a.status = 'Approved'";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function verifyPaymentStatus($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET verificationStatus='paidVerified' WHERE application_id=?");
        $stmt->bind_param("i", $application_id);
        return $stmt->execute();
    }

    public function getNewPaymentsCount() {
        $query = "SELECT COUNT(*) as count FROM applications WHERE paymentStatus = 'Pending'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['count'];
    }

    public function getVerifiedPaymentsCount() {
        $query = "SELECT COUNT(*) as count FROM applications WHERE paymentStatus = 'Paid'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['count'];
    }

    public function getFailedPaymentsCount() {
        $query = "SELECT COUNT(*) as count FROM applications WHERE paymentStatus = 'Not Paid'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['count'];
    }

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
}
