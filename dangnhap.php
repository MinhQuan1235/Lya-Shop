<link rel="stylesheet" href="css/dangnhap.css">
<div class="formdangnhap" id="login">
    <!-- <h1 style="padding-top: 60px; display: flex; justify-content: center;">Đăng Nhập</h1> -->
    <form class="dncss" action="" method="post">
        <div class="form-container">
        
				<i  class="logo-icon1 fa-solid fa-fish"></i>
			
            <div class="form-group">
                <label for="taikhoan">Tài Khoản:</label>
                <input type="text" name="taikhoan" id="taikhoan" required>
            </div>
            <div class="form-group">
                <label for="matkhau">Mật Khẩu:</label>
                <input type="password" name="matkhau" id="matkhau" required>
            </div>
            <div class="button-container">
                <button type="submit" name="dangnhap" class="dnbt" >Đăng Nhập</button>
            </div>
    </form>
    <div class="button-container">
        Bạn chưa có tài khoản? Đăng ký <a href="index.php?content=dangky" id="dangkybt"> tại đây</a>
    </div>
    </div>
</div>

<?php
// khi nguoi dung nhan dang nhap se thuc hien kiem tra
if (isset($_POST["dangnhap"])) {
    // dat gia tri cho $tk vaf $mk chuyen gia tri $mk sang MD5
    $tk = $_POST['taikhoan'];
    $mk = MD5($_POST['matkhau']);
    // lay ket qua nguoi dung co usermane = $tk va password = $mk
    $query1 = mysqli_query($link, "SELECT * from nguoidung where username = '$tk' and password = '$mk'");
    $row = mysqli_fetch_array($query1);

    // kiem tra xem $query cho gia tri nao duoc liet ke ra hay k
    // neu check > 0 dong nghia voi viec co tai khoan dung
    $check = mysqli_num_rows($query1);
    // check = 0 dong nghia voi viec k co tai khoan dung hoac tk mk sai
    // check = 1 ktra quyen cua tai khoan
    if ($check == 0)
        echo "
                <script language='javascript'>
                    alert('thông tin đăng nhập không chính xác');
                    window.open('index.php?content=dangnhap','_self', 1);
                </script>
            ";
    else {
        // luu gia tri cua usermane = gia tri cua tai khoan vua nhap
        // luu gia tri phanquan = phan quyen cua tai khoan trong sql
        // luu id nguoi dung = idnd cua tai khoan trong sql
        $_SESSION['phanquyen'] = $row['phanquyen'];
        // neu phan quyen = 0 day la tai khoan cua admin => dan den trang admin
        // neu phan quyen khac 0 day la tai khoan cua khach hang => dan den trang chu
        if ($_SESSION['phanquyen'] == 0) {
            $_SESSION['username'] = $_POST['taikhoan'];
            $_SESSION['idnd'] = $row['idnd'];
            echo "
                    <script language='javascript'>
                        alert('Chào mừng chủ nhân trở lại');
                        window.open('admin/admin.php','_self', 1);
                    </script>
                ";
        } else if($_SESSION['phanquyen'] != 0 && $row['tinhtrang']==0){
            $_SESSION['username'] = $_POST['taikhoan'];
            $_SESSION['idnd'] = $row['idnd'];
            echo "
                    <script language='javascript'>
                        alert('Đăng nhập thành công');
                        window.open('index.php','_self', 1);
                    </script>
                ";
        }else{
            echo "
                    <script language='javascript'>
                        alert('Tài khoản bị khóa');
                        window.open('index.php?content=dangnhap','_self', 1);
                    </script>
                ";
        }
    }
}
?>