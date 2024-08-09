<?php include 'database/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
</head>
<body>
    
</body>
</html>
<?php
session_start();
?>
<!-- css -->
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="./fontawesome-free-6.4.0-web/css/all.min.css">
<!-- trên -->
<div id="top_insert">
    <?php  include("index_insert/top_insert.php")?>
</div>
<!-- trái -->
<div id="left_insert">
    <?php include("index_insert/left_insert.php")?>
</div>
<!-- sản phẩm/giữa -->
<div id="mid_insert">
    <?php include("index_insert/mid_insert.php")?>
</div>
<div id="thongbao" class="thongbao" 
    style="position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    display: none;">
    <h2>Thêm sản phẩm thành công</h2>
</div>
<?php 
if (isset($_GET['content'])) {
    $ct = $_GET['content'];
    if($ct!="ttkh-thanhtoan"){
		unset($_SESSION['check']);
		unset($_SESSION['soluongmua']);
        echo "def";
		unset($_SESSION['masp']);
    }
}else{
    unset($_SESSION['check']);
    unset($_SESSION['soluongmua']);
    echo "abc";
    unset($_SESSION['masp']);
}
?>
<script>
    var div1, div2;

window.onload = function() {
    var condition = true;
    div1 = document.getElementById("top_insert");
    div2 = document.getElementById("mid_insert");
    var anchor = document.getElementById("trangchitietsp");
    var li = document.getElementById("login");
    var su = document.getElementById("signup");
    
    if (anchor||li||su) {
        tattop(false);
    } else {
        tattop(true);
    }
    
    var phanquyen = <?php echo isset($_SESSION['phanquyen']) ? $_SESSION['phanquyen'] : -1; ?>;

    if (phanquyen == 0) {
        alert('Chào mừng chủ nhân trở lại');
        window.open('admin/admin.php','_self', 1);
    }
};

function tattop(abc) {
    condition = abc;
    apdung();
}

function apdung() {
    if (condition) {
        div1.style.display = "block";
    } else {
        div1.style.display = "none";
        div2.style.top = "0";
    }
}

</script>