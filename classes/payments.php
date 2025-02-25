<?php
require_once 'database.php';

class Payments {
    private $conn;
    private $table_name = "payments";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new payment record
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (application_id, user_id, businessType, paymentDate) 
                  VALUES (:application_id, :user_id, :businessType, NOW())";

        $stmt = $this->conn->prepare($query);

        // Sanitize input data
        $data['application_id'] = htmlspecialchars(strip_tags($data['application_id']));
        $data['user_id'] = htmlspecialchars(strip_tags($data['user_id']));
        $data['businessType'] = htmlspecialchars(strip_tags($data['businessType']));

        // Bind values
        $stmt->bindParam(":application_id", $data['application_id']);
        $stmt->bindParam(":user_id", $data['user_id']);
        $stmt->bindParam(":businessType", $data['businessType']);

        return $stmt->execute();
    }

    // Read all payment records
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update a payment record
    public function update($data) {
        $query = "UPDATE " . $this->table_name . " SET 
                  application_id = :application_id, 
                  user_id = :user_id, 
                  businessType = :businessType
                  WHERE payment_id = :payment_id";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $data['payment_id'] = htmlspecialchars(strip_tags($data['payment_id']));
        $data['application_id'] = htmlspecialchars(strip_tags($data['application_id']));
        $data['user_id'] = htmlspecialchars(strip_tags($data['user_id']));
        $data['businessType'] = htmlspecialchars(strip_tags($data['businessType']));

        // Bind values
        $stmt->bindParam(":payment_id", $data['payment_id']);
        $stmt->bindParam(":application_id", $data['application_id']);
        $stmt->bindParam(":user_id", $data['user_id']);
        $stmt->bindParam(":businessType", $data['businessType']);

        return $stmt->execute();
    }

    // Delete a payment record
    public function delete($payment_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE payment_id = :payment_id";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $payment_id = htmlspecialchars(strip_tags($payment_id));

        // Bind value
        $stmt->bindParam(":payment_id", $payment_id);

        return $stmt->execute();
    }
}
?>
