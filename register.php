<?php
require dirname(__FILE__) . '/ini.inc.php';
global $_tpl;
$_reg = new RegisterAction($_tpl);
$_reg->_action();
$_tpl->display('register.tpl');
?>