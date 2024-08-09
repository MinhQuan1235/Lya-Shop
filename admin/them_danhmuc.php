<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm Danh Mục</title>
<link rel="stylesheet" href="css/them_sanpham.css" />
</head>

<body>
<?php
	include '../database/connect.php';
 

if(isset($_POST['btnthem']))
{
	$tendm=$_POST['tendm'];
	$dequi=$_POST['dequi'];
	$insertdm = mysqli_query($link,"INSERT INTO danhmucsanpham VALUES('', '$tendm', '$dequi') ");
	if($insertdm) {
		
		echo "<p align = center>Thêm danh muc <font color='red'><b> $tendm </b></font> thành công!</p>";
		echo '<meta http-equiv="refresh" content="1;url=admin.php?admin=hienthidm">';
	}
	else {
		echo "Thêm thất bại";
	}
}
?>

<form action="" method="post">
	<table>
		<tr class="tieude_themsp">
				<td colspan=2>Thêm Danh Mục </td>
			</tr>
		<tr>
        	<td>Mã danh mục</td><td><input class="input-tsxoa" type="text" disabled="disabled" name="madm" size="5" /></td>
		</tr>
		<tr>
    		<td>Tên danh mục</td><td><input class="input-tsxoa" type="text" name="tendm" /></td>
		</tr>
		<tr>
            <td>Thuộc</td>
			<td>
            	<select class="input-tsxoa" name="dequi">
                	<option value="0">Danh mục chính</option>
                    <?php
						$show = mysqli_query($link,"SELECT * FROM danhmucsanpham WHERE phanlop=0");
						while($show1 = mysqli_fetch_array($show))
						{
							$madm = $show1['madanhmucsanpham'];	
							$tendm = $show1['tendanhmuc'];
							echo "<option value='".$madm."'>".$tendm."</option>";	
								$show2 = mysqli_query($link,"SELECT * FROM danhmucsanpham WHERE phanlop='".$madm."'");
								// while($show3 = mysqli_fetch_array($show2))
								// {
								// 	$madm1 = $show3['madanhmucsanpham'];	
								// 	$tendm1 = $show3['tendanhmuc'];
								// 	echo "<option value='".$madm1."'> - ".$tendm1."</option>";
								// }
						}
							
					?>
                </select>
			</td>
		</tr>
		<tr>
			<td colspan=2 class="input">
            <input class="button1" type="submit" name="btnthem" value="Thêm" />
            <input class="button1" type="reset" name="" value="Hủy" />
			</td>
		</tr>
       </table>    
</form>




</body>
</html>