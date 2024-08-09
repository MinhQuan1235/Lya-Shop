  <?php
	include('../database/connect.php');
	include('function/function.php');


	$tennd = $_POST['tennd'];
	$user = $_GET['idnd'];
	$email = $_POST['email'];
	$dienthoai = $_POST['dienthoai'];
	$sql_update = ("
		UPDATE nguoidung SET
							tennguoidung='$tennd',
							email='$email',
							sodienthoai='$dienthoai'
							where username='$user'
	");
	$update = mysqli_query($link, $sql_update);
	if ($update) {
		redirect("admin.php?admin=hienthind", "Bạn đã sửa thành công người dùng.", 2);
	} else {
		redirect("admin.php?admin=suand&idnd=$user", "Sửa thất bại", 2);
	}

	?>