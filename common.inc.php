<?php
//后台缓存开关
define('IS_CAHCE',true);
//模板句柄
global $_tpl,$_cache;
if(IS_CAHCE && !$_cache->noCache()) {
    ob_start();
    $_tpl->cache(Tool::tplName().'.tpl');
}
$_nav = new NavAction($_tpl);
$_nav->showFront()  //列出主导航
?>