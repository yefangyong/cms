<?php
//判断是否开启缓冲区
//后台缓存开关
define('IS_CAHCE',false);
IS_CAHCE ? ob_start() : null;
?>