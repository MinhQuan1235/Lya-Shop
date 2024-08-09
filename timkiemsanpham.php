<link rel="stylesheet" href="css/sanpham_insert.css">

<div class="sanpham ">
    <?php
        $tukhoa = $_POST['tukhoa'];
        $sql1 = "SELECT * FROM sanpham WHERE tensp LIKE '%" . $tukhoa . "%' ORDER BY masp LIMIT 10";
        $kq = mysqli_query($link, $sql1);
        $dem = mysqli_num_rows($kq);
        if ($dem > 0) {
            ?>
            <h2>Có <?php echo $dem ?> sản phẩm phù hợp tìm kiếm</h2>
            
        <?php } else {
            ?>
            <h2>Không có sản phẩm nào phù hợp với tìm kiếm</h2>
        <?php
        }
        ?>
            <div class="sanphamcon">
                <?php while ($rows = mysqli_fetch_array($kq)) { ?>
                    <div class="dienthoai">
                        <?php
                        $limit_query = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$rows['masp']} ORDER BY mahinhanh ASC LIMIT 1");
                        $row = mysqli_fetch_assoc($limit_query);
                        $first_img = $row['hinhanh'];
                        if ($rows['khuyenmai'] > 0) {
                            ?>
                            <!-- <div class="moi"><h3>-<?php echo $rows['khuyenmai'] ?>%</h3></div> -->
                        <?php } ?>
                        <a href="index.php?content=chitietsp&idsp=<?php echo $rows['masp'] ?>"><img
                                    src="img/uploads/<?php echo $first_img; ?>" width="200px" height="200px"></a><br>
                        <p class="pdten"><a class="hover-effect"
                                             href="index.php?content=chitietsp&idsp=<?php echo $rows['masp'] ?>"><?php echo $rows['tensp']; ?></a>
                        </p>
                        <?php if($rows['daban']>=$rows['soluong']||$rows['soluong']-$rows['daban']-$rows['dadat']<=0){
										?>
										<h2>Hết hàng</h2>
									<?php } else { ?>
									<div class="addcart">
									<h1><i class="addcart-color fa-solid fa-cart-plus" data-product-id="<?php echo $rows['masp'] ?>"></i></h1>
									<h3><?php echo number_format(($rows['gia']*((100-$rows['khuyenmai'])/100)),0,",",".");?> (-<?php echo $rows['khuyenmai']?>%)</h3>
									</div><!-- End .button-->
									<?php } ?>
                    </div><!-- End .dienthoai-->
                <?php }?>
    </div>
</div><!-- end san pham-->

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