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
        // Ensure user_id is set
        if (!isset($_SESSION['user']['user_id']) || empty($_SESSION['user']['user_id'])) {
            error_log("User ID is not set in session.");
            return false;
        }

        // Define the upload directory
        $uploadDir = "uploads/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Function to sanitize file names
        function sanitizeFileName($filename)
        {
            return preg_replace("/[^a-zA-Z0-9\._-]/", "_", $filename);
        }

        // Allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

        // Process and move uploaded files securely
        $files = [
            'nationalIdFile' => $nationalIdFile,
            'healthReportFile' => $healthReportFile,
            'taxClearanceFile' => $taxClearanceFile
        ];

        $filePaths = [];

        foreach ($files as $key => $file) {
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                error_log("Invalid file type for $key: " . $fileExtension);
                return false;
            }

            if ($file['size'] > 5 * 1024 * 1024) { // 5MB limit
                error_log("File size exceeds limit for $key.");
                return false;
            }

            $filePath = $uploadDir . sanitizeFileName(basename($file['name']));
            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                error_log("[" . date('Y-m-d H:i:s') . "] File upload error for $key.");
                return false;
            }
            $filePaths[$key] = $filePath;
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
            $filePaths['nationalIdFile'], 
            $filePaths['healthReportFile'], 
            $filePaths['taxClearanceFile']
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
        $stmt = $this->conn->prepare("SELECT * FROM applications WHERE user_id = ?");
        $stmt->bind_param("s", $_SESSION['user']['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
        return $applications;
    }

    public function getAllApplications()
    {
        $stmt = $this->conn->prepare("SELECT a.*, u.fullname as business_owner FROM applications a INNER JOIN users u ON a.user_id = u.user_id");
        $stmt->execute();
        $result = $stmt->get_result();

        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
        return $applications;
    }

    public function approveApplication($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET status='Approved' WHERE application_id=?");
        $stmt->bind_param("s", $application_id);
        return $stmt->execute();
    }

    public function rejectApplication($application_id)
    {
        $stmt = $this->conn->prepare("UPDATE applications SET status='Rejected' WHERE application_id=?");
        $stmt->bind_param("s", $application_id);
        return $stmt->execute();
    }
}
