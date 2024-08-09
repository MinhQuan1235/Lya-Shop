<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="../css/sua.css">
</head>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
?>

<?php
$sql = "SELECT * FROM sanpham WHERE MaSP = '$id'";
$result = Connect()->query($sql);
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
?>
<?php
if (isset($_POST["sua"])) {
    $file = $_FILES['HinhAnh'];
    $size_allow = 10;
    echo '<pre>';
    print_r($file);
    echo '</pre>';
    $error = [];
    $filename = $file['name'];
    $filename = explode('.', $filename);
    $ext = end($filename);
    $new_file = md5(uniqid()) . '.' . $ext;
    $size = $file['size'] / 1024 / 1024;
    if ($size <= $size_allow) {
        $upload = move_uploaded_file($file['tmp_name'], '../img/products/' . $new_file);
        if (!$upload) {
            $error = 'upload_err';
        }
    } else
        $error = 'size_err';


    $MaSP = $_POST["MaSP"];
    $MaLSP = $_POST["MaLSP"];
    $TenSP = $_POST["TenSP"];
    $DonGia = $_POST["DonGia"];
    $SoLuong = $_POST["SoLuong"];
    $HinhAnh = 'img/products/' . $new_file;
    $MaKM = $_POST["MaKM"];
    $ManHinh = $_POST["ManHinh"];
    $HDH = $_POST["HDH"];
    $CamSau = $_POST["CamSau"];
    $CamTruoc = $_POST["CamTruoc"];
    $CPU = $_POST["CPU"];
    $Ram = $_POST["Ram"];
    $Rom = $_POST["Rom"];
    $SDCard = $_POST["SDCard"];
    $Pin = $_POST["Pin"];
    $SoSao = $_POST["SoSao"];
    $SoDanhGia = $_POST["SoDanhGia"];
    $TrangThai = $_POST["TrangThai"];
    $sql = Update($MaSP, $MaLSP, $TenSP, $DonGia, $SoLuong, $HinhAnh, $MaKM, $ManHinh, $HDH, $CamSau, $CamTruoc, $CPU, $Ram, $Rom, $SDCard, $Pin, $SoSao, $SoDanhGia, $TrangThai, $id);
    header("location:gdad.php");
    return $conn->query($sql);
    $conn->close();
}
?>


<?php
if (isset($_POST["quaylai"])) {
    header("location:gdad.php");
}
?>

<body>
    <center>
        <h1>Sửa thông tin</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php
            foreach ($data as $value) :
            ?>
                <table border="5" id="sua">
                    <tr align="center">
                        <th>mã sản phẩm</th>
                        <th>mã loại sản phẩm</th>
                        <th>tên sản phẩm</th>
                        <th>đơn giá</th>
                        <th>số lượng</th>
                        <th colspan="2">hình ảnh</th>
                        <th>mã khuyến mại</th>
                        <th>màn hình</th>
                        <th>hệ điều hành</th>
                    </tr>
                    <td><textarea name="MaSP" style="width:100px; height:200px;"><?php echo $value['MaSP']; ?></textarea></td>
                    <td><textarea name="MaLSP" style="width:100px; height:200px;"><?php echo $value['MaLSP']; ?></textarea></td>
                    <td><textarea name="TenSP" style="width:100px; height:200px;"><?php echo $value['TenSP']; ?></textarea></td>
                    <td><textarea name="DonGia" style="width:100px; height:200px;"><?php echo $value['DonGia']; ?></textarea></td>
                    <td><textarea name="SoLuong" style="width:100px; height:200px;"><?php echo $value['SoLuong']; ?></textarea></td>
                    <td colspan="2">><img src="../<?php echo $value['HinhAnh']; ?>" alt="" width="200px">
                        <input type="file" name="HinhAnh" size="" value="<?php echo $value['HinhAnh']; ?>">
                    </td>
                    <td><textarea name="MaKM" style="width:100px; height:200px;"><?php echo $value['MaKM']; ?></textarea></td>
                    <td><textarea name="ManHinh" style="width:100px; height:200px;"><?php echo $value['ManHinh']; ?></textarea></td>
                    <td><textarea name="HDH" style="width:100px; height:200px;"><?php echo $value['HDH']; ?></textarea></td>
                    </tr>
                    <tr>
                    <th>cam sau</th>
                        <th>cam trước</th>
                        <th>CPU</th>
                        <th>Ram</th>
                        <th>Rom</th>
                        <th>SD Card</th>
                        <th>Pin</th>
                        <th>số sao</th>
                        <th>số đánh giá</th>
                        <th>trạng thái</th>
                    </tr>
                    <tr>
                    <td><textarea name="CamSau" style="width:100px; height:200px;"><?php echo $value['CamSau']; ?></textarea></td>
                    <td><textarea name="CamTruoc" style="width:100px; height:200px;"><?php echo $value['CamTruoc']; ?></textarea></td>
                    <td><textarea name="CPU" style="width:100px; height:200px;"><?php echo $value['CPU']; ?></textarea></td>
                    <td><textarea name="Ram" style="width:100px; height:200px;"><?php echo $value['Ram']; ?></textarea></td>
                    <td><textarea name="Rom" style="width:100px; height:200px;"><?php echo $value['Rom']; ?></textarea></td>
                    <td><textarea name="SDCard" style="width:100px; height:200px;"><?php echo $value['SDCard']; ?></textarea></td>
                    <td><textarea name="Pin" style="width:100px; height:200px;"><?php echo $value['Pin']; ?></textarea></td>
                    <td><textarea name="SoSao" style="width:100px; height:200px;"><?php echo $value['SoSao']; ?></textarea></td>
                    <td><textarea name="SoDanhGia" style="width:100px; height:200px;"><?php echo $value['SoDanhGia']; ?></textarea></td>
                    <td><textarea name="TrangThai" style="width:100px; height:200px;"><?php echo $value['TrangThai']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="10" align="center"><input type="submit" name="sua" value="sua">&emsp;&emsp;&emsp;
                            <input type="submit" name="quaylai" value="quaylai">
                        </td>
                    </tr>
                <?php
            endforeach;
                ?>
                </table>
        </form>
    </center>
</body>

</html>