<?php
require dirname(__FILE__) . '/ini.inc.php';
global $_tpl;
$_list = new ListAction($_tpl);
$_list->_action();
$_tpl->assign('title','标头');
$_tpl->display('list.tpl');
?>