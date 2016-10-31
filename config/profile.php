<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/29
 * Time: 8:43
 */
//数据库配置信息
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','cms');

//系统配置信息
define('PAGE_SIZE',10);           //每页多少条
define('ARTICLE_SIZE',8);              //文档列表显示数量
define('GPC',get_magic_quotes_gpc());
define('PREV_URL',$_SERVER["HTTP_REFERER"]); //上一页地址
define('NAV_SIZE',6);                        //主导航的数量
define('UPDIR','/uploads/');



//模板文件目录
define('TPL_DIR',ROOT_PATH.'/templates/');
//编译文件目录
define('TPL_C_DIR',ROOT_PATH.'/templates_c/');
//缓存文件目录
define('CACHE',ROOT_PATH.'/cache/');
define('ADMIN_CACHE',false);         //后台缓存文件，不得开启，负责后台功能会出现异常
define('FRONT_CACHE',false);         //前台缓存按钮，测试的时候关闭，运行的时候开启