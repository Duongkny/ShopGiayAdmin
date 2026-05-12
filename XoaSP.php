<?php
include "config.php";

if(!isset($_GET['MaSP'])){
    echo "Không có sản phẩm";
    exit();
}

$MaSP = $_GET['MaSP'];

// ===== 1. XÓA DỮ LIỆU LIÊN QUAN =====

// xóa trong giỏ hàng
$conn->query("DELETE FROM cart WHERE MaSP='$MaSP'");

// xóa trong chi tiết đơn hàng
$conn->query("DELETE FROM order_details WHERE MaSP='$MaSP'");


// ===== 2. XÓA ẢNH =====
$sql = "SELECT image FROM products WHERE MaSP='$MaSP'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row){
    $file = "img/" . $row['image'];
    if(file_exists($file)){
        unlink($file);
    }
}


// ===== 3. XÓA SẢN PHẨM =====
$sqlDelete = "DELETE FROM products WHERE MaSP='$MaSP'";

if($conn->query($sqlDelete)){
    echo "<script>alert('Xóa thành công'); window.location='QuanLySanPham.php';</script>";
} else {
    echo "Lỗi: " . $conn->error;
}
?>