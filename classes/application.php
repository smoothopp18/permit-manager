<?php
// Include the Database configuration file to establish a connection
require_once '../config/Database.php';

class Application {
    private $conn;
    private $table = "applications";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function apply($nationalId, $businessName, $businessType, $businessAddress, $taxCertificate) {
        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO $this->table (nationalId, businessName, businessType, businessAddress, taxCertificate) VALUES (?, ?, ?, ?, ?)");

        // Bind the user inputs to the prepared statement to prevent SQL injection
        $stmt->bind_param("sssss", $nationalId, $businessName, $businessType, $businessAddress, $taxCertificate);

        // Execute the statement and check if the operation was successful
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement
            return true; // Application successful
        } else {
            // Enhanced error logging with date and query information
            error_log("[" . date('Y-m-d H:i:s') . "] Error: " . $stmt->error . " - Query: " . $stmt->sqlstate);
            $stmt->close(); // Close the statement
            return false; // Application failed
        }
    }
}
?>
