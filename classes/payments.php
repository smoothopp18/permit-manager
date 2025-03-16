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
        if (empty($data['business_type'])) {
            throw new Exception("Business type cannot be null");
        }

        $query = "INSERT INTO payments (application_id, user_id, nationalId, businessName, businessType, amount, businessAddress, taxCertificate, nationalIdFile, healthReportFile, taxClearanceFile, expiryDate, status, verificationStatus, paymentStatus, issueDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iisssissssssssss", $data['application_id'], $data['user_id'], $data['nationalId'], $data['businessName'], $data['business_type'], $data['amount'], $data['businessAddress'], $data['taxCertificate'], $data['nationalIdFile'], $data['healthReportFile'], $data['taxClearanceFile'], $data['expiryDate'], $data['status'], $data['verificationStatus'], $data['paymentStatus'], $data['issueDate']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
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
                  application_id = ?, 
                  user_id = ?, 
                  nationalId = ?, 
                  businessName = ?, 
                  businessType = ?, 
                  amount = ?, 
                  businessAddress = ?, 
                  taxCertificate = ?, 
                  nationalIdFile = ?, 
                  healthReportFile = ?, 
                  taxClearanceFile = ?, 
                  expiryDate = ?, 
                  status = ?, 
                  verificationStatus = ?, 
                  paymentStatus = ?, 
                  issueDate = ?
                  WHERE payment_id = ?";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $data['payment_id'] = htmlspecialchars(strip_tags($data['payment_id']));
        $data['application_id'] = htmlspecialchars(strip_tags($data['application_id']));
        $data['user_id'] = htmlspecialchars(strip_tags($data['user_id']));
        $data['nationalId'] = htmlspecialchars(strip_tags($data['nationalId']));
        $data['businessName'] = htmlspecialchars(strip_tags($data['businessName']));
        $data['business_type'] = htmlspecialchars(strip_tags($data['business_type']));
        $data['amount'] = htmlspecialchars(strip_tags($data['amount']));
        $data['businessAddress'] = htmlspecialchars(strip_tags($data['businessAddress']));
        $data['taxCertificate'] = htmlspecialchars(strip_tags($data['taxCertificate']));
        $data['nationalIdFile'] = htmlspecialchars(strip_tags($data['nationalIdFile']));
        $data['healthReportFile'] = htmlspecialchars(strip_tags($data['healthReportFile']));
        $data['taxClearanceFile'] = htmlspecialchars(strip_tags($data['taxClearanceFile']));
        $data['expiryDate'] = htmlspecialchars(strip_tags($data['expiryDate']));
        $data['status'] = htmlspecialchars(strip_tags($data['status']));
        $data['verificationStatus'] = htmlspecialchars(strip_tags($data['verificationStatus']));
        $data['paymentStatus'] = htmlspecialchars(strip_tags($data['paymentStatus']));
        $data['issueDate'] = htmlspecialchars(strip_tags($data['issueDate']));

        // Bind values
        $stmt->bind_param("iisssissssssssssi", $data['application_id'], $data['user_id'], $data['nationalId'], $data['businessName'], $data['business_type'], $data['amount'], $data['businessAddress'], $data['taxCertificate'], $data['nationalIdFile'], $data['healthReportFile'], $data['taxClearanceFile'], $data['expiryDate'], $data['status'], $data['verificationStatus'], $data['paymentStatus'], $data['issueDate'], $data['payment_id']);

        return $stmt->execute();
    }

    // Delete a payment record
    public function delete($payment_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE payment_id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $payment_id = htmlspecialchars(strip_tags($payment_id));

        // Bind value
        $stmt->bind_param("i", $payment_id);

        return $stmt->execute();
    }
}
?>
