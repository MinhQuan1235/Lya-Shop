<link rel="stylesheet" href="css/mid.css">
<?php
	$donhang = mysqli_query($link, "SELECT * FROM hoadon ORDER BY tinhtrang");
    $dem = mysqli_num_rows($donhang);
?>
<div class="quanly">
	<center>
	<h2 style="background-color:#ECECED; padding: 10px 0px;">QUẢN LÝ HÓA ĐƠN</h2>
	<p>Có tổng <font color=red><b><?php echo $dem ?></b></font> hóa đơn</p><br>
	<form action="admin.php?admin=xulyhd" method="post">
		<div id="check">
			<p><input class="deletebtn"type="submit" name="huy" value="Hủy" />
				<input class="deletebtn" type="submit" name="xoa" value="Xóa" />
				<input class="thembtn"type="submit" name="giaohang" value="Đã giao hàng" />
				

			</p>
		</div>
	</center>
</div>
<center>
	<?php if($dem>0){
		?>
<table id="tbhotro">
    
    <tr class='tieude'>
        <td></td>
        <td>STT</td>
        <td>Họ Tên</td>
        <td>Địa Chỉ</td>
        <td>Điện Thoại</td>
        <td>Đơn giá</td>
        <td>Trạng thái</td>
        <td colspan=2>Active</td>
    </tr>

    <?php
		$stt = 1;
		while($dh=mysqli_fetch_array($donhang)){
	?>
            <tr class='noidung_hienthi_sp'>
                <td class="masp_hienthi_sp"><input type="checkbox" name="mahd[]" class="item" class="checkbox" value="<?php echo $dh['mahd']; ?>"/></td>
                <td class="masp_hienthi_sp"><?php  echo $stt ?></td>
                <td class="stt_hienthi_sp"><?php echo $dh['tenkhachhang'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $dh['diachi'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $dh['sodienthoai'] ?></td>
				<td class="sl_hienthi_sp"><?php echo number_format($dh['dongia'], 0, ',', '.') ?> Vnđ</td>
				<td class="sl_hienthi_sp"><?php if($dh['tinhtrang']==0) echo "Đang xử lý"; else if($dh['tinhtrang']==1) echo"Đã giao hàng"; else echo"Đã hủy đơn hàng";?></td>
				<td class="active_hienthi_sp" style="width:70px;">
				<a class="chitiet-icon" href="admin.php?admin=chitiethoadon&mahd=<?php echo $dh['mahd']; ?> " ><i class="fa-solid fa-circle-info"></i> Chi tiết</a>
					
				</td>
            </tr>
	<?php 
	$stt++;
	}
	?>
</table>
<?php }
else{
	?>
	<h1>Chưa có đơn hàng nào</h1>
	<?php
}
?>
</center>