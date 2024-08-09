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

function hienbang(masp) {
    var notification = document.getElementById("themspfrm");
    // notification.innerHTML = "<h2>" + message + "</h2>";
    document.getElementById("masp_input").value = masp;
    notification.style.display = "block";
}

// Hàm ẩn thông báo
function anbang() {
    var notification = document.getElementById("themspfrm");
    notification.style.display = "none";
}

</script>
<link rel="stylesheet" href="css/mid.css">
<?php
$select = "select * from sanpham inner join danhmucsanpham on sanpham.madanhmucsanpham=danhmucsanpham.madanhmucsanpham";
$query = mysqli_query($link, $select);
$dem = mysqli_num_rows($query);
?>
<?php 
if(isset($_POST['masp'])){
    $masp = $_POST['masp'];
    $soluong = $_POST['soluong'];
    $ttsptm = mysqli_query($link, "SELECT * from sanpham where masp={$masp}");
    $kqtv = mysqli_fetch_assoc($ttsptm);
    $soluongbandau=$kqtv['soluong'];
    $soluongmoi = $soluong+$soluongbandau;
    mysqli_query($link, "UPDATE sanpham SET soluong='$soluongmoi' WHERE masp='$masp'");
}
?>
<div class="quanly">
    <center>
    <h2 style="background-color:#ECECED; padding: 10px 0px;">QUẢN LÝ SẢN PHẨM</h2>
    <p >Có tổng <font color=red><b><?php echo $dem ?></b></font> sản phẩm</p>

    </center>
    

        
        
        <form action="admin.php?admin=xulysp" method="post">
            <div id="check">			
                    <input class="deletebtn" type="submit" name="xoa" value="Xóa" />
            </div>
            <a class="thembtn" href='?admin=themsp' >Thêm sản phẩm</a>
</div>
<div>
    <center>
    <table id="tbsp">
        <tr class='tieude'>
            <td></td>
            <td>IDSP</td>
            <td>HÌnh ảnh và Tên SP</td>
            <td>Số lượng</td>
            <td>Đã bán</td>
            <td>Giá</td>
            <td>Danh mục</td>
            <td>Active</td>
        </tr>
        <?php

        /*------------Phan trang------------- */
        // kiểm tra biến page đã được khởi tạo trong bộ nhớ của máy tính hay chưa
		// nếu chưa có, đặt mặc định là 1! 
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        // Chọn số kết quả trả về trong mỗi trang mặc định là 10 
        $max_results = 10;

        // Tính số thứ tự giá trị trả về của đầu trang hiện tại 
        $from = (($page * $max_results) - $max_results);

        // Chạy 1 MySQL query để hiện thị kết quả trên trang hiện tại  

        $sql = mysqli_query($link, "SELECT * FROM sanpham inner join danhmucsanpham on sanpham.madanhmucsanpham=danhmucsanpham.madanhmucsanpham ORDER by masp DESC  LIMIT $from, $max_results");




        if ($dem > 0)
            while ($bien = mysqli_fetch_array($sql)) {
                $limit_query = mysqli_query($link, "SELECT * FROM hinhanh WHERE masp = {$bien['masp']} ORDER BY mahinhanh ASC LIMIT 1");
										$row = mysqli_fetch_assoc($limit_query);
										$first_img = $row['hinhanh'];
        ?>
            <tr>
                <td><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?= $bien['masp'] ?>" /></td>
                <td><?php echo $bien['masp'] ?></td>
                <td>
                    <img src="../img/uploads/<?php echo $first_img ?>" width='90' height='90'><br>
                    <h4 style="font-size: 15px;"><?php echo $bien['tensp'] ?></h4>
                </td>
                <td><?php echo $bien['soluong'] ?></td>
                <td><?php echo $bien['daban'] ?></td>
                <td><?php echo number_format($bien['gia']) . ' VNÐ' ?></td>
                <td>

                    <?= $bien['tendanhmuc'] ?>
                </td>
                <td>
                    <button type="button" onclick="hienbang(<?php echo $bien['masp']?>)" class="themspbt" style="background: none;"><i style="color: green; size:15px;" class="fa-solid fa-plus"></i></button><br><br>
                    <a class="icon-suaxoa" href='admin.php?admin=suasp&idsp=<?php echo $bien['masp']  ?>'><i class=" icon-sua1 fa-solid fa-pen-to-square"></i></a>
                </td>
            </tr>
        <?php
            }

        else echo "<tr><td colspan='6'>Không có sản phẩm trong CSDL</td></tr>";

        ?>
    </table></center><br>
    </form>
    <div id="phantrang_sp">
        <center>
        <?php
        // Tính tổng kết quả trong toàn DB:  
        $total_results = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as Num FROM sanpham"));

        // Tính tổng số trang. Làm tròn lên sử dụng ceil()  
        $total_pages = ceil($total_results["Num"] / $max_results);


        // Tạo liên kết đến trang trước trang đang xem 
        if ($page > 1) {
            $prev = ($page - 1);
            echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?admin=hienthisp&page=$prev\"><button class='trang'>Trang trước</button></a>&nbsp;";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if (($page) == $i) {
                if ($i > 1) {
                    echo "$i&nbsp;";
                }
            } else {
                echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?admin=hienthisp&page=$i\"><button class='so'>$i</button></a>&nbsp;";
            }
        }

        // Tạo liên kết đến trang tiếp theo  
        if ($page < $total_pages) {
            $next = ($page + 1);
            echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?admin=hienthisp&page=$next\"><button class='trang'>Trang sau</button></a>";
        }
        echo "</center>";

        ?>
        </center>
        </table>
    </div>
    <div id="themspfrm" 
    style="position: fixed;
    
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    z-index: 9998;
    display: none;
    ">
    <center>
    <h2>Nhập thêm hàng</h2><br>
    </center>
    <form action="" method="post" name="frm">
        <label for="masp">Mã sản phẩm</label>
        <input class="inputthaydoi" type="number" readonly name="masp" id="masp_input" value=""><br><br>
        <label class="label-thaydoi" for="soluong">Số lượng:</label>
        <input class="inputthaydoi" type="number" name="soluong" min=1 id="" value=1><br><br>
        <div style="display: flex;
    justify-content: flex-end;" >
            
            <button type="button" onclick="anbang()" name="huy" style="right: 0%;">Hủy</button>
            <button type="submit"  name="cnthongtin" style="    margin-left: 14px; background-color:green;">Thêm</button>
        </div>
    </form>
</div>