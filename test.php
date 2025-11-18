<?php
require_once "./api/config/db.php";

$db = new Database();
$conn = $db->getConnection();

if($conn) {
    echo "Database verbinding werkt!";
}
