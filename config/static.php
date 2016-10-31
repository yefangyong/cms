<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/31
 * Time: 0:51
 */
//设置utf-8编码
header('Content-Type:text/html;charset=utf-8');
//网站根目录
define('ROOT_PATH',substr(dirname(__FILE__),0,-7));
require ROOT_PATH.'/config/profile.php';
if(!FRONT_CACHE) exit();
//自动加载类,自动引入文件，命名要规范，文件名要和类名一致
function __autoload($_classname) {
    if(substr($_classname,-6) == 'Action') {
        require ROOT_PATH.'/action/'.$_classname.'.class.php';
    }elseif (substr($_classname,-5) == 'Model') {
        require ROOT_PATH.'/Model/'.$_classname.'.class.php';
    }else{
        require ROOT_PATH.'/includes/'.$_classname.'.class.php';
    }
}
$_cache = new Cache();
if($_GET['type'] == 'details') $_cache->details();



