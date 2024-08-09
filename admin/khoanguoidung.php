<?php
include '../database/connect.php';
include 'function/function.php';
$tv = mysqli_query($link,"SELECT * from nguoidung where username='{$_GET['idnd']}'");
$check = mysqli_fetch_assoc($tv);
if($check['tinhtrang']==0){
    $delete = "UPDATE nguoidung set tinhtrang=1 where username='{$_GET['idnd']}'";
}else{
    $delete = "UPDATE nguoidung set tinhtrang=0 where username='{$_GET['idnd']}'";
}
$del = mysqli_query($link,$delete);
if ($del)
    echo "<script> window.open('admin.php?admin=hienthind','_self', 0); </script>"
?>