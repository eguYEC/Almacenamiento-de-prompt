<?php
$host = "localhost";
$database = "promptsi1";
$user = "root";      // por defecto en XAMPP
$password = "";      // por defecto vacío en XAMPP

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8mb4",
        $user,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
