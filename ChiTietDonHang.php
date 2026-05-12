<?php
include "config.php";

if (!isset($_GET['id'])) {
    echo "Không tìm thấy đơn hàng";
    exit();
}

$order_id = $_GET['id'];

/* LẤY THÔNG TIN ĐƠN HÀNG */

$sqlOrder = "SELECT * FROM orders
             WHERE id='$order_id'";

$resultOrder = $conn->query($sqlOrder);

$order = $resultOrder->fetch_assoc();

/* LẤY CHI TIẾT ĐƠN */

$sql = "SELECT order_details.*, products.TenSP, products.image
        FROM order_details
        JOIN products
        ON order_details.MaSP = products.MaSP
        WHERE order_details.order_id = '$order_id'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>

    <style>

        body{
            font-family: Arial;
            background: #f5f5f5;
        }

        .container{
            width: 1000px;
            margin: auto;
            margin-top: 40px;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        h1{
            text-align: center;
            margin-bottom: 10px;
        }

        .status{

            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
            font-weight: bold;
        }

        .status span{

            color: red;
        }

        .info{

            margin-bottom: 25px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
        }

        .info p{
            margin: 8px 0;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th, td{
            border-bottom: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        th{
            background: black;
            color: white;
        }

        img{
            width: 100px;
            border-radius: 10px;
        }

        .total{
            margin-top: 20px;
            text-align: right;
            font-size: 22px;
            color: red;
            font-weight: bold;
        }

        .back{
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back:hover{
            background: #333;
        }

    </style>
</head>
<body>

<div class="container">

    <h1>📦 Chi tiết đơn hàng</h1>

    <!-- TRẠNG THÁI -->

    <div class="status">

        Trạng thái đơn hàng:

        <span>
            <?php echo $order['status']; ?>
        </span>

    </div>

    <!-- THÔNG TIN -->

    <div class="info">

        <p>
            <b>Mã đơn:</b>
            <?php echo $order['id']; ?>
        </p>

        <p>
            <b>Email:</b>
            <?php echo $order['email']; ?>
        </p>

        <p>
            <b>Địa chỉ:</b>
            <?php echo $order['address']; ?>
        </p>

        <p>
            <b>Số điện thoại:</b>
            <?php echo $order['phone']; ?>
        </p>

        <p>
            <b>Ngày đặt:</b>
            <?php echo $order['created_at']; ?>
        </p>

    </div>

    <!-- DANH SÁCH SẢN PHẨM -->

    <table>

        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>

        <?php

        $tong = 0;

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){

                $tong += $row['price'];

        ?>

        <tr>

            <td>
                <img src="img/<?php echo $row['image']; ?>">
            </td>

            <td>
                <?php echo $row['TenSP']; ?>
            </td>

            <td>
                <?php echo $row['soluong']; ?>
            </td>

            <td>
                <?php echo number_format($row['price']); ?> VND
            </td>

        </tr>

        <?php
            }

        }else{

            echo "
            <tr>
                <td colspan='4'>
                    Không có sản phẩm
                </td>
            </tr>
            ";
        }

        ?>

    </table>

    <!-- TỔNG -->

    <div class="total">

        Tổng tiền:
        <?php echo number_format($tong); ?> VND

    </div>

    <!-- QUAY LẠI -->

    <a href="home.php" class="back">

        ← Quay lại trang chủ

    </a>

</div>

</body>
</html>