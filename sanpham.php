<link rel="stylesheet" href="css/sanpham_insert.css">
<?php 
		$sql="select * from danhmucsanpham where phanlop = 0 order by madanhmucsanpham";
		$result=mysqli_query($link,$sql);
		$tt=mysqli_num_rows($result);
		if($tt>0){
			echo '<script>console.log("deef");</script>';
		}
	    while($row=mysqli_fetch_array($result))
		{
		?>
		<div class="sanpham "> <?php
				$sql1="SELECT sanpham.* FROM sanpham
				JOIN danhmucsanpham ON sanpham.madanhmucsanpham = danhmucsanpham.madanhmucsanpham
				WHERE danhmucsanpham.madanhmucsanpham IN (SELECT madanhmucsanpham FROM danhmucsanpham WHERE phanlop = {$row['madanhmucsanpham']}) order by masp  LIMIT 10";// chi in 10 san pham ra phan san pham
			$kq=mysqli_query($link,$sql1);
			$dem = mysqli_num_rows($kq);
			if($dem>0)
			{
			?>
		<?php  }?>
		<h2 style="display:flex; justify-content: space-between; background-color:#ECECED; padding:10px 0 10px 20px;"><?php echo $row["tendanhmuc"];?>
		<div id="xemthem">
				<a style="color:black; text-decoration:none; font-size:18px; padding-right:20px ;" href="index.php?content=xemthem&madm=<?php echo $row['madanhmucsanpham']?>">Xem thêm </a>
			</div>
		</h2> 
    	<div class="sanphamcon">
			<?php while($rows=mysqli_fetch_array($kq))
			{ ?>
			<div class="dienthoai"> 
									<?php 
										$limit_query = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$rows['masp']} ORDER BY mahinhanh ASC LIMIT 1");
										$row = mysqli_fetch_assoc($limit_query);
										$first_img = $row['hinhanh'];
										if($rows['khuyenmai']>0)
										{
									?>
									<!-- <div class="moi"><h3>-<?php echo $rows['khuyenmai']?>%</h3></div> -->
									<?php } ?>
									<a href="index.php?content=chitietsp&idsp=<?php echo $rows['masp'] ?>"><img  src="img/uploads/<?php echo $first_img;?>"  width="100%" height="65%"></a><br>					
									<p class="pdten" ><a class="hover-effect" href="index.php?content=chitietsp&idsp=<?php echo $rows['masp'] ?>" ><?php echo $rows['tensp'];?></a></p>
									<?php if($rows['soluong']-$rows['daban']-$rows['dadat']<=0){
										?>
										<h2>Hết hàng</h2>
									<?php } else { ?>
										
									<div class="addcart">
									<h1><i class="addcart-color fa-solid fa-cart-arrow-down" data-product-id="<?php echo $rows['masp'] ?>"></i></h1>
									<h3><?php echo number_format(($rows['gia']*((100-$rows['khuyenmai'])/100)),0,",",".");?> (-<?php echo $rows['khuyenmai']?>%)</h3>
									</div><!-- End .button-->
									<?php } ?>
			</div><!-- End .dienthoai-->
			<?php } ?>
		</div>
		</div><!-- end san pham-->
<?php }?>
		<script>
// Lấy tất cả các phần tử <i> có class "addcart-color"
var addButtons = document.querySelectorAll(".addcart-color");

// Duyệt qua từng nút và thêm sự kiện click
addButtons.forEach(function(button) {
    button.addEventListener("click", function() {
        var productId = this.getAttribute("data-product-id"); // Lấy ID sản phẩm từ thuộc tính data-product-id

        // Tạo đối tượng XMLHttpRequest để gửi yêu cầu AJAX đến server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_cart.php", true); // Gửi yêu cầu POST tới process_cart.php
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Xử lý phản hồi từ server
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Hiển thị thông báo từ phản hồi của server
                var response = xhr.responseText;
                showNotification(response);

                // Tự động đóng thông báo sau 3 giây
                setTimeout(function() {
                    hideNotification();
                }, 2000);
            }
        };

        // Gửi dữ liệu productId tới process_cart.php
        xhr.send("productId=" + encodeURIComponent(productId));
    });
});

// Hàm hiển thị thông báo
function showNotification(message) {
    var notification = document.getElementById("thongbao");
    notification.innerHTML = "<h2>" + message + "</h2>";
    notification.style.display = "block";
}

// Hàm ẩn thông báo
function hideNotification() {
    var notification = document.getElementById("thongbao");
    notification.style.display = "none";
}
</script>
