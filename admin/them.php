<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoa</title>
</head>

<body>
    <center>
        <h1>Nhập thông tin đào tạo</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table width="20%">
                <tr>
                    <td>mã sản phẩm: </td>
                    <td><input type="text" required name="MaSP" size=""></td>
                </tr>
                <tr>
                    <td>mã loại sản phẩm: </td>
                    <td><input type="text" name="MaLSP" size=""></td>
                </tr>
                <tr>
                    <td>tên sản phẩm: </td>
                    <td><input type="text" name="TenSP" size=""></td>
                </tr>
                <tr>
                    <td>đơn giá: </td>
                    <td><input type="text" name="DonGia" size=""></td>
                </tr>
                <tr>
                    <td>số lượng: </td>
                    <td><input type="text" name="SoLuong" size=""></td>
                </tr>
                <tr>
                    <td>hình ảnh: </td>
                    <td><input type="file" name="HinhAnh" size=""></td>
                </tr>
                <tr>
                    <td>mã khuyến mại: </td>
                    <td><input type="text" name="MaKM" size=""></td>
                </tr>
                <tr>
                    <td>màn hình: </td>
                    <td><input type="text" name="ManHinh" size=""></td>
                </tr>
                <tr>
                    <td>hệ điều hành: </td>
                    <td><input type="text" name="HDH" size=""></td>
                </tr>
                <tr>
                    <td>cam sau: </td>
                    <td><input type="text" name="CamSau" size=""></td>
                </tr>
                <tr>
                    <td>cam trước: </td>
                    <td><input type="text" name="CamTruoc" size=""></td>
                </tr>
                <tr>
                    <td>CPU: </td>
                    <td><input type="text" name="CPU" size=""></td>
                </tr>
                <tr>
                    <td>Ram: </td>
                    <td><input type="text" name="Ram" size=""></td>
                </tr>
                <tr>
                    <td>Rom: </td>
                    <td><input type="text" name="Rom" size=""></td>
                </tr>
                <tr>
                    <td>SD Card: </td>
                    <td><input type="text" name="SDCard" size=""></td>
                </tr>
                <tr>
                    <td>Pin: </td>
                    <td><input type="text" name="Pin" size=""></td>
                </tr>
                <tr>
                    <td>số sao: </td>
                    <td><input type="text" name="SoSao" size=""></td>
                </tr>
                <tr>
                    <td>số đánh giá: </td>
                    <td><input type="text" name="SoDanhGia" size=""></td>
                </tr>
                <tr>
                    <td>trạng thái: </td>
                    <td><input type="text" name="TrangThai" size=""></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="add" value="Add">&emsp;&emsp;&emsp;
                        <input type="Reset" name="" value="Reset">
                        <input type="submit" name="quaylai" value="quaylai">
                    </td>
                </tr>
            </table>
        </form>
    </center>
    <?php
    if (isset($_POST["quaylai"])) {
        header("location:gdad.php");
    }
    ?>
    <?php
    include 'config.php';
    #region test
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $file = $_FILES['HinhAnh'];
    //     $size_allow = 10;
    //     echo '<pre>';
    //     print_r($file);
    //     echo '</pre>';
    //     $error = [];
    //     $filename = $file['name'];
    //     $filename = explode('.', $filename);
    //     $ext = end($filename);
    //     $new_file = md5(uniqid()) . '.' . $ext;
    //     $allow_ext = ['png', 'jpg', 'jpeg', 'gif', 'ppt', 'zip', 'potx', 'doc', 'docx', 'xls', 'xlsx'];
    //     if (in_array($ext, $allow_ext)) {
    //         $size = $file['size'] / 1024 / 1024;
    //         if ($size <= $size_allow) {
    //             $upload = move_uploaded_file($file['tmp_name'], 'img/products/' . $new_file);
    //             if (!$upload) {
    //                 $error = 'upload_err';
    //             }
    //         } else
    //             $error = 'size_err';
    //     } else
    //         $error = 'ext_err';


    //     $MaSP = $_POST["MaSP"];
    //     $MaLSP = $_POST["MaLSP"];
    //     $TenSP = $_POST["TenSP"];
    //     $DonGia = $_POST["DonGia"];
    //     $SoLuong = $_POST["SoLuong"];
    //     $HinhAnh = 'img/products/' . $new_file;
    //     $MaKM = $_POST["MaKM"];
    //     $ManHinh = $_POST["ManHinh"];
    //     $HDH = $_POST["HDH"];
    //     $CamSau = $_POST["CamSau"];
    //     $CamTruoc = $_POST["CamTruoc"];
    //     $CPU = $_POST["CPU"];
    //     $Ram = $_POST["Ram"];
    //     $Rom = $_POST["Rom"];
    //     $SDCard = $_POST["SDCard"];
    //     $Pin = $_POST["Pin"];
    //     $SoSao = $_POST["SoSao"];
    //     $SoDanhGia = $_POST["SoDanhGia"];
    //     $TrangThai = $_POST["TrangThai"];

    //     $sql = Insert($MaSP, $MaLSP, $TenSP, $DonGia, $SoLuong, $HinhAnh, $MaKM, $ManHinh, $HDH, $CamSau, $CamTruoc, $CPU, $Ram, $Rom, $SDCard, $Pin, $SoSao, $SoDanhGia, $TrangThai);
    //     header("location:trangchu.php");
    // }
    #endregion
    if (isset($_POST["add"])) {
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

        $sql = Insert($MaSP, $MaLSP, $TenSP, $DonGia, $SoLuong, $HinhAnh, $MaKM, $ManHinh, $HDH, $CamSau, $CamTruoc, $CPU, $Ram, $Rom, $SDCard, $Pin, $SoSao, $SoDanhGia, $TrangThai);
        header("location:gdad.php");
    }
    ?>
</body>

</html>