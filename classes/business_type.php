<?php
require_once 'Database.php';

class BusinessType
{
    private $conn;
    private $table = "business_types";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getBusinessTypes()
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBusinessTypeById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE business_type_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addBusinessType($name, $amount){
        $stmt = $this->conn->prepare("INSERT INTO $this->table (name, amount) VALUES (?,?)");
        $stmt->bind_param("sd", $name, $amount);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>