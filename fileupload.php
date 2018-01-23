<?php
header('Access-Control-Allow-Origin:*');
// header("Content-Length: 27");

// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "JPG", "png", "rar", "zip", "bz2");

$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp); // 获取文件后缀名
if (((true || $_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "application/x-rar")
    || ($_FILES["file"]["type"] == "application/zip")
    || ($_FILES["file"]["type"] == "application/x-bzip")
)) {
    if ($_FILES["file"]["error"] > 0) {
        echo json_encode(array('file_error' => $_FILES["file"]["error"]));
        // echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    } else {

        // 判断当前目录下uploadForME文件夹是否存在
        if (!file_exists("./uploadForME")) {
            mkdir(iconv('utf-8', 'gbk', "uploadForME"));
        }

        // 判断当期目录下的 uploadForME 目录是否存在该文件
        // 如果没有 uploadForME 目录，你需要创建它，uploadForME 目录权限为 777
        if (file_exists("./uploadForME/" . $_FILES["file"]["name"])) {
            echo json_encode(array('exist_error' => $_FILES["file"]["name"] . " 文件已经存在。 "));
            // echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        } else {
            // 如果 uploadForME 目录不存在该文件则将文件上传到 uploadForME 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "./uploadForME/" . $_FILES["file"]["name"]);
            // chmod("uploadForME/" . $_FILES["file"]["name"], 0777);
            echo json_encode(array('status' => 'ok'));
        }
    }
} else {
    echo json_encode(array('error' => $_FILES["file"]["error"]));
}
