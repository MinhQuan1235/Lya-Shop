<link rel="stylesheet" href="css/left_insert.css">

<div id="danhmuc">
	<div class="dm">
		<div class="logo" >
			<a href="index.php">
				<i  class="logo-icon fa-solid fa-fish"></i>
			</a>
		</div>
		<?php
        // kiem tra xem co gia tri nao cua username duoc luu ko
        // neu co thi hien giao dien da dang nhap va hien thi username
        if (isset($_SESSION['username'])) {
        ?>
            <div id="dadangnhap">
                <div id="xinchao">
                    <p>Xin chào: <span> <?php echo $_SESSION['username'] ?> </span></p>
                </div>
                
                <div id="logoutbt">
                    <p><a href="logout.php"><i style="padding-right:4px;" class="fa-solid fa-right-from-bracket"></i>Log Out</a></p>
                </div>
            </div><!-- End .dangnhap-in-->
        <?php
        }
        // neu khong thi hien thi giao dien dang nhap
        // nguoi dung khong co tai khoan dang nhap co the chon dang ki
        else {
        ?>
		<div class="dangnhapdangki" > 
			<a href="index.php?content=dangnhap" id="dangnhapbt">Đăng nhập</a> / <a href="index.php?content=dangky" id="dangkybt">Đăng ký</a>
		</div>
		<?php } ?>
		<div class="logo" >
			<a href="index.php?content=giohang">
				<i  class="icon-cart fa-solid fa-cart-shopping"></i>
			</a>
		</div>
		<form action="index.php?content=timkiemsanpham" method="post">
		<div class="search-container">
			<input type="text" required class="search-input" name="tukhoa" placeholder="Tìm kiếm...">
		</div>
		</form>

		<?php
		$sql = "select * from danhmucsanpham where phanlop=0";
		$result = mysqli_query($link, $sql);
		?>
		<ul class= "danhmuc">
			<?php
			while ($row = mysqli_fetch_array($result)) {
			?>
				<li class="list"><a href="index.php?content=danhmucsanpham&madm=<?php echo $row['madanhmucsanpham'] ?>"><?php echo $row["tendanhmuc"]; ?></a></li>
				
				
			<?php } ?>
			<li class="list"><a href="" >Liên hệ</a></li>
			<li class="list"><a href="" >Chính sách </a></li>
			<li class="list"><a href="" >Tin tức </a></li>
			<li class="list"><a href="" >Hỗ Trợ</a></li>
	

		</ul> 
	</div>
</div>

