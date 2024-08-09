<link rel="stylesheet" href="css/mid.css">
<?php
    $nguoidung = mysqli_query($link, "SELECT * FROM nguoidung WHERE phanquyen = 1");
    $dem = mysqli_num_rows($nguoidung);
?>
<div class="quanly">
    <center>
    <h2 style="background-color:#ECECED; padding: 10px 0px;">QUẢN LÝ NGƯỜI DÙNG</h2>
	<p>Có tổng <font color=red><b><?php echo $dem ?></b></font> người dùng</p></center>
</div>
<center>
<?php if($dem>0){
    ?>
<table id="tbhotro">
    
    <tr class='tieude'>
        <td>STT</td>
        <td>Tên người dùng</td>
        <td>Username</td>
        <td>Email</td>
        <td>Điện thoại</td>
        <td>Active</td>
    </tr>
    <?php
                    while($nd=mysqli_fetch_array($nguoidung)){
                        $stt = 1;
                ?>
    <tr class='noidung_hienthi_sp'>
                <td class="masp_hienthi_sp"><?php echo $stt ?></td>
                <td class="stt_hienthi_sp"><?php echo $nd['tennguoidung'] ?></td>
                <td class="img_hienthi_sp"><?php echo $nd['username'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $nd['email'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $nd['sodienthoai'] ?></td>
                <td class="active_hienthi_sp">
                    <?php if($nd['tinhtrang']==0){ ?>
                        <a class="icon-suaxoa" href='?admin=suand&idnd=<?php echo $nd['username'] ?>'><i class="icon-sua1 fa-solid fa-lock-open"></i></a>
                    <?php } else{?>
                        <a class="icon-suaxoa" href='?admin=suand&idnd=<?php echo $nd['username'] ?>'><i class="icon-sua1 fa-solid fa-lock"></i></a>
                    <?php } ?>
                    <a class="icon-suaxoa" href='?admin=xoand&idnd=<?php echo $nd['username'] ?>'><i class="icon-xoa1 fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php 
                    $stt++;
                    } ?>
            <tr>
</table>
<?php } ?>
</center>