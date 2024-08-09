<link rel="stylesheet" href="css/mid.css">
<?php
    $select = "select * from hotro ";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="quanly">
	<center>
	<h2 style="background-color:#ECECED; padding: 10px 0px;">QUẢN LÝ HỖ TRỢ</h2>
	<p>Có tổng <font color=red><b><?php echo $dem ?></b></font> tin</p>
	<form action="admin.php?admin=xulyht" method="post">
		<div id="check">
			<p>
				<input type="submit" name="xoa" value="Xóa" />

			</p>
		</div></center>
</div>
<center>
<table id="tbhotro">
    
    <tr class='tieude'>
		
		<td><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></td>
        <td>ID</td>
        <td>Chủ đề</td>
        <td>Nội dung</td>
        <td>Tên</td>
        <td>Email</td>
    </tr>

    <?php
	
	/*------------Phan trang------------- */
		// kiểm tra biến page đã được khởi tạo trong bộ nhớ của máy tính hay chưa
		// nếu chưa có, đặt mặc định là 1! 
		if(!isset($_GET['page'])){  
		$page = 1;  
		} else {  
		$page = $_GET['page'];  
		}  

		// Chọn số kết quả trả về trong mỗi trang mặc định là 10 
		$max_results = 10;  

		// Tính số thứ tự giá trị trả về của đầu trang hiện tại 
		$from = (($page * $max_results) - $max_results);  

		// Chạy 1 MySQL query để hiện thị kết quả trên trang hiện tại  

		$sql = mysqli_query($link,"SELECT * FROM hotro LIMIT $from, $max_results"); 



								
    if($dem > 0)
        while ($bien = mysqli_fetch_array($sql))
        {
?>
            <tr class='noidung_hienthi_sp'>
				<td class="masp_hienthi_sp"><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?=$bien['idht']?>"/></td>
                <td class="masp_hienthi_sp"><?php  echo $bien['idht'] ?></td>
                <td class="stt_hienthi_sp"><?php echo $bien['chude'] ?></td>
                <td class="img_hienthi_sp"> <?php echo $bien['noidung'] ?>  </td>
				<td class="sl_hienthi_sp"><?php echo $bien['hoten'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['email'] ?></td>
			</tr>
<?php 
    }
	
    else echo "<tr><td colspan='6'>Không có tin nào</td></tr>";
	
?>
</table></center>
</form>
	<div id="phantrang_sp">
	<center>
	<?php
			// Tính tổng kết quả trong toàn DB:  
			$total_results = mysqli_fetch_array(mysqli_query($link,"SELECT COUNT(*) as Num FROM hotro"));  

			// Tính tổng số trang. Làm tròn lên sử dụng ceil()  
			$total_pages = ceil($total_results["Num"] / $max_results);

			// Tạo liên kết đến trang trước trang đang xem 
			if($page > 1){  
			$prev = ($page - 1);  
			echo "<a href=\"".$_SERVER['PHP_SELF']."?admin=hienthiht&page=$prev\"><button class='trang'>Trang trước</button></a>&nbsp;";  
			}  

			for($i = 1; $i <= $total_pages; $i++){  
			if(($page) == $i){  
				if($i>1) {
					echo "$i&nbsp;";  } 
			} else {  
			echo "<a href=\"".$_SERVER['PHP_SELF']."?admin=hienthiht&page=$i\"><button class='so'>$i</button></a>&nbsp;";  
			}  
			}  

			// Tạo liên kết đến trang tiếp theo  
			if($page < $total_pages){  
			$next = ($page + 1);  
			echo "<a href=\"".$_SERVER['PHP_SELF']."?admin=hienthiht&page=$next\"><button class='trang'>Trang sau</button></a>";  
			}  
			echo "</center>";  		
		
	?>
	</center>
	</div>
<script language="JavaScript">
    function checkdel(idht)
    {
        var	idht=idht;
        if(confirm("Bạn có chắc chắn muốn xóa tin này?")==true)
            window.open(link,"_self",1);
    }
</script>