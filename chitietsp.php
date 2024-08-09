<link rel="stylesheet" href="css/chitietsp.css">
<?php 
	$idsp=$_GET['idsp'];
	$rows=mysqli_query($link,"select * from sanpham where masp=$idsp");
	while ($row=mysqli_fetch_array($rows))
	{
?>


<div id="trangchitietsp" class="chitietsp">
	<div class="chitietsp-in">

		<div class="content">
			
			<div class="content-container">
				<?php
					$img_query = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$row['masp']} ORDER BY mahinhanh");
					$img_querys = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$row['masp']} ORDER BY mahinhanh ");

					$img_row = mysqli_fetch_assoc($img_query);
				?>
				<div class="imgchitiet">
    				<div id="main-image">
        				<img id="large-image" src="img/uploads/<?php echo $img_row['hinhanh'];?>" alt='' title="Optional title display" />
					</div>
   				 	<div class="thumbnail-image">
						<?php
						while ($img_rows=mysqli_fetch_array($img_querys))
						{
						?>
        					
        					<img class="small-image" src="img/uploads/<?php echo $img_rows['hinhanh'];?>" width="83" height="83" alt='' title="Optional title display" />
						<?php 
							}
						?>
    				</div>
				</div>
	
				<div class="giasp">
					<ul>
						<form action="index.php?content=ttkh-thanhtoan&masp=<?php echo $row['masp'] ?>" method="post">
						<h1>
							<?php echo $row['tensp'] ?>
							

						</h1>
						<li><span><b>Giá: <font color="red">
							<?php echo number_format(($row['gia']*((100-$row['khuyenmai'])/100)),0,",","." ) ;?>
							Vnd</b></font></span></li>
						<p>Hãng sản xuất: <?php echo $row['hangsx'] ?></p>
						

						<li>Tình trạng:
							<?php 
								$dem = $row['soluong'] - $row['daban'] - $row['dadat'];
								if( $dem >0){
									echo "Số sản phẩm còn (".$dem.")";}
								else {
									echo "Hết hàng";}
							?>
						<p>Bảo Hành: <?php echo $row['baohanh'] ?> Tháng</p>

						<p>Đã bán: <?php echo $row['daban'] ?></p>
						</li>
						<?php 
							if($dem <=0){ ?>
								<h2>Tạm hết hàng</h2>
								<?php
							}else{
							?>
							<!-- them vao gio hang  -->
							<li>Số lượng mua : <input style="border-radius: 9px;  text-align: center; width: 100px;" type="number" min="1" max="<?php echo ($row['soluong']-$row['daban']-$row['dadat']) ?>" name="soluongmua" size="1" value="1" /></li>
							<li style="display: inline-block;padding-top: 20px;">
							<input type="button" value="Cho vào giỏ" name="chovaogio" class="addcart" data-product-id="<?php echo $row['masp'] ?>" style="
							margin-left: 0;
							margin-right: 0;
							height: 35px;
							width: 200px;
							background-color: #4caf50;
							color: #fff;
							padding: 10px;
							border: none;
							border-radius: 25px;
							cursor: pointer;" />
							</li>
							<li style="display: inline-block;padding-top: 20px ">			
								<input  type="submit" onclick="return kiemtra()" value="Mua ngay" name="muangay" class="inputmuahang"style="
							margin-left: 0;
							margin-right: 0;
							height: 35px;
							width: 200px;
							background-color: #4caf50;
							color: #fff;
							padding: 10px;
							border: none;
							border-radius: 25px;
							cursor: pointer;" />
							</li>
							<?php } ?>
						</form>
					</ul>
				</div>
			</div>
			<div id="tab1">
			<h2> Chi Tiết Sản Phẩm</h2>
				<?php echo $row['mota'] ?>
			</div>
			<div id="tab2">
				<div id="fb-root"></div>
		</div>

			


			</div>
		<!-- </div> -->
	</div>
</div>
<?php } ?>
<script>
	var addButton = document.querySelectorAll(".addcart");
	const smallImages = document.querySelectorAll(".thumbnail-image img");
	const largeImage = document.getElementById("large-image");
	smallImages.forEach((smallImage) => {
  		smallImage.addEventListener("mouseover", () => {
    		largeImage.src = smallImage.src;
  		});
	});
	addButton.forEach(function(button) {
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

function kiemtra() {
	var phanquyen = <?php echo isset($_SESSION['phanquyen']) ? $_SESSION['phanquyen'] : -1; ?>;

	if (phanquyen == -1) {
		alert("Vui lòng đăng nhập");
		return false;
		}
    }
</script>