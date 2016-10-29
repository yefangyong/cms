<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/29
 * Time: 9:02
 */
require substr(dirname(__FILE__),0,-6).'/ini.inc.php';
global $_tpl;
$_login = new LoginAction($_tpl);
$_login->_action();
if(isset($_SESSION['admin'])) Tool::alertLocation(null,'admin.php');
$_tpl->display('admin_login.tpl');