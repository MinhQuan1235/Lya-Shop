

<?php

if(isset($_GET['admin']))
	switch($_GET['admin'])
	{
		case 'hienthisp':
			include ("sanpham.php");
			break;
		case 'themsp':
			include ("them_sanpham.php");
			break;
		case 'suasp':
			include ("sua_sanpham.php");
			break;
		case 'hienthidm':
			include ("danhmuc.php");
			break;
		case 'themdm':
			include ("them_danhmuc.php");
			break;
		case 'suadm':
			include ("sua_danhmuc.php");
			break;
		case 'xoadm':
			include ("xoa_danhmuc.php");
			break;
		case 'hienthind':
			include ("nguoidung.php");
			break;
		case 'themnd':
			include ("them_nguoidung.php");
			break;
		case 'suand':
			include ("khoanguoidung.php");
			break;
		case 'xoand':
			include ("xoa_nguoidung.php");
			break;
		case 'xulyhd':
			include ("xulyhd.php");
			break;
		case 'hienthitt':
			include ("tintuc.php");
			break;
		case 'themtt':
			include ("them_tintuc.php");
			break;
		case 'suatt':
			include ("sua_tintuc.php");
			break;
		case 'hienthiht':
			include ("hotro.php");
			break;
		case 'hienthihd':
			include ("hoadon.php");
			break;
		case 'chitiethoadon':
			include ("chitiethoadon.php");
			break;
		case 'xulyht':
			include ("xulyht.php");
			break;
		case 'xulysp':
			include ("xulysp.php");
			break;
		case 'xulytt':
			include ("xulytt.php");
			break;
		default:
			include ("sanpham.php");
			break;
	}
	else 
	{
        include ("donhang.php");
	}

?>