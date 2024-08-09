<html>

<head>
    <title>Upload Files</title>
    <meta charset="utf-8" />
</head>

<body>
    <?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $file = $_FILES['filename'];
        $size_allow = 10;
        echo '<pre>';
        print_r($file);
        echo '</pre>';
        $error = [];
        $filename = $file['name'];
        $filename = explode('.', $filename);
        $ext=end($filename);
        $new_file = md5(uniqid()) . '.' . $ext;
        $allow_ext = ['png', 'jpg', 'jpeg', 'gif', 'ppt', 'zip', 'potx', 'doc', 'docx', 'xls', 'xlsx'];
        if (in_array($ext, $allow_ext)) {
            $size = $file['size'] / 1024 / 1024;
            if ($size <= $size_allow) {
                $upload = move_uploaded_file($file['tmp_name'], 'img/products/' . $new_file);
                if (!$upload) {
                    $error = 'upload_err';
                }
            } else
                $error = 'size_err';
        } else
            $error = 'ext_err';
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="filename" />
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</body>

</html>