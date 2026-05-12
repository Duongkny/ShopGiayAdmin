<?php
include "config.php";

/* CẬP NHẬT TRẠNG THÁI */

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $status = $_POST['status'];

    $sqlUpdate = "UPDATE orders
                  SET status='$status'
                  WHERE id='$id'";

    if($conn->query($sqlUpdate)==TRUE){

        echo "
        <script>
            alert('Cập nhật trạng thái thành công');
            window.location='';
        </script>
        ";

    }else{

        echo $conn->error;
    }
}

/* LẤY DANH SÁCH ĐƠN */

$sql = "SELECT * FROM orders
        ORDER BY created_at DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>

    <style>

        body{
            font-family: Arial;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container{
            width: 1300px;
            margin: auto;
            margin-top: 40px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1{
            text-align: center;
            margin-bottom: 30px;
        }

        .back-btn{

            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover{
            background: black;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: black;
            color: white;
        }

        th, td{
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover{
            background: #f1f1f1;
        }

        select{
            padding: 8px;
            border-radius: 5px;
        }

        .btn{

            padding: 8px 15px;
            border: none;
            background: green;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover{
            background: darkgreen;
        }

        .detail-btn{

            background: orange;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .detail-btn:hover{
            background: darkorange;
        }

    </style>
</head>
<body>

<div class="container">

    <a href="QuanLySanPham.php" class="back-btn">
        ← Quay lại quản lý sản phẩm
    </a>

    <h1>📦 Quản lý đơn hàng</h1>

    <table>

        <tr>

            <th>Mã đơn</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>SĐT</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Chi tiết</th>

        </tr>

        <?php

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){

        ?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo $row['email']; ?>
            </td>

            <td>
                <?php echo $row['address']; ?>
            </td>

            <td>
                <?php echo $row['phone']; ?>
            </td>

            <td>
                <?php echo $row['created_at']; ?>
            </td>

            <td>

                <form method="post">

                    <input type="hidden"
                           name="id"
                           value="<?php echo $row['id']; ?>">

                    <select name="status">

                        <option
                        <?php
                        if($row['status']=="Chờ xác nhận"){
                            echo "selected";
                        }
                        ?>>
                            Chờ xác nhận
                        </option>

                        <option
                        <?php
                        if($row['status']=="Đã xác nhận"){
                            echo "selected";
                        }
                        ?>>
                            Đã xác nhận
                        </option>

                        <option
                        <?php
                        if($row['status']=="Đang chuẩn bị"){
                            echo "selected";
                        }
                        ?>>
                            Đang chuẩn bị
                        </option>

                        <option
                        <?php
                        if($row['status']=="Đang vận chuyển"){
                            echo "selected";
                        }
                        ?>>
                            Đang vận chuyển
                        </option>

                        <option
                        <?php
                        if($row['status']=="Đã giao"){
                            echo "selected";
                        }
                        ?>>
                            Đã giao
                        </option>

                    </select>

                    <button type="submit"
                            name="update"
                            class="btn">

                        Cập nhật

                    </button>

                </form>

            </td>

            <td>

                <a href="ChiTietDonHang.php?id=<?php echo $row['id']; ?>"
                   class="detail-btn">

                    Xem

                </a>

            </td>

        </tr>

        <?php
            }
        }else{

            echo "
            <tr>
                <td colspan='7'>
                    Không có đơn hàng
                </td>
            </tr>
            ";
        }

        ?>

    </table>

</div>

</body>
</html>