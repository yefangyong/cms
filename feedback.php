<?php
require dirname(__FILE__) . '/ini.inc.php';
global $_tpl;
$_feed = new FeedBackAction($_tpl);
$_feed->_action();
$_tpl->display('feedback.tpl');
?>