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
        $query = "INSERT INTO " . $this->table_name . " SET 
            payment_id = :payment_id, 
            amount = :amount, 
            payment_date = :payment_date, 
            permit_id = :permit_id";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $data['payment_id'] = htmlspecialchars(strip_tags($data['payment_id']));
        $data['amount'] = htmlspecialchars(strip_tags($data['amount']));
        $data['payment_date'] = htmlspecialchars(strip_tags($data['payment_date']));
        $data['permit_id'] = htmlspecialchars(strip_tags($data['permit_id']));

        // bind values
        $stmt->bindParam(":payment_id", $data['payment_id']);
        $stmt->bindParam(":amount", $data['amount']);
        $stmt->bindParam(":payment_date", $data['payment_date']);
        $stmt->bindParam(":permit_id", $data['permit_id']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read payment records
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update a payment record
    public function update($data) {
        $query = "UPDATE " . $this->table_name . " SET 
            amount = :amount, 
            payment_date = :payment_date, 
            permit_id = :permit_id 
            WHERE payment_id = :payment_id";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $data['payment_id'] = htmlspecialchars(strip_tags($data['payment_id']));
        $data['amount'] = htmlspecialchars(strip_tags($data['amount']));
        $data['payment_date'] = htmlspecialchars(strip_tags($data['payment_date']));
        $data['permit_id'] = htmlspecialchars(strip_tags($data['permit_id']));

        // bind values
        $stmt->bindParam(":payment_id", $data['payment_id']);
        $stmt->bindParam(":amount", $data['amount']);
        $stmt->bindParam(":payment_date", $data['payment_date']);
        $stmt->bindParam(":permit_id", $data['permit_id']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a payment record
    public function delete($payment_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE payment_id = :payment_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $payment_id = htmlspecialchars(strip_tags($payment_id));

        // bind value
        $stmt->bindParam(":payment_id", $payment_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>