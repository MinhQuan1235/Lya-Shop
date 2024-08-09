<?php
	if(isset($_POST['mahd']))
	{
	foreach($_POST['mahd'] as $mahd)
	{
		$_SESSION['id'][$mahd]=1;
	}
	

		if(isset($_POST['giaohang']))
		{
			foreach($_SESSION['id'] as $mahd=>$value)
			{
				$check=mysqli_query($link,"SELECT * from hoadon where mahd='$mahd'");
				$tt = mysqli_fetch_assoc($check);
				if($tt['tinhtrang']==0){
					$cthd = mysqli_query($link,"SELECT * from chitiethoadon where mahd='$mahd'");
					while($row=mysqli_fetch_array($cthd))
					{
						$masp = $row['masp'];
						$soluong = $row['soluong'];
						$tvsp = mysqli_query($link,"SELECT * from sanpham where masp={$masp}");
						$dlsp = mysqli_fetch_assoc($tvsp);
						$dadat = $dlsp['dadat'];
						$daban = $dlsp['daban'];
						$dadatmoi = $dadat-$soluong;
						$dabanmoi = $daban+$soluong;
						mysqli_query($link,"UPDATE sanpham set daban='$dabanmoi',dadat='$dadatmoi' where masp='$masp'");
					}
				if ($value==1)
				$sql="update hoadon set tinhtrang=1 where mahd='$mahd'";
				mysqli_query($link,$sql);
				unset($_SESSION['id']);
				echo "
						<script language='javascript'>
							alert('Đã giao hàng');
							window.open('admin.php?admin=hienthihd','_self', 1);
						</script>
					";}
					else{
						echo "
						<script language='javascript'>
							alert('Đơn hàng đã được xử lý trước đó');
							window.open('admin.php?admin=hienthihd','_self', 1);
						</script>
					";
				}
			}
		}
		else if(isset($_POST['huy']))
			{ 
				foreach($_SESSION['id'] as $mahd=>$value)
				{
					$check=mysqli_query($link,"SELECT * from hoadon where mahd='$mahd'");
				$tt = mysqli_fetch_assoc($check);
				if($tt['tinhtrang']==0){
					$cthd = mysqli_query($link,"SELECT * from chitiethoadon where mahd='$mahd'");
					while($row=mysqli_fetch_array($cthd))
					{
						$masp = $row['masp'];
						$soluong = $row['soluong'];
						$tvsp = mysqli_query($link,"SELECT * from sanpham where masp={$masp}");
						$dlsp = mysqli_fetch_assoc($tvsp);
						$dadat = $dlsp['dadat'];
						$dadatmoi = $dadat-$soluong;
						mysqli_query($link,"UPDATE sanpham set dadat='$dadatmoi' where masp='$masp'");
					}
					if ($value==1)
					$sql="update hoadon set tinhtrang=2 where mahd='$mahd'";
					mysqli_query($link,$sql);
					unset($_SESSION['id']);
					echo "
							<script language='javascript'>
								alert('Đã huỷ đơn hàng');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";}
						else{
							echo "
							<script language='javascript'>
								alert('Đơn hàng đã được xử lý trước đó');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";
						}
				}
			}
			else
					{
						foreach($_SESSION['id'] as $mahd=>$value)
						{
							if ($value==1)
							$sql="delete from hoadon where mahd='$mahd'";
							mysqli_query($link,$sql);
							$sql1="delete from chitiethoadon where mahd='$mahd'";
							mysqli_query($link,$sql1);
							unset($_SESSION['id']);
							echo "
							<script language='javascript'>
								alert('Xóa thành công');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";
						}
			
					}

			}		else echo "
							<script language='javascript'>
								alert('Bạn chưa chọn hóa đơn cần xử lý');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";
		
?>