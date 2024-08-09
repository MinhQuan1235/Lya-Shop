<link rel="stylesheet" href="css/mid_insert.css">
<link rel="stylesheet" href="css/giohang.css">
<script language="javascript">
    function kiemtra() {
        if (a.hoten.value == "") {
            alert("Bạn chưa điền tên");
            a.hoten.focus();
            return false;
        }

        if (a.dienthoai.value == "") {
            alert("Bạn chưa điền SĐT\nHãy điền số điện thoại để chúng tôi liên lạc lại với bạn");
            a.dienthoai.focus();
            return false;
        }
        if (a.diachi.value == "") {
            alert("Bạn chưa điền địa chỉ");
            a.diachi.focus();
            return false;
        }

        if (a.hoten.value != "" && a.dienthoai.value != "" && a.diachi.value != "") {
            a.submit();
        }
    }
    function cntt() {
    var ten = document.forms["frm"]["ten"].value;
    var sdt = document.forms["frm"]["sdt"].value;
    var diachi = document.forms["frm"]["diachi"].value;

    if (ten == "") {
        alert("Bạn chưa điền tên");
        document.forms["frm"]["ten"].focus();
        return false;
    }

    if (sdt == "") {
        alert("Bạn chưa điền SĐT\nHãy điền số điện thoại để chúng tôi liên lạc lại với bạn");
        document.forms["frm"]["sdt"].focus();
        return false;
    }

    if (diachi == "") {
        alert("Bạn chưa điền địa chỉ");
        document.forms["frm"]["diachi"].focus();
        return false;
    }
    anbang();
    document.getElementById("ten").value = masp;
    document.getElementById("sdt").value = masp;
    document.getElementById("diachi").value = masp;
    // Nếu tất cả thông tin được điền đầy đủ, thì submit form
    return true;
}
function hienbang() {
    var notification = document.getElementById("thaydoithongtin");
    // notification.innerHTML = "<h2>" + message + "</h2>";
    notification.style.display = "block";
}

// Hàm ẩn thông báo
function anbang() {
    var notification = document.getElementById("thaydoithongtin");
    notification.style.display = "none";
}

</script>
<?php
  if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    if(isset($_POST['cnthongtin'])){
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        mysqli_query($link, "UPDATE nguoidung SET tennguoidung='$ten',sodienthoai='$sdt',diachi='$diachi' WHERE username='$username'");
    }
    $kh = mysqli_query($link, "SELECT * FROM nguoidung WHERE username = '$username'");
    $ttkh = mysqli_fetch_assoc($kh);
  }
  else{
    echo '<meta http-equiv="refresh" content="0;url=index.php?content=giohang">';
  }
  if(isset($_POST['dathang']))
  {
    $htennd = $ttkh['tennguoidung'];
    $hdiachi = $ttkh['diachi'];
    $sodienthoai = $ttkh['sodienthoai'];
    $ngaydat = date("Y-m-d");
    $htongtien = $_POST['tongtien'];

    $insertdm = mysqli_query($link,"INSERT INTO hoadon VALUES('', '$htennd', '$hdiachi', '$htongtien', 0, '$sodienthoai', '$ngaydat') ");
    if($insertdm) {
      $tvhd = mysqli_query($link, "SELECT * FROM hoadon ORDER BY mahd DESC LIMIT 1");
			$row = mysqli_fetch_assoc($tvhd);
      $mahd = $row['mahd'];
      $magh = $_POST['magh'];

      foreach($magh as $x) {
        ///////
        if(!isset($_GET['masp'])){
        $ctgh = mysqli_query($link, "SELECT * FROM giohang WHERE magiohang = {$x}");
        $dlgh = mysqli_fetch_assoc($ctgh);
        $gsoluong = $dlgh['soluong'];
        $gmasp = $dlgh['masp'];
        ///////
        $ctsp = mysqli_query($link, "SELECT * FROM sanpham WHERE masp = {$gmasp}");
        $dlsp = mysqli_fetch_assoc($ctsp);
        $stensp = $dlsp['tensp'];
        $sdadat = $dlsp['dadat'];
        $sgia = $dlsp['gia']*((100-$dlsp['khuyenmai'])/100);
        ///////
        $gthanhtien = $gsoluong*$sgia;
        $dadatmoi=$sdadat+$gsoluong;
        mysqli_query($link,"INSERT INTO chitiethoadon VALUES('', '$mahd', '$gmasp', '$stensp', '$sgia', '$gsoluong', '$gthanhtien') ");
        mysqli_query($link,"UPDATE sanpham SET dadat='$dadatmoi' WHERE masp={$gmasp}");
        mysqli_query($link,"DELETE FROM giohang WHERE magiohang = {$x} ");
    }
        else{
          $gmasp = $_GET['masp'];
          $ctsp = mysqli_query($link, "SELECT * FROM sanpham WHERE masp = {$gmasp}");
          $dlsp = mysqli_fetch_assoc($ctsp);
          $stensp = $dlsp['tensp'];
          $sdadat = $dlsp['dadat'];
          $sgia = $dlsp['gia']*((100-$dlsp['khuyenmai'])/100);
          $gsoluong=$_POST['soluong'];
          $gthanhtien = $gsoluong*$sgia;
          $dadatmoi=$sdadat+$gsoluong;
          mysqli_query($link,"INSERT INTO chitiethoadon VALUES('', '$mahd', '$gmasp', '$stensp', '$sgia', '$gsoluong', '$gthanhtien') ");
          mysqli_query($link,"UPDATE sanpham SET dadat='$dadatmoi' WHERE masp={$gmasp}");
          mysqli_query($link,"DELETE FROM giohang WHERE magiohang = {$gmasp} ");
        }
      }
      echo '<meta http-equiv="refresh" content="0;url=tbdh.php">';
    }
    else {
      echo "Thêm thất bại";
    }
  }
  
?>
<div class="thongtinkhachhang">
    <center>
        <h2 style="display:flex; justify-content: space-between; background-color:#ECECED; padding:10px 0 10px 20px;"> Giỏ hàng của bạn</h2>
    </center>
    <div class="dia-chi-nhan-hang">
  <h2>Thông tin khách hàng</h2>
    <p>Tên: <span class="ten-nguoi-nhan"><?php echo $ttkh['tennguoidung']?></span></p>
    <p>SĐT: <span class="so-dien-thoai"><?php echo $ttkh['sodienthoai']?></span></p>
    <p class="dia-chi">Địa chỉ: <?php echo $ttkh['diachi']?>
    <!-- <a href="#" class="thay-doi">Thay đổi</a> -->
    <button class="thay-doi" onclick="hienbang()">Thay đổi</button>
  </p>

</div>
<?php
    if(isset($_POST['check'])||isset($_SESSION['check'])) {
        if(isset($_POST['check'])){
            $selectedProducts = $_POST['check'];
            $_SESSION['check'] = $_POST['check'];
        }
        else{
            $selectedProducts = $_SESSION['check'];
        }
        ?>
        <center>
          <form action="" method="post">
            <table id="tbcart">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                $tongtien = 0;
                foreach($selectedProducts as $magiohang) {
                    $result = mysqli_query($link, "SELECT * FROM giohang WHERE magiohang = '$magiohang'");
                    if(mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                        $sp = mysqli_query($link, "SELECT * FROM sanpham WHERE masp = {$row['masp']}");
                        $ttsp = mysqli_fetch_assoc($sp);
                        $ha = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$row['masp']}");
                        $ttha = mysqli_fetch_assoc($ha);

                        $tensp = $ttsp['tensp'];
                        $hinhanh = $ttha['hinhanh'];
                        $soluong = $row['soluong'];
                        $gia = $ttsp['gia']*((100-$ttsp['khuyenmai'])/100);
                        $thanhtien = $soluong * $gia;
                        $tongtien = $tongtien + $thanhtien;
                        ?>
                        <tr>
                            <td class="tenspgiohang">
                            <input type="hidden" name="magh[]" value="<?php echo $row['magiohang']?>">
                                <img src="img/uploads/<?php echo $hinhanh?>" style="border-radius: 4px; " width='80' height='80' alt="">
                                <a class="agiohang" href=""><?php echo $tensp?></a>
                            </td>
                            <td><?php echo number_format(($gia),0,",",".")?>Vnđ</td>
                            <td><?php echo $soluong?></td>
                            <td><?php echo number_format(($thanhtien),0,",",".")?>Vnđ</td>
                        </tr>
                    <?php }
                } ?>
                <tr>
                    <td colspan="3"><b>Tổng tiền:</b></td>
                    <td><?php echo number_format(($tongtien),0,",",".")?>Vnđ</td>
                    <input type="hidden" name="tongtien" value="<?php echo $tongtien?>">
                </tr>
                <tr>
                    <td colspan="3" class="tieude">Phương thức:
                        <select class="select-css" name="phuongthuc">
                            <option value="">Chọn phương thức thanh toán</option>
                            <option value="1">QR Code</option>
                            <option value="2">Thẻ tín dụng/Ghi nợ</option>
                            <option value="3">Thanh toán khi nhận hàng</option>
                        </select>
                    </td>
                    <td>
                        <button class="btnthanhtoan" onclick="kiemtra()" type="submit" name="dathang">Đặt Hàng</button>
                    </td>
                </tr>
            </table>
            </form>
        </center>
    <?php }
else if(isset($_POST['muangay'])||isset($_SESSION['soluongmua'])){
    if(isset($_POST['muangay'])){
    $soluong = $_POST['soluongmua'];
    $masp = $_GET['masp'];
    $_SESSION['soluongmua'] = $_POST['soluongmua'];
    $_SESSION['masp'] = $_GET['masp'];
    }
    else{
        $soluong = $_SESSION['soluongmua'];
        $masp = $_SESSION['masp'];
    }
    ?>
        <center>
          <form action="" method="post">
            <table id="tbcart">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                        $sp = mysqli_query($link, "SELECT * FROM sanpham WHERE masp = {$masp}");
                        $ttsp = mysqli_fetch_assoc($sp);
                        $ha = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$masp}");
                        $ttha = mysqli_fetch_assoc($ha);
                        
                        $tensp = $ttsp['tensp'];
                        $hinhanh = $ttha['hinhanh'];
                        $gia = $ttsp['gia']*((100-$ttsp['khuyenmai'])/100);
                        $thanhtien = $soluong * $gia;
                        $tongtien = $thanhtien;
                        ?>
                        <tr>
                            <td class="tenspgiohang">
                            <input type="hidden" name="magh[]">
                                <img src="img/uploads/<?php echo $hinhanh?>" style="border-radius: 4px; " width='80' height='80' alt="">
                                <a class="agiohang" href=""><?php echo $tensp?></a>
                            </td>
                            <td><?php echo number_format(($gia),0,",",".")?>Vnđ</td>
                            <td><?php echo $soluong?><input type="hidden" name="soluong" value="<?php echo $soluong?>"></td>
                            <td><?php echo number_format(($thanhtien),0,",",".")?>Vnđ</td>
                        </tr>
                <tr>
                    <td colspan="3"><b>Tổng tiền:</b></td>
                    <td><?php echo number_format(($tongtien),0,",",".")?>Vnđ</td>
                    <input type="hidden" name="tongtien" value="<?php echo $tongtien?>">
                </tr>
                <tr>
                    <td colspan="3" class="tieude">Phương thức:
                        <select class="select-css" name="phuongthuc">
                            <option value="">Chọn phương thức thanh toán</option>
                            <option value="1">QR Code</option>
                            <option value="2">Thẻ tín dụng/Ghi nợ</option>
                            <option value="3">Thanh toán khi nhận hàng</option>
                        </select>
                    </td>
                    <td>
                        <button class="btnthanhtoan" onclick="kiemtra()" type="submit" name="dathang">Đặt Hàng</button>
                    </td>
                </tr>
            </table>
            </form>
        </center>
    <?php
  }
?>
<div id="thaydoithongtin" 
style="position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    box-shadow: 100px rgba(0, 0, 0, 0.5);
    z-index: 1;
    display: none;
    ">
    <center>
    <h2>Thay đổi thông tin nhận hàng</h2><br>
    </center>
    <form action="" method="post" name="frm" onsubmit="return cntt()">
        <label class="label-thaydoi1" for="ten">Tên:</label>
        <input class="inputthaydoi" type="text" name="ten" id="ten" value="<?php echo $ttkh['tennguoidung']?>"><br><br>
        <label  for="sdt">Số điện thoại:</label>
        <input class="inputthaydoi" type="text" name="sdt" id="sdt" value="<?php echo $ttkh['sodienthoai']?>"><br><br>
        <label class="label-thaydoi" for="diachi">Địa chỉ:</label>
        <input class="inputthaydoi" type="text" name="diachi" id="diachi" value="<?php echo $ttkh['diachi']?>"><br><br>
       <div style="display: flex;
    justify-content: flex-end;" >
        
           <button type="button" onclick="anbang()">Hủy</button>
           <button type="submit"  style="    margin-left: 14px;" name="cnthongtin">Cập nhật</button>
       </div>
    </form>
</div>