<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Controllers inladen
require_once "./controllers/OrdersController.php";

$method = $_SERVER["REQUEST_METHOD"];
$request = trim($_SERVER["REQUEST_URI"], "/");

// Pad splitsen
$segments = explode("/", $request);

// Zoek naar 'api' in de URL
$apiIndex = array_search("api", $segments);

if ($apiIndex !== false) {
    $endpoint = $segments[$apiIndex + 1] ?? null;
    $id = $segments[$apiIndex + 2] ?? null;
    $subaction = $segments[$apiIndex + 3] ?? null;
} else {
    echo json_encode(["error" => "API pad niet gevonden"]);
    exit;
}

$orders = new OrdersController();

// ROUTES VOOR WEEK 1

// 1) GET /api/orders
if ($endpoint === "orders" && $method === "GET" && !$id) {
    $orders->getAllOrders();
    exit;
}

// 2) GET /api/orders/{id}
if ($endpoint === "orders" && $method === "GET" && $id) {
    $orders->getOrderById($id);
    exit;
}

// 3) PUT /api/orders/{id}/customer
if ($endpoint === "orders" && $method === "PUT" && $id && $subaction === "customer") {
    $orders->updateCustomer($id);
    exit;
}

// 4) PUT /api/orders/{id}/items
if ($endpoint === "orders" && $method === "PUT" && $id && $subaction === "items") {
    $orders->updateItems($id);
    exit;
}

echo json_encode(["error" => "Ongeldige route"]);



