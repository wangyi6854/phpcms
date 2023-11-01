<?php


if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $dir = '/upload/' . date( 'Y/m/d/');
        @mkdir(ROOT.$dir, 0777, true);
        $name = md5(rand(100, 200));
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $filename = $name.'.'.$ext;
        $destination = ROOT . $dir.$filename;
        $location = $_FILES["file"]["tmp_name"];
        move_uploaded_file($location, $destination);
        echo $dir.$filename;
    } else {
        echo $message = '上传文件错误:  '.$_FILES['file']['error'];
    }
}

$direct_output = true;