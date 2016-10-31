<?php
//是否开启缓冲区，前台专用
//判断是否开启缓冲区
FRONT_CACHE ? ob_start() : null;
//模板句柄
global $_tpl;
if(FRONT_CACHE) {
    ob_start();
    $_tpl->cache(Tool::tplName());
}
$_nav = new NavAction($_tpl);
$_nav->showFront()  //列出主导航
?>