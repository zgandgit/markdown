<?php

	/*
	 * PHP upload demo for Editor.md
     *
     * @FileName: upload.php
     * @Auther: Pandao
     * @E-mail: pandao@vip.qq.com
     * @CreateTime: 2015-02-13 23:20:04
     * @UpdateTime: 2015-02-14 14:52:50
     * Copyright@2015 Editor.md all right reserved.
	 */

    header("Content-Type:application/json; charset=utf-8"); // Unsupport IE
    header("Content-Type:text/html; charset=utf-8");
    header("Access-Control-Allow-Origin: *");

    require("editormd.uploader.class.php");

    error_reporting(E_ALL & ~E_NOTICE);
	
	// $path     = __DIR__ . DIRECTORY_SEPARATOR;
	$url      = dirname($_SERVER['PHP_SELF']) . '/';
	// $savePath = realpath($path . '../uploads/') . DIRECTORY_SEPARATOR;
    $savePath = realpath(dirname(__FILE__)."/uploads/") . DIRECTORY_SEPARATOR;
	$saveURL  = $url . 'uploads/';


	$formats  = array(
		'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp')
	);

    $name = 'editormd-image-file';


    if (isset($_FILES[$name]))
    {       

        $imageUploader = new EditorMdUploader($savePath, $saveURL, $formats['image'], 2,10);  // Ymdhis表示按日期生成文件名，利用date()函数
        
        $imageUploader->config(array(
            'maxSize' => 1024,        // 允许上传的最大文件大小，以KB为单位，默认值为1024
            'cover'   => true         // 是否覆盖同名文件，默认为true
        ));
        
        if ($imageUploader->upload($name))
        {
            $imageUploader->message('上传成功！', 1);
        }
        else
        {
            $imageUploader->message('上传失败！', 0);
        }
    }


// -------------------------------------------------------------------------改的上传方案
    //     header('Content-type:text/html; charset=utf-8');
    // // 文件上传封装函数
    // /**
    //  * @param1 array $file 上传的文件信息(5属性元素数组)
    //  * @param2 array $allow_type 允许上传的MIME类型
    //  * @param3 string $path 存储的路径
    //  * @param4 string &$error 如果出现错误的原因
    //  * @param5 array $allow_format = array(); 允许上传的文件格式
    //  * @param6 int max_size = 2000000 允许上传的文件大小
    //  */
    // function upload_single($file, $allow_type, $path, &$error, $allow_format = array(), $max_size = 2000000) {
    //     // 判断文件是否有效
    //     if (!is_array($file) || !isset($file['error'])) {
    //         # 文件无效
    //         $error = '不是一个有效的上传文件';
    //         return false;
    //     }
 
    //     // 判断文件存储路径是否有效
    //     if (!is_dir($path)) {
    //         // 路径不存在
    //         $error = "文件存储路径不存在";
    //         return false;
    //     }
 
    //     // 判断文件本身上传过程是否有错误
    //     switch ($file['error']) {
    //         case 1:
    //             $error = "文件大小超出了php配置文件的规定";
    //             return false;
    //         case 2:
    //             $error = "文件大小超出了表单规定";
    //             return false;
    //         case 3:
    //             $error = "文件只有部分被上传";
    //             return false;
    //         case 4:
    //             $error = "没有文件被上传";
    //             return false;
    //         case 6:
    //             $error = "找不到临时文件夹";
    //             return false;
    //         case 7:
    //             $error = "文件写入失败";
    //             return false;
    //         default:
    //             $error = "未知错误";
    //             break;
    //     }
 
    //     // 判断MIME类型
    //     if (!in_array($file['type'], $allow_type)) {
    //         // 该文件类型不允许上传
    //         $error = "当前文件类型不允许上传";
    //         return false;
    //     }
 
    //     // 判断文件格式是否允许
    //     // 取出文件名的后缀
    //     $ext = ltrim(strrchr($file['name'], '.'), '.');
    //     if (!empty($allow_format) && !in_array($ext, $allow_format)) {
    //         // 文件格式不允许
    //         $error = "当前文件格式不允许上传";
    //         return false;
    //     }
 
    //     // 判断当前文件大小是否满足要求
    //     if ($file['size'] > $max_size) {
    //         // 文件过大
    //         $error = "当前上传的文件超过".$max_size;
    //         return false;
    //     }
 
    //     // 构造文件名字：类型_年月日+随机字符串.$ext
    //     $fullname = strstr($file['type'], "/", true).'_'.date('Ymd');
    //     // 产生随机字符串
    //     for ($i=0; $i < 4; $i++) { 
    //         $fullname .= chr(mt_rand(65, 90));
    //     }
    //     // 拼接上后缀
    //     $fullname .= '.'.$ext;
 
    //     // 经过条件限定后，移动到指定目录
    //     if (!is_uploaded_file($file['tmp_name'])) {
    //         // 文件不是上传的
    //         $error = "不是上传文件";
    //         return false;
    //     }
 
    //     if (move_uploaded_file($file['tmp_name'], $path .'/'.$fullname)) {
    //         # 成功
    //         return $fullname;
    //     } else {
    //         // 移动失败
    //         $error = "文件上传失败！";
    //         return false;
    //     }
    // }
 
    // $name = 'editormd-image-file';
    // // var_dump(dirname(__FILE__));die;
    // // 测试
    // $file = $_FILES[$name];
    // $path = realpath(dirname(__FILE__)."/uploads/") . DIRECTORY_SEPARATOR;
    // $allow_type = array('image/jpg', 'image/jpeg', 'image/png' , 'image/gif', 'image/pjpeg');
    // $allow_format = array('jpg', 'jpeg', 'gif', 'png');
    // $max_size = 800000;
    // if ($filename = upload_single($file, $allow_type, $path, $error, $allow_format, $max_size)) {
    //     $array = [
    //         'success' => 200,
    //         'url' => $filename,
    //         'message' => '上传成功'
    //     ];
    //      echo json_decode($array);
    // } else {
    //     $array = [
    //         'success' => 1000,
    //         'message' => '失败'
    //     ];
    //      echo json_decode($array);
    // }

?>