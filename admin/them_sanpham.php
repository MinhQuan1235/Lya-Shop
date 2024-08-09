<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm Sản Phẩm</title>
<link rel="stylesheet" href="css/them_sanpham.css" />
<script src="https://cdn.tiny.cloud/1/ibvjrrqh7plwkxpj01agtf0jd5ldtv6n00c1g9nk5kj6hhcq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  
tinymce.init({
  selector: 'textarea#file-picker',
  plugins: 'image code',
  toolbar: 'undo redo | link image | code',
  /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});

</script>
</head>

<body>
<?php
	include '../database/connect.php';

	if(isset($_POST['submit']))
	{
		$ten_sanpham=$_POST['tensp'];
		$gia=$_POST['gia'];
		$mota=$_POST['mota'];
		$soluong=$_POST['soluong'];
		$khuyenmai=$_POST['khuyenmai'];
		$hangsx=$_POST['hangsx'];
		$baohanh=$_POST['baohanh'];
	//	$hinhanh=$_POST['hinhanh'];
		$upload_image="../img/uploads/";
		$files = isset($_FILES['hinhanh']) ? $_FILES['hinhanh'] : array();
		$file = isset($_FILES['hinhanhchinh']);
		$madm=$_POST['madanhmucsanpham'];
		$insert="INSERT INTO sanpham VALUES('', '$ten_sanpham', '$mota', '$soluong', '$gia', '$khuyenmai', '$madm', '$hangsx','$baohanh','0','0','0')";
		$query=mysqli_query($link,$insert);
		// Lấy giá trị masp của dòng cuối cùng
		if($query) {
			$limit_query = mysqli_query($link, "SELECT * FROM sanpham ORDER BY masp DESC LIMIT 1");
			$row = mysqli_fetch_assoc($limit_query);
			$last_masp = $row['masp'];
			//
			$file = $_FILES['hinhanhchinh'];
			$file_namem = $file['name'];
			$file_tmpm = $file['tmp_name'];
			$file_typem = $file['type'];
			$file_sizem = $file['size'];
			$file_errorm = $file['error'];
			$dmyhism = date("YmdHis");
			$file__name__m = $dmyhism . $file_namem;
			move_uploaded_file($file_tmpm,$upload_image.$file__name__m);
			$iim = mysqli_query($link, "INSERT INTO hinhanh VALUES('', '$last_masp', '$file__name__m')");
			//
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
			
				$ii = mysqli_query($link, "INSERT INTO hinhanh VALUES('', '$last_masp', '$file__name__')");
			}
			echo "<p align = center>Thêm sản phẩm thành công!</p>";
			echo '<meta http-equiv="refresh" content="1;url=admin.php?admin=themsp">';
		}
			else { echo "Thất bại";
		}
}


		
?>
<form action="" method="post" enctype="multipart/form-data" name="frm" onsubmit="return kiemtra()">
	
      <table>
			<tr class="tieude_themsp">
				<td colspan=2>Thêm Sản Phẩm </td>
			</tr>
    		<tr>
            	<td>Tên SP</td><td><input class="input-tsxoa" type="text"  size="30" name="tensp"/></td>
            </tr>
			<tr>
				<td>Hình ảnh chính</td><td><input  type="file" name="hinhanhchinh" require/></td>
            </tr> 
            <tr>
				<td>Hình ảnh khác</td><td><input  type="file" name="hinhanh[]" multiple /></td>
            </tr> 
            <tr>
            	<td>Chi tiết</td><td><textarea id="file-picker" name="mota"></textarea></td>
				<!-- <td>Chi tiết</td><td><?php include "text."?></td> -->
            </tr>
			<tr>
            	<td>Số lượng</td><td><input class="input-tsxoa" type="number" min=0 name="soluong" size="5"/></td>
            </tr>
            <tr>
            	<td>Giá</td><td><input class="input-tsxoa" type="text" name="gia"/></td>
            </tr>
			<tr>
            	<td>Giảm giá </td><td><input class="input-tsxoa" type="text" name="khuyenmai" size="1"/> &nbsp %</td>
            </tr>
            <tr>
            	<td >Mã Danh Mục</td><td>
                	<select class="input-tsxoa" name="madanhmucsanpham">
                	<option  value="">Chọn Danh Mục</option>
                    <?php
						$show = mysqli_query($link,"SELECT * FROM danhmucsanpham WHERE phanlop=0");
						while($show1 = mysqli_fetch_array($show))
						{
							$madm1 = $show1['madanhmucsanpham'];	
							$tendm1 = $show1['tendanhmuc'];
							// echo "<option value='".$madm1."'>".$tendm1."</option>";	
								$show2 = mysqli_query($link,"SELECT * FROM danhmucsanpham WHERE phanlop='".$madm1."'");
								while($show3 = mysqli_fetch_array($show2))
								{
									$madm2 = $show3['madanhmucsanpham'];	
									$tendm2 = $show3['tendanhmuc'];
									echo "<option value='".$madm2."'> - ".$tendm2."</option>";
								}
						}
                	?>
                
                
                </td>
            </tr>
			<tr>
            	<td >Hãng Sản Xuất </td><td><input class="input-tsxoa" type="text" name="hangsx" />  </td>
            </tr>
			<tr>
            	<td>Bảo Hành </td><td><input class="input-tsxoa" type="number" min=0 name="baohanh" size="1"/> </td>
            </tr>
            <tr>
                <td colspan=2 class="input"> <input type="submit" class="button1" name="submit" value="Thêm" />
                <input class="button1" type="reset" name="" value="Hủy" /></td>
            </tr>
         </table>  
</form>


</body>
</html>

<script language="javascript">
 	function  kiemtra()
	{
	    
		if(frm.tensp.value=="")
	 	{
			alert("Bạn chưa nhập tên SP. Vui lòng kiểm tra lại");
			frm.tensp.focus();
			return false;	
		}
		if(frm.hinhanh.value=="")
		{
			alert("Bạn chưa chọn hình ảnh");	
			frm.hinhanh.focus();
			return false;
		}
		if(frm.soluong.value=="")
		{
			alert("Bạn chưa nhập số lượng");	
			frm.soluong.focus();
			return false;
		}
		if(frm.madm.value=="")
		{
			alert("Bạn chưa chọn danh mục");	
			frm.madm.focus();
			return false;
		}
	}
 </script>