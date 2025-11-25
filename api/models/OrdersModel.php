<?php

require_once "./config/db.php";

class OrderItemsModel {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // 1) Haal alle artikelen per order op
    public function getItemsByOrderId($id) {
        $query = "
            SELECT orderrules.*, parts.part, parts.sell_price 
            FROM orderrules
            JOIN parts ON parts.id = orderrules.part_id
            WHERE orderrules.order_id = ?
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2) Update artikelen + packed status
    public function updateItems($order_id, $items) {

        foreach ($items as $item) {

            $query = "
                UPDATE orderrules
                SET part_id = ?, packed = ?
                WHERE id = ? AND order_id = ?
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->execute([
                $item["part_id"],
                $item["packed"],
                $item["id"],
                $order_id
            ]);
        }

    }

}
