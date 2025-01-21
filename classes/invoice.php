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
        // Define category price mapping
        $categoryPrices = [
            'business_premises' => 500,
            'food_licence' => 1000,
            'opaque_beer_licence' => 1500,
            'liquor_licence' => 2000,
        ];

        // Prepare query to fetch approved applications with required fields (fixed trailing comma)
        $stmt = $this->conn->prepare("
            SELECT 
                a.application_id, 
                u.fullname AS business_owner, 
                a.businessName, 
                a.businessAddress, 
                a.businessType 
            FROM applications a
            INNER JOIN users u ON a.user_id = u.user_id
            WHERE a.status = 'approved'
        ");

        if (!$stmt) {
            die("Query preparation failed: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $applications = [];
        while ($row = $result->fetch_assoc()) {
            // Assign category price dynamically
            $row['price'] = isset($categoryPrices[$row['businessType']]) ? $categoryPrices[$row['businessType']] : 0;
            $applications[] = $row;
        }

        return $applications;
    }
}
?>
