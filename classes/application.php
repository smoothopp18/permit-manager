<?php
// Include the Database configuration file to establish a connection
require_once '../config/Database.php';

//application class to handle certificate application
class Application {
    // Property to store the database connection
    private $conn;
    // Property to define the users table name
    private $table = "applications";
    // Constructor to initialize the database connection when the application object is created
    public function __construct()
    {
        // Create a new Database object
        $database = new Database();

        // Establish a database connection and assign it to $conn
        $this->conn = $database->connect();
    }
    // Method to apply a new certificate
    public function apply($fullName, $nationalId, $businessName, $businessType, $businessAddress, $taxCertificate, $uploadNationalId, $uploadTaxCertificate, $uploadProofOfPremises, $uploadHealthSafetyReport)
    {
        // Prepare an SQL statement to insert application data into the applications table
        $stmt = $this->conn->prepare("INSERT INTO applications (fullName, nationalId, businessName, businessType, businessAddress, taxCertificate, uploadNationalId, uploadTaxCertificate, uploadProofOfPremises, uploadHealthSafetyReport) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the user inputs to the prepared statement to prevent SQL injection
        $stmt->bind_param("ssssssssss", $fullName, $nationalId, $businessName, $businessType, $businessAddress, $taxCertificate, $uploadNationalId, $uploadTaxCertificate, $uploadProofOfPremises, $uploadHealthSafetyReport);

        // Execute the statement and check if the operation was successful
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement
            return true; // Application successful
        } else {
            // Log the error and return false if insertion fails
            error_log("Error: " . $stmt->error);
            $stmt->close(); // Close the statement
            return false;
        }
    }
}