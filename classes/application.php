<?php
// Include the Database configuration file to establish a connection
require_once 'Database.php';
require_once 'user.php';

class Application {
    private $conn;
    private $table = "applications";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function apply($nationalId, $businessName, $businessType, $businessAddress, $taxCertificate) {
        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO $this->table (user_id, nationalId, businessName, businessType, businessAddress, taxCertificate) VALUES (?,?, ?, ?, ?, ?)");

        // Bind the user inputs to the prepared statement to prevent SQL injection
        $stmt->bind_param("ssssss", $_SESSION['user']['user_id'], $nationalId, $businessName, $businessType, $businessAddress, $taxCertificate);

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
        while($row = $result->fetch_assoc() ) {
            $applications[] = $row;

        }
        return $applications; 
        
    }
}
?>
