<link rel="stylesheet" href="css/mid_insert.css">


	
	<?php
	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	} else $action = "";
	if (isset($_GET['content'])) {
		switch ($_GET['content']) {
			case "dangky":
				include('dangky.php');
				break;
				case "dangnhap":
				include('dangnhap.php');
				break;
				case "chitietsp":
				include('chitietsp.php');
				break;
				case "sanpham":
				include('sanpham.php');
				break;
				case "danhmucsanpham":
				include('danhmucsanpham.php');
				break;
				case "giohang":
				include('giohang.php');
				break;
				case "ttkh-thanhtoan":
				include('ttkh-thanhtoan.php');
				break;
				case "timkiemsanpham":
				include('timkiemsanpham.php');
				break;
				case "xemthem":
				include('xemthem.php');
				break;
				}
	} else {
		include('sanpham.php');
	}
	?>
	
	<div class="footer">
		<?php  include("index_insert/footer.php")?>
	</div>
	
	
	
   
