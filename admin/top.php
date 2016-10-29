<?php
require substr(dirname(__FILE__),0,-6).'/ini.inc.php';
global $_tpl;
Validate::checkSession();
$_tpl->assign('admin_user',$_SESSION['admin']['admin_user']);
$_tpl->assign('level_name',$_SESSION['admin']['level_name']);
$_tpl->display('top.tpl');
