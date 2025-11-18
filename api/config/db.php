<?php

class Database {
    private $host = "localhost";
    private $db_name = "scootershop_vesuvio";   // jouw database naam
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";

            $this->conn = new PDO($dsn, $this->username, $this->password);

            // Foutmeldingen aanzetten
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Database verbinding mislukt: " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>
