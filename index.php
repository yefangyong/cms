<?php
require dirname(__FILE__) . '/ini.inc.php';
global $_tpl;
$_index = new IndexAction($_tpl);
$_index->_action();
$_tpl->assign('title','标头');
$_tpl->display('index.tpl');
?>