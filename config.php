<?php
// Database configuration
$conn = new mysqli("localhost", "root", "", "shop_giay");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>