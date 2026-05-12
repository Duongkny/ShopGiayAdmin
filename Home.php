<?php
include 'config.php';
if (isset($_POST['ThemSP'])) {
    header("Location: ThemSP.php");
    exit();
} elseif (isset($_POST['SuaSP'])) {
    header("Location: SuaSP.php");
    exit();
} elseif (isset($_POST['XoaSP'])) {
    header("Location: XoaSP.php");
    exit();
}elseif (isset($_POST['ThongTin'])) {
    header("Location: ThongTinKhachHang.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Trang chủ</h1>
    <form action="" method="post">
        <button name="ThemSP">Thêm sản phẩm</button>
        <button name="SuaSP">Sửa sản phẩm</button>
        <button name="XoaSP">Xóa sản phẩm</button>
        <button name="ThongTin">Thông tin khách hàng</button>
    </form>
</body>
</html>