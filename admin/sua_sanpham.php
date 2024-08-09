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

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
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
<link rel="stylesheet" href="css/them_sanpham.css">
<?php
		//include('../include/connect.php');
		$masp=$_GET['idsp'];
        $sql="select * from sanpham where masp=$masp";
         $rows=mysqli_query($link,$sql);
         $row=mysqli_fetch_array($rows);
         $img_querys=mysqli_query($link,"select * from hinhanh where masp={$row['masp']}");
         //$imgs=mysqli_query($link,"select * from hinhanh where masp={$row['masp']}");
         $mimg=mysqli_fetch_assoc($img_querys);
?>
<form action="update_sanpham.php?masp=<?php echo $masp;?>" method="post" name="frm" onsubmit="" enctype="multipart/form-data">
	<table>
			<tr class="tieude_themsp">
				<td colspan=2>Sửa Sản Phẩm </td>
			</tr>
    		<tr>
          <td>Tên SP</td><td><input class="input-tsxoa" type="text" name="tensp" value="<?php echo $row['tensp'] ?>"/></td>
        </tr>
        <tr>
          <td>Hình ảnh chính</td><td class="img_hienthi_sp">
          <img src="../img/uploads/<?=$mimg['hinhanh']?>" width="80" height="80"/>
          <br /><br /><input  type="file" name="hinhanhchinh" require/></td>
        </tr> 
        <tr>
          <td>Hình ảnh phụ (ít nhất 2 hình ảnh)</td><td class="img_hienthi_sp">
          <?php
						while ($img_rows=mysqli_fetch_array($img_querys))
						{
						?>
            <img src="../img/uploads/<?=$img_rows['hinhanh']?>" width="80" height="80"/>
            <?php 
							}
						?>
            <br /><br /><input type="file" name="hinhanh[]" multiple/></td>
        </tr>
        <tr>
          <td>Chi tiết</td><td><textarea id="file-picker" name="mota" rows="15" cols="60"><?php echo $row['mota'] ?></textarea></td>
        </tr>  
        <tr>
          <td>Giá</td><td><input class="input-tsxoa" type="number" name="gia" value="<?php echo $row['gia'] ?>"/></td>
        </tr>
        <tr>
          <td>Giảm giá </td><td><input class="input-tsxoa" type="text" name="khuyenmai" size="1" value="<?php echo $row['khuyenmai'] ?>" /> &nbsp %</td>
        </tr>
        <tr>
        <td >Mã Danh Mục</td><td>
          <?php
            $dm_querys=mysqli_query($link,"select * from danhmucsanpham where madanhmucsanpham={$row['madanhmucsanpham']}");
            $dm=mysqli_fetch_assoc($dm_querys);
          ?>
                	<select class="input-tsxoa" name="madanhmucsanpham">
                	<option  value="<?php echo $dm['madanhmucsanpham']?>"><?php echo $dm['tendanhmuc']?></option>
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
          <td >Hãng Sản Xuất </td><td><input class="input-tsxoa" type="text" name="hangsx" value="<?php echo $row['hangsx'] ?>"/>  </td>
        </tr>
			  <tr>
          <td>Bảo Hành </td><td><input class="input-tsxoa" type="number" min=0 name="baohanh" size="1" value="<?php echo $row['baohanh'] ?>"/> </td>
        </tr>
            <tr>
                <td colspan=2 class="input"> <input type="submit" name="update" value="Update" />
                <input type="reset" name="" value="Hủy" /></td>
            </tr>
        </table> 

</form>
<script type="text/javascript" language="javascript">
 
  CKEDITOR.replace( 'chitiet', {
	uiColor: '#d1d1d1'
});
</script>
