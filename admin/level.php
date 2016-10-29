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
$_level = new LevelAction($_tpl);   //入口
$_level->_action();
$_tpl->display('level.tpl');