<?php 
include 'config.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>

    <style>

        body{
            font-family: Arial;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container{
            width: 1200px;
            margin: auto;
            margin-top: 30px;
        }

        h1{
            text-align: center;
            margin-bottom: 30px;
        }

        /* MENU */

        .menu{
            margin-bottom: 25px;
            text-align: center;
        }

        .menu-btn{

            display: inline-block;
            padding: 12px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 0 10px;
            transition: 0.3s;
        }

        .menu-btn:hover{

            background: #ff4d4d;
        }

        /* FORM */

        .form-box{
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-box input,
        .form-box select{

            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        .btn{
            width: 100%;
            padding: 15px;
            border: none;
            background: #ff4d4d;
            color: white;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover{
            background: #e60000;
        }

        /* TABLE */

        .table-box{
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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

        img{
            width: 100px;
            border-radius: 10px;
        }

        .edit-btn{

            background: orange;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .edit-btn:hover{
            background: darkorange;
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

    </style>
</head>
<body>

<div class="container">

    <h1>👟 Quản lý sản phẩm</h1>

    <!-- MENU ADMIN -->

    <div class="menu">

        <a href="ThongTinKhachHang.php"
           class="menu-btn">

            👤 Khách hàng

        </a>

        <a href="DonHangAdmin.php"
           class="menu-btn">

            📦 Đơn hàng

        </a>

    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $maSP = $_POST['MaSP'];
        $tenSP = $_POST['name'];
        $price = $_POST['price'];
        $mota = $_POST['mota'];
        $soLuong = $_POST['soluong'];
        $loai = $_POST['loai'];

        // Upload ảnh
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

            $hinhAnh = time() . "_" . $_FILES['image']['name'];

            $duongDan1 = "img/" . $hinhAnh;
            $duongDan2 = "../ShopGiay/img/" . $hinhAnh;

            move_uploaded_file($_FILES['image']['tmp_name'], $duongDan1);

            copy($duongDan1, $duongDan2);

        }else{

            $hinhAnh = "";
        }

        $sqlInsert = "INSERT INTO products
        (MaSP, TenSP, price, mota, soluong, image, loai)

        VALUES

        ('$maSP', '$tenSP', '$price', '$mota',
        '$soLuong', '$hinhAnh', '$loai')";

        if($conn->query($sqlInsert) == TRUE){

            echo "
            <script>
                alert('Thêm sản phẩm thành công');
                window.location='';
            </script>
            ";

        }else{

            echo $conn->error;
        }
    }

    ?>

    <!-- FORM THÊM -->

    <div class="form-box">

        <form action="" method="post" enctype="multipart/form-data">

            <input type="text"
                   name="MaSP"
                   placeholder="Mã sản phẩm"
                   required>

            <input type="text"
                   name="name"
                   placeholder="Tên sản phẩm"
                   required>

            <input type="number"
                   name="price"
                   placeholder="Giá sản phẩm"
                   required>

            <input type="text"
                   name="mota"
                   placeholder="Mô tả sản phẩm"
                   required>

            <input type="number"
                   name="soluong"
                   placeholder="Số lượng"
                   required>

            <input type="file"
                   name="image"
                   required>

            <select name="loai">

                <option value="TheThao">
                    Giày thể thao
                </option>

                <option value="ThoiTrang">
                    Giày thời trang
                </option>

            </select>

            <button type="submit" class="btn">
                ➕ Thêm sản phẩm
            </button>

        </form>

    </div>

    <!-- DANH SÁCH -->

    <div class="table-box">

        <table>

            <tr>
                <th>Mã SP</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
                <th>Loại</th>
                <th>Thao tác</th>
            </tr>

            <?php

            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()){

            ?>

            <tr>

                <td>
                    <?php echo $row['MaSP']; ?>
                </td>

                <td>
                    <?php echo $row['TenSP']; ?>
                </td>

                <td>
                    <?php echo number_format($row['price']); ?> VND
                </td>

                <td>
                    <?php echo $row['mota']; ?>
                </td>

                <td>
                    <?php echo $row['soluong']; ?>
                </td>

                <td>
                    <img src="img/<?php echo $row['image']; ?>">
                </td>

                <td>
                    <?php echo $row['loai']; ?>
                </td>

                <td>

                    <a href="SuaSP.php?MaSP=<?php echo $row['MaSP']; ?>"
                       class="edit-btn">

                        Sửa

                    </a>

                    <br><br>

                    <a href="XoaSP.php?MaSP=<?php echo $row['MaSP']; ?>"
                       class="delete-btn"
                       onclick="return confirm('Bạn có chắc muốn xóa?')">

                        Xóa

                    </a>

                </td>

            </tr>

            <?php
                }
            }
            ?>

        </table>

    </div>

</div>

</body>
</html>