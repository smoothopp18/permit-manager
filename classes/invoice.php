<?php
require_once 'Database.php';
require_once 'user.php';
require_once 'application.php';

class Invoice
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getApprovedApplications()
    {
        // Prepare query to fetch approved applications excluding those with paymentStatus = 'Paid'
        $stmt = $this->conn->prepare("
            SELECT 
                a.*, 
                u.fullname AS business_owner,
                u.email
            FROM applications a
            INNER JOIN users u ON a.user_id = u.user_id
            WHERE a.status = 'Approved' AND (a.paymentStatus IS NULL OR a.paymentStatus != 'Paid')
        ");

        if (!$stmt) {
            die("Query preparation failed: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }

        return $applications;
    }
}
?>
