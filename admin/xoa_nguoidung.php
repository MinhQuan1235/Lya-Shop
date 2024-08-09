 <?php
include '../database/connect.php';
include 'function/function.php';
$delete = "delete from nguoidung where username='{$_GET['idnd']}'";
$del = mysqli_query($link,$delete);
if ($del)
	//echo "thanh cong";
	//header("location: index.php?admin=hienthind");
	redirect ("admin.php?admin=hienthind", "Xóa người dùng thành công. ", 1);
	else
	echo "Xóa người dùng thất bại";
?>