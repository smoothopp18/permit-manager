<?php
// Database connection class
class Database
{
    // Database host (server address)
    private $host = "localhost";

    // Database username
    private $username = "root";

    // Database password (empty by default for local setup)
    private $password = "";

    // Name of the database to connect to
    private $database = "permit_manager";

    // Public property to store the database connection object
    public $conn;

    // Method to establish a database connection
    public function connect()
    {
        // Creating a new MySQLi connection using the provided credentials
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check if the connection failed
        if ($this->conn->connect_error) {
            // Stop script execution and display the connection error
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Return the connection object if successful
        return $this->conn;
    }
}
