<?php
require substr(dirname(__FILE__),0,-7).'/ini.inc.php';
if(isset($_POST['send'])) {
    $_fileUpload = new FileUpload('pic', $_POST['MAX_FILE_SIZE']);
    $_path = $_fileUpload->getPath();
    $_img = new Image($_path);
    $_img->thumb(150,100);
    $_img->out();
    Tool::alertOpenerClose('缩略图上传成功', $_path);
}else{
    Tool::alertBack('警告：文件过大或者其他未知错误导致浏览器崩溃!');
}


?>