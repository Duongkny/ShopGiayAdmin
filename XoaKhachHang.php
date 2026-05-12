<?php
include "config.php";

if(isset($_GET['email'])){

    $email = $_GET['email'];

    $sql = "DELETE FROM users WHERE email='$email'";

    if($conn->query($sql)==TRUE){

        header("Location: ThongTinKhachHang.php");

    }else{

        echo $conn->error;
    }
}
?>