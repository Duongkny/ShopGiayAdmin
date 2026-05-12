<?php
include "config.php";

// lấy mã sản phẩm
$MaSP = $_GET['MaSP'];

// lấy dữ liệu sản phẩm
$sql = "SELECT * FROM products WHERE MaSP = '$MaSP'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

// cập nhật sản phẩm
if(isset($_POST['update'])){

    $tenSP = $_POST['TenSP'];
    $price = $_POST['price'];
    $soluong = $_POST['soluong'];
    $mota = $_POST['mota'];
    $loai = $_POST['loai'];

    // upload ảnh mới
    if($_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "img/" . $image
        );

    }else{

        $image = $row['image'];
    }

    $sqlUpdate = "UPDATE products SET

    TenSP='$tenSP',
    price='$price',
    soluong='$soluong',
    mota='$mota',
    loai='$loai',
    image='$image'

    WHERE MaSP='$MaSP'
    ";

    if($conn->query($sqlUpdate) == TRUE){

        echo "
        <script>
            alert('Cập nhật thành công');
            window.location='DanhSachSP.php';
        </script>
        ";

    }else{

        echo $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>

    <style>

        body{
            font-family: Arial;
            background: #f5f5f5;
        }

        .container{
            width: 600px;
            margin: auto;
            margin-top: 40px;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1{
            text-align: center;
        }

        input, textarea, select{

            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        img{
            width: 150px;
            margin-top: 10px;
            border-radius: 10px;
        }

        button{

            width: 100%;
            padding: 15px;
            border: none;
            background: #ff4d4d;
            color: white;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover{
            background: #e60000;
        }

    </style>
</head>
<body>

<div class="container">

    <h1>✏️ Sửa sản phẩm</h1>

    <form method="post" enctype="multipart/form-data">

        <label>Tên sản phẩm</label>

        <input type="text"
               name="TenSP"
               value="<?php echo $row['TenSP']; ?>">

        <label>Giá</label>

        <input type="number"
               name="price"
               value="<?php echo $row['price']; ?>">

        <label>Số lượng</label>

        <input type="number"
               name="soluong"
               value="<?php echo $row['soluong']; ?>">

        <label>Mô tả</label>

        <textarea name="mota"><?php echo $row['mota']; ?></textarea>

        <label>Loại sản phẩm</label>

        <select name="loai">

            <option value="TheThao"
            <?php
            if($row['loai']=="TheThao"){
                echo "selected";
            }
            ?>>
                Thể thao
            </option>

            <option value="ThoiTrang"
            <?php
            if($row['loai']=="ThoiTrang"){
                echo "selected";
            }
            ?>>
                Thời trang
            </option>

        </select>

        <label>Ảnh hiện tại</label>
        <br>

        <img src="img/<?php echo $row['image']; ?>">

        <br><br>

        <label>Chọn ảnh mới</label>

        <input type="file" name="image">

        <button type="submit" name="update">
            Cập nhật sản phẩm
        </button>

    </form>

</div>

</body>
</html>