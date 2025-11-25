<?php

require_once "./config/db.php";

class OrdersModel {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // 1) Haal alle orders op
    public function getAllOrders() {
        $query = "SELECT * FROM orders";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2) Haal één order op
    public function getOrderById($id) {
        $query = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3) Update klantgegevens
    public function updateCustomer($id, $data) {
        $query = "
            UPDATE orders SET
                company_name = :company_name,
                recipient = :recipient,
                addressline1 = :addressline1,
                addressline2 = :addressline2,
                country = :country,
                status = :status
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ":company_name" => $data["company_name"],
            ":recipient"    => $data["recipient"],
            ":addressline1" => $data["addressline1"],
            ":addressline2" => $data["addressline2"],
            ":country"      => $data["country"],
            ":status"       => $data["status"],
            ":id"           => $id
        ]);
    }

}
