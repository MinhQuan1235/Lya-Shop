 <?php
	include('../database/connect.php');
	include('function/function.php');
	$tensp = $_POST['tensp'];
	$gia = $_POST['gia'];
	$mota = $_POST['mota'];
	$khuyenmai = $_POST['khuyenmai'];

	$upload_image = "../img/uploads/";
	$files = isset($_FILES['hinhanh']) ? $_FILES['hinhanh'] : array();
	$fcheck = isset($_FILES['hinhanh']) ? $_FILES['hinhanh'] : null;
	$file = $_FILES['hinhanhchinh'];
	$file_namem = $file['name'];
	$file_tmpm = $file['tmp_name'];
	$file_typem = $file['type'];
	$file_sizem = $file['size'];
	$file_errorm = $file['error'];
	$dmyhism = date("YmdHis");
	$file__name__m = $dmyhism . $file_namem;
	

	$hangsx = $_POST['hangsx'];
	$baohanh = $_POST['baohanh'];
	$madanhmucsanpham = $_POST['madanhmucsanpham'];
	$masp = $_GET['masp'];
	
	if ($file_namem != null) {
		move_uploaded_file($file_tmpm,$upload_image.$file__name__m);
		mysqli_query($link, "UPDATE hinhanh SET hinhanh='$file__name__m' WHERE masp='$masp' LIMIT 1");
		$sql_update = ("
		UPDATE sanpham SET 
		tensp='$tensp',
		mota='$mota',
		gia='$gia',
		khuyenmai='$khuyenmai',
		madanhmucsanpham='$madanhmucsanpham',
		hangsx='$hangsx',
		baohanh='$baohanh'
		WHERE masp='$masp'
	");
	} else {
		$sql_update = ("
		UPDATE sanpham SET 
		tensp='$tensp',
		mota='$mota',
		gia='$gia',
		khuyenmai='$khuyenmai',
		madanhmucsanpham='$madanhmucsanpham',
		hangsx='$hangsx',
		baohanh='$baohanh'
		WHERE masp='$masp'
	");
	}
	//echo $sql_update;
	$update = mysqli_query($link, $sql_update);
	if(count($files['name']) > 1){
		mysqli_query($link, "DELETE FROM hinhanh WHERE masp='$masp' AND mahinhanh NOT IN ( SELECT mahinhanh FROM ( SELECT mahinhanh FROM hinhanh WHERE masp='$masp' LIMIT 1 ) AS subquery );");
		foreach ($files['tmp_name'] as $key => $file_tmp) {
			$file_name = $files['name'][$key];
			$file_type = $files['type'][$key];
			$file_size = $files['size'][$key];
			$file_error = $files['error'][$key];
		
			// Lấy thời gian hiện tại
			$dmyhis = date("YmdHis");
		
			// Tạo tên mới cho file
			$file__name__ = $dmyhis . $file_name;
		
			// Di chuyển file tạm thời đến thư mục đích
			move_uploaded_file($file_tmp, $upload_image . $file__name__);
		
			$ii = mysqli_query($link, "INSERT INTO hinhanh VALUES('', '$masp', '$file__name__')");
		}
	}
	if ($update) {
		redirect("admin.php?admin=hienthisp", "Bạn đã sửa thành công sản phẩm.", 2);
	} else {
		redirect("admin.php?admin=suasp&idsp=$idsp'", "Sửa thất bại", 2);
	}

	?>
