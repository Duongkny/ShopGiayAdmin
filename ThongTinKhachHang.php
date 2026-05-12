<?php
include "config.php";

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>

    <style>

        body{
            font-family: Arial;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container{
            width: 1000px;
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

        .delete-btn{

            background: red;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete-btn:hover{
            background: darkred;
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

    </style>
</head>
<body>

<div class="container">

    <a href="QuanLySanPham.php" class="back-btn">
        ← Quay lại quản lý sản phẩm
    </a>

    <h1>👤 Danh sách tài khoản khách hàng</h1>

    <table>

        <tr>
            <th>STT</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Thao tác</th>
        </tr>

        <?php

        $stt = 1;

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){

        ?>

        <tr>

            <td>
                <?php echo $stt++; ?>
            </td>

            <td>
                <?php echo $row['email']; ?>
            </td>

            <td>
                <?php echo $row['password']; ?>
            </td>

            <td>

                <a href="XoaKhachHang.php?email=<?php echo $row['email']; ?>"
                   class="delete-btn"
                   onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')">

                    Xóa

                </a>

            </td>

        </tr>

        <?php
            }

        }else{

            echo "
            <tr>
                <td colspan='4'>
                    Không có tài khoản
                </td>
            </tr>
            ";
        }

        ?>

    </table>

</div>

</body>
</html>