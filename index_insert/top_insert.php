<link rel="stylesheet" href="css/top_insert.css">
<!-- <div id="logo1">
    <img src="" alt="">
</div>
<div id="toolbar">
    <form action="" method="POST">
    <center>
    <a href="index.php" class="tb">Trang chủ</a> &emsp;&emsp;&emsp;
    <a href="index.php?content=gioithieu" class="tb">Giới thiệu</a>&emsp;&emsp;&emsp;
    <a href="index.php?content=sanpham" class="tb">Sản phẩm</a>&emsp;&emsp;&emsp;
    <a href="index.php?content=phukien" class="tb">Phụ kiện</a>&emsp;&emsp;&emsp;
    <a href="index.php?content=khuyenmai" class="tb">Khuyễn mãi</a>&emsp;&emsp;&emsp;
    <a href="index.php?content=tintuc" class="tb">Tin tức</a>&emsp;&emsp;&emsp;
    <a href="index.php?content=hotro" class="tb">Hỗ trợ</a>&emsp;&emsp;&emsp;
    <input type="text" name="search" placeholder="nhập sản phẩm muốn tìm kiếm" style="height: 40px" size="35" value=""></form>
    <input type="submit" name="tim" value="tìm kiếm"> -->
    
    <?php 
    if (isset($_POST["tim"])){
     $ten = $_POST['search']; 
     header("location:index.php?content=timkiem&ten=$ten");}?>
     <div class="img"><img src="img\slider_1.jpg" width="100%" height="100%" alt=""></div>
     <div >
        <ul class="chinh_sach">
            <li class="chinhsach_s"><i class="icon-chinhsach fa-solid fa-truck"></i> Giao hàng toàn quốc</li>
            <li class="chinhsach_s"><i class="icon-chinhsach fa-solid fa-comments"></i>Chia sẻ kiến thức thủy sinh</li>
            <li class="chinhsach_s"><i class="icon-chinhsach fa-solid fa-handshake-simple"></i>Hậu mãi dịch vụ trọn đời</li>
            <li class="chinhsach_s"><i class="icon-chinhsach fa-solid fa-piggy-bank"></i>tiết kiệm chi phí tối ưu</li>
        </ul>
    </div>
     <!-- </center>
</div>
<div>

</div> -->