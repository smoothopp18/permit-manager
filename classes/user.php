<?php
// Include the Database configuration file to establish a connection
require_once '../config/Database.php';

// User class to handle user-related operations (registration and login)
class User
{
    // Property to store the database connection
    private $conn;

    // Property to define the users table name
    private $table = "users";

    // Constructor to initialize the database connection when the User object is created
    public function __construct()
    {
        // Create a new Database object
        $database = new Database();

        // Establish a database connection and assign it to $conn
        $this->conn = $database->connect();
    }

    // Method to register a new user
    public function register($fullname, $email, $password, $role)
    {
        // Securely hash the user's password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an SQL statement to insert user data into the users table
        $stmt = $this->conn->prepare("INSERT INTO $this->table (fullname, email, password, role) VALUES (?, ?, ?, ?)");

        // Bind the user inputs to the prepared statement to prevent SQL injection
        $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $role);

        // Execute the statement and check if the operation was successful
        if ($stmt->execute()) {
            return true; // Registration successful
        } else {
            // Stop execution and display an error if insertion fails
            die("Error: " . $stmt->error);
        }
    }

    // Method to log in a user
    public function login($email, $password)
    {
        // Prepare an SQL statement to select the user with the provided email
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE email = ?");

        // Bind the email parameter to the statement
        $stmt->bind_param("s", $email);

        // Execute the statement
        $stmt->execute();

        // Get the result set from the executed statement
        $result = $stmt->get_result();

        // Fetch the user data as an associative array
        $user = $result->fetch_assoc();

        // Check if the user exists
        if ($user) {
            // Verify the entered password against the hashed password in the database
            if (password_verify($password, $user['password'])) {
                return $user; // Password is correct; return user data
            } else {
                return false; // Incorrect password
            }
        } else {
            return false; // No user found with the provided email
        }
    }
}
