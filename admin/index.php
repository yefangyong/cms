<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/29
 * Time: 9:02
 */
require substr(dirname(__FILE__),0,-6).'/ini.inc.php';
isset($_SESSION['admin']) ? Tool::alertLocation(null, 'admin.php') : Tool::alertLocation(null, 'admin_login.php');