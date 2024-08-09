<?php
include '../database/connect.php';
include 'function/function.php';
$delete = "delete from danhmucsanpham where madanhmucsanpham='{$_GET['madm']}'";
$del = mysqli_query($link,$delete);
if ($del)
    {
        redirect ("admin.php?admin=hienthidm", "Xoa danh mục thành công. ", 1);
    }
    else
        echo "Xóa danh mục thất bại";
?>
