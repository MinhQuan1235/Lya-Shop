<?php include "config.php" ?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
?>
<?php
$sql = "SELECT * FROM sanpham WHERE masp = '$id'";
$result = Connect()->query($sql);
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
?>
<?php
$sql = Delete($id);
header("location:trangchu.php");
?>