<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/29
 * Time: 9:02
 */

require substr(dirname(__FILE__),0,-6).'/ini.inc.php';
global $_tpl;
Validate::checkSession();
$_content = new ContentAction($_tpl);   //入口
$_content->_action();
$_tpl->display('content.tpl');