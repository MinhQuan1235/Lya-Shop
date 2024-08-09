<link rel="stylesheet" href="css/mid_insert.css">
<link rel="stylesheet" href="css/giohang.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <div class="cart">
<center>
<h2 style="display:flex; justify-content: space-between; background-color:#ECECED; padding:10px 0 10px 20px;"> Giỏ hàng của bạn</h2>
</center>

<center>
<?php 
    if(!isset($_SESSION['username'])){
      echo "<script language='javascript'>
			alert('Vui lòng đăng nhập...');
			window.open('index.php','_self', 1);
		</script>";
    }else{
      $username = $_SESSION['username'];
      $tv = mysqli_query($link, "SELECT * FROM giohang WHERE username = '$username'");
    }
    if(mysqli_num_rows($tv)>0)
    {
?>

<form action="index.php?content=ttkh-thanhtoan" method="post">
<table  id="tbcart">

<tr>
    <th> Sản phẩm</th>
    <th>Giá</th>
    <th>Số lượng</th>
    <th>Thành tiền</th>
    <th>Tùy chọn</th>
  </tr>

  <?php
  while($gh=mysqli_fetch_array($tv)){
  $sp = mysqli_query($link, "SELECT * FROM sanpham WHERE masp = {$gh['masp']}");
  $ttsp = mysqli_fetch_assoc($sp);
  $ha = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$ttsp['masp']}");
  $ttha = mysqli_fetch_assoc($ha);
  ?>
  <tr>
    <td class="tenspgiohang"><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $gh['magiohang']?>" ><img src="img/uploads/<?php echo $ttha['hinhanh']?>" style="border-radius: 4px; " width='80' height='80' alt=""><a class="agiohang" href="index.php?content=chitietsp&idsp=<?php echo $gh['masp'] ?>"><?php echo $ttsp['tensp']?></a> </td>
    <td class="gia"><?php echo number_format(($ttsp['gia']*((100-$ttsp['khuyenmai'])/100)),0,",",".")?>Vnđ</td>
    <?php if(($ttsp['soluong']-$ttsp['daban']-$ttsp['dadat'])<=0){
        ?>
        <td><input class="input-tsxoa" type="number" value="<?php echo $gh['soluong'] ?>" min=0 max="<?php echo ($ttsp['soluong']-$ttsp['daban']-$ttsp['dadat'])?>" name="soluong" magh="<?php echo $gh['magiohang']?>"  /></td>
        <?php } 
        else { ?>
        <td><input class="input-tsxoa" type="number" value="<?php echo $gh['soluong'] ?>" min=1 max="<?php echo ($ttsp['soluong']-$ttsp['daban']-$ttsp['dadat'])?>" name="soluong" magh="<?php echo $gh['magiohang']?>"  /></td>
       <?php } ?> 
    <td class="totalPrice"><?php echo number_format((($ttsp['gia']*((100-$ttsp['khuyenmai'])/100)) * $gh['soluong']),0,",",".") ?>Vnđ</td>
    <td><button class="deleteBtn" data-product-id="<?php echo $gh['magiohang']?>">Xóa</button></td>
  </tr>
  <tr>
  <?php } ?>
  <tr style="border-top: 1px solid black;">
    <td colspan="3"><b>Tổng tiền:</b></td>
    <td class="tongtien">0Vnđ</td>
    <td><button class="btnthanhtoan">Thanh toán</button></td>
  </tr>
  <tr>
    <td colspan="4">
        <li class="licheckbox"><input type="checkbox" id="selecctall"/> Chọn tất cả</li> 
    </td>
    <td>
	    <button class="deleteall" username-id = "<?php echo $username ?>">Xóa toàn bộ</button>
    </td>
</tr>


</table>
</form>
<?php } 
else{
    ?>
    <div>
        <h1>Không có sản phẩm nào trong giỏ hàng...</h1><br><br><br>
    </div>
    <?php } ?>

    <a  href="index.php"><button style="background-color:#01A9E9"> Tiếp tục mua hàng  </button> </a> &emsp; 

</center>
</center>
<div id="xoatoanbo">
</div>

<div id="tieptucmuahang">
</div>

<script>
$(document).ready(function() {
    // Thêm sự kiện click cho checkbox #selecctall bằng jQuery
    $('#selecctall').click(function(event) {
        if (this.checked) {
            $('.checkbox1').prop('checked', true); // Chọn tất cả checkbox
        } else {
            $('.checkbox1').prop('checked', false); // Bỏ chọn tất cả checkbox
        }
        updateTotalPrice();
    });

    $('.checkbox1').change(function() {
        updateTotalPrice(); // Cập nhật tổng tiền khi checkbox thay đổi
    });

    // Thêm sự kiện input cho các trường nhập số lượng bằng jQuery
    $('.input-tsxoa').on('input', function() {
        updatePrice(this); // Gọi hàm updatePrice khi số lượng thay đổi
        updateTotalPrice();
    });

    $('.deleteBtn').click(function() {
        var xmagiohang = $(this).data("product-id"); // Lấy mã sản phẩm từ thuộc tính data
        console.log(xmagiohang);

        // Gửi yêu cầu AJAX đến máy chủ
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_cart.php", true); // Gửi yêu cầu POST tới process_cart.php
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Xử lý phản hồi từ server
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Hiển thị thông báo từ phản hồi của server
                console.log(xhr.responseText);
                location.reload();
            }
        };

        // Gửi dữ liệu productId tới process_cart.php
        var data = "xmagiohang=" + encodeURIComponent(xmagiohang);
        xhr.send(data);
    });

    $('.deleteall').click(function() {
        var xtcgh_user = $(this).data("username-id");
        console.log(xtcgh_user);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_cart.php", true); // Gửi yêu cầu POST tới process_cart.php
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Xử lý phản hồi từ server
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Hiển thị thông báo từ phản hồi của server
                console.log(xhr.responseText);
                location.reload();
            }
        };
        
        // Gửi dữ liệu userId tới process_cart.php
        var data = "xtcgh_user=" + encodeURIComponent(xtcgh_user);
        xhr.send(data);
    });

    // Thêm sự kiện click cho nút thanh toán
    $('.btnthanhtoan').click(function() {
        // Redirect or do something else after successful payment
    });

});

// Hàm cập nhật tổng giá tiền
function updatePrice(input) {
    var quantity = $(input).val(); // Lấy giá trị số lượng từ trường nhập
    var priceText = $(input).closest('tr').find('.gia').text(); // Giá sản phẩm
    var price = parseFloat(priceText.replace(/\D/g, '')); // Loại bỏ tất cả các ký tự không phải là số
    var totalPrice = quantity * price; // Tính tổng giá tiền
    var totalPriceNumber = number_format(totalPrice, 0, ',', '.'); // Gọi hàm number_format
    console.log(totalPriceNumber);
    $(input).closest('tr').find('.totalPrice').text(totalPriceNumber + 'Vnđ'); // Hiển thị tổng giá tiền

    var magh = $(input).attr("magh"); // Lấy giá trị thuộc tính magh bằng jQuery
    console.log(magh);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process_cart.php", true); // Gửi yêu cầu POST tới process_cart.php
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Xử lý phản hồi từ server
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Hiển thị thông báo từ phản hồi của server
            console.log(xhr.responseText);
        }
    };

    // Gửi dữ liệu productId tới process_cart.php
    var data = "magh=" + encodeURIComponent(magh) + "&soluong=" + encodeURIComponent(quantity);
    xhr.send(data);
}

// Hàm cập nhật tổng giá tiền
function updateTotalPrice() {
    var totalPrice = 0;
    // Lặp qua tất cả các hàng
    $('.checkbox1:checked').each(function() {
        var quantity = $(this).closest('tr').find('.input-tsxoa').val(); // Số lượng
        var priceText = $(this).closest('tr').find('.gia').text();
        var price = parseFloat(priceText.replace(/\D/g, '')); // Loại bỏ tất cả các ký tự không phải là số
        totalPrice += parseInt(quantity) * price; // Tính tổng giá tiền
        console.log(totalPrice)
    });
    var totalPriceNumber = number_format(totalPrice, 0, ',', '.'); // Gọi hàm number_format
    $('.tongtien').text(totalPriceNumber + 'Vnđ'); // Hiển thị tổng tiền
}


function number_format(number, decimals, dec_point, thousands_sep) {
    // Hàm này thực hiện định dạng số với số lượng phần thập phân, dấu phẩy phân cách hàng nghìn, và dấu chấm thập phân tùy chỉnh.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };

    // Tạo dấu thập phân
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
</script>


</div>
