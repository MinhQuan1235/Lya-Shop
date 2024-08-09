<link rel="stylesheet" href="css/mid.css">
<div id="quanlydanhmuc">
    <center>
    <h2 style="background-color:#ECECED; padding: 10px 0px;">TỔNG QUAN</h2>
    <?php
        $soluongsanpham = mysqli_query($link, "SELECT * FROM sanpham");
        $soluongnguoidung = mysqli_query($link, "SELECT * FROM nguoidung WHERE phanquyen = 1");
        $doanhthu_query = mysqli_query($link, "SELECT SUM(dongia) AS total_dongia FROM hoadon");
        $doanhthu_result = mysqli_fetch_assoc($doanhthu_query);
        $doanhthu = $doanhthu_result['total_dongia'];
        $donhangdaban = mysqli_query($link, "SELECT * FROM hoadon WHERE tinhtrang = 1");
        ////////////////////////////
        $donhangchuaxuly = mysqli_query($link, "SELECT * FROM hoadon WHERE tinhtrang = 0");
    ?>
    
    <div class="dashboad">
        <div style="background-color:#45AAF2" class="thongtin"><i class=" icon-dh fa-solid fa-cart-shopping"></i>Số lượng sản phẩm: <?php echo mysqli_num_rows($soluongsanpham)?></div>
        <div style="background-color:#F96D6B" class="thongtin"><i class=" icon-dh fa-solid fa-users"></i>Tổng người dùng: <?php echo mysqli_num_rows($soluongnguoidung)?></div>

        <div style="background-color:#27DE80" class="thongtin"><i class=" icon-dh fa-solid fa-dollar-sign"></i>Doanh Thu: <?php echo number_format($doanhthu, 0, ',', '.') ?> Vnđ</div>
        <div style="background-color:#45AAF2" class="thongtin"><i class=" icon-dh fa-solid fa-check"></i>Đơn hàng giao thành công: <?php echo mysqli_num_rows($donhangdaban)?></div>

        
    </div>
    <h2 style="background-color:#ECECED; padding: 10px 0px;">ĐƠN HÀNG CẦN ĐƯỢC XỬ LÝ</h2>
            <?php if(mysqli_num_rows($donhangchuaxuly)>0)
                {?>
        <table id="tbdonhang">
            
            <tr>
                <td class="tieude">STT</td>
                <td class="tieude">Họ tên</td>
                <td class="tieude">Địa chỉ</td>
                <td class="tieude">Điện thoại</td>
                <td class="tieude">Đơn giá</td>
                <td class="tieude">Ngày đặt hàng</td>
            </tr>
                <?php
                    while($dh=mysqli_fetch_array($donhangchuaxuly)){
                        $stt = 1;
                ?>
                    <tr>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $dh['tenkhachhang'] ?></td>
                        <td><?php echo $dh['diachi'] ?> </td>
                        <td><?php echo $dh['sodienthoai'] ?> </td>
                        <td><?php echo number_format($dh['dongia'], 0, ',', '.') ?> Vnđ </td>
                        <td><?php echo $dh['ngaydathang'] ?></td>
                    </tr>
            <?php 
                    $stt++;
                    } ?>
            <tr>
                <td colspan=6 align="right" ><a style="font-size: 23px;" class="chitiet-icon" href="admin.php?admin=hienthihd">Chi tiết</a></td>
            </tr>
        </table>
                    <?php
                }
                else {
            ?>
                <h1>Không có đơn hàng nào cần xử lý</h1>
            <?php
                }
            ?>
    </center>
</div>