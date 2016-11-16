<?php
//设置session
session_start();
//设置utf-8编码
header('Content-Type:text/html;charset=utf-8');
//网站根目录
define('ROOT_PATH',dirname(__FILE__));
require ROOT_PATH.'/config/profile.php';
//设置中国时区
date_default_timezone_set('Asia/Shanghai');
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
//实例化
global $_tpl;
//设置不缓存页面数组
$_cache = new Cache(array('code','static','upload'));
$_tpl = new Templates();
//初始化数据
require 'common.inc.php';
?>
