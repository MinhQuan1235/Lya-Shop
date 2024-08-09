<?php
session_start();
include 'database/connect.php';

if (isset($_SESSION['username'])) {
    if(isset($_POST['productId'])){
    $productId = $_POST['productId'];
    $username = $_SESSION['username'];

    $checkgh = mysqli_query($link, "SELECT * FROM giohang WHERE username = '$username' AND masp = $productId");

        if (mysqli_num_rows($checkgh) == 0) {
            $insertQuery = "INSERT INTO giohang VALUES('', '$username', '$productId','1')";
            if (mysqli_query($link, $insertQuery)) {
                echo "Sản phẩm đã được thêm vào giỏ hàng thành công.";
            } else {
                echo "Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng: " . mysqli_error($link);
            }
        }
        else {
            echo "Sản phẩm đã tồn tại trong giỏ hàng.";
        }
    } 
    else if(isset($_POST['xmagiohang'])){
        $magiohang = $_POST['xmagiohang'];
        mysqli_query($link, "DELETE FROM giohang WHERE magiohang = '$magiohang'");
        echo("xoa thanh cong");
    }
    else if(isset($_POST['magh'])&&isset($_POST['soluong'])){
        $magh = $_POST['magh'];
        $soluong = $_POST['soluong'];
        mysqli_query($link, "UPDATE giohang SET soluong='$soluong' WHERE magiohang='$magh'");
        echo("update...");
    }
    else if(isset($_POST['xtcgh_user'])){
        $username = $_POST['xtcgh_user'];
        mysqli_query($link, "DELETE FROM giohang WHERE username = '$username'");
        echo("xoa thanh cong");
    }
} else {
    echo "Vui lòng đăng nhập...";
}
?>
