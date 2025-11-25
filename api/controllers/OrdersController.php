<?php
// ...existing code...
<?php

require_once __DIR__ . "/../models/OrdersModel.php";
require_once __DIR__ . "/../models/OrderItemsModel.php";

class OrdersController {

    // 1) Haal alle orders op
    public function getAllOrders() {
        $model = new OrdersModel();
        $orders = $model->getAllOrders();

        header('Content-Type: application/json');
        echo json_encode($orders);
    }


    // 2) Haal 1 order + items op
    public function getOrderById($id) {

        $ordersModel = new OrdersModel();
        $itemsModel = new OrderItemsModel();

        $order = $ordersModel->getOrderById($id);
        $items = $itemsModel->getItemsByOrderId($id);

        header('Content-Type: application/json');
        echo json_encode([
            "order" => $order,
            "items" => $items
        ]);
    }


    // 3) Update klantgegevens
    public function updateCustomer($id) {

        $data = json_decode(file_get_contents("php://input"), true);
        $model = new OrdersModel();

        $model->updateCustomer($id, $data);

        header('Content-Type: application/json');
        echo json_encode(["message" => "Customer updated"]);
    }


    // 4) Update artikelen in order
    public function updateItems($id) {

        $data = json_decode(file_get_contents("php://input"), true);
        $model = new OrderItemsModel();

        $model->updateItems($id, $data);

        header('Content-Type: application/json');
        echo json_encode(["message" => "Items updated"]);
    }

}
 // ...existing code...