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

    public function apply($nationalId, $businessName, $businessType, $businessAddress, $taxCertificate, $nationalIdFile, $healthReportFile, $taxClearanceFile)
    {
        // Define the upload directory
        $uploadDir = "uploads/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        

        // Process and move uploaded files
        $nationalIdPath = $uploadDir . basename($nationalIdFile['name']);
        $healthReportPath = $uploadDir . basename($healthReportFile['name']);
        $taxClearancePath = $uploadDir . basename($taxClearanceFile['name']);

        if (!move_uploaded_file($nationalIdFile['tmp_name'], $nationalIdPath) ||
            !move_uploaded_file($healthReportFile['tmp_name'], $healthReportPath) ||
            !move_uploaded_file($taxClearanceFile['tmp_name'], $taxClearancePath)) {
            error_log("[" . date('Y-m-d H:i:s') . "] File upload error.");
            return false; // Stop execution if files fail to upload
        }

        // Prepare the SQL statement with new file path columns
        $stmt = $this->conn->prepare("INSERT INTO $this->table 
            (user_id, nationalId, businessName, businessType, businessAddress, taxCertificate, nationalIdFile, healthReportFile, taxClearanceFile) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the user inputs and file paths to the prepared statement
        $stmt->bind_param("sssssssss", 
            $_SESSION['user']['user_id'], 
            $nationalId, 
            $businessName, 
            $businessType, 
            $businessAddress, 
            $taxCertificate, 
            $nationalIdPath, 
            $healthReportPath, 
            $taxClearancePath
        );

        // Execute the statement and check if the operation was successful
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement
            return true; // Application successful
        } else {
            error_log("[" . date('Y-m-d H:i:s') . "] Error: " . $stmt->error . " - Query: " . $stmt->sqlstate);
            $stmt->close(); // Close the statement
            return false; // Application failed
        }
    }

    public function getUserApplications()
    {
        // Prepare an SQL statement to select the user with the provided email
        $stmt = $this->conn->prepare("SELECT * FROM applications WHERE user_id = ?");

        // Bind the id parameter to the statement
        $stmt->bind_param("s", $_SESSION['user']['user_id']);

        // Execute the statement
        $stmt->execute();

        // Get the result set from the executed statement
        $result = $stmt->get_result();

        $applications = [];
        // Fetch the data as an associative array
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
        return $applications;
    }

    public function getAllApplications()
    {
        // Prepare an SQL statement to select all applications with user details
        $stmt = $this->conn->prepare("SELECT a.*, u.fullname as business_owner FROM applications a INNER JOIN users u ON a.user_id = u.user_id");

        // Execute the statement
        $stmt->execute();

        // Get the result set from the executed statement
        $result = $stmt->get_result();

        $applications = [];
        // Fetch the data as an associative array
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
        return $applications;
    }

    public function approveApplication($application_id)
    {
        // Prepare an SQL statement to update the application status
        $stmt = $this->conn->prepare("UPDATE applications SET status='Approved' WHERE application_id=?");

        // Bind the application_id parameter to the statement
        $stmt->bind_param("s", $application_id);

        // Execute the statement
        return $stmt->execute();
    }

    public function rejectApplication($application_id)
    {
        // Prepare an SQL statement to update the application status
        $stmt = $this->conn->prepare("UPDATE applications SET status='Rejected' WHERE application_id=?");

        // Bind the application_id parameter to the statement
        $stmt->bind_param("s", $application_id);

        // Execute the statement
        return $stmt->execute();
    }
}
