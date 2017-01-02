<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/29
 * Time: 9:02
 */

require substr(dirname(__FILE__),0,-6).'/ini.inc.php';
Validate::checkSession();
global $_tpl;
$_user = new UserAction($_tpl);   //入口
$_user->_action();
$_tpl->display('user.tpl');