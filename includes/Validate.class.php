<?php
class Validate {
    //验证类

    //验证是否为空
    static public function checkNull ($_data) {
        if(trim($_data) == '')return true;
        return false;
    }

    //长度是否合法
    static public function checkLength($_data,$_length,$_flag) {
        if($_flag == 'min') {
            if(mb_strlen(trim($_data),'utf8') < $_length) return true;
            return false;
        }elseif($_flag == 'max') {
            if (mb_strlen(trim($_data),'utf8')>$_length) return true;
            return false;
        }elseif ($_flag == 'equals') {
            if (mb_strlen(trim($_data),'utf-8') != $_length) return true;
            return false;
            }
        else {
            Tool::alertBack('参数传递错误！');
        }
    }

    //检查是否是数字
    static public function checkNum($_date) {
        if(is_numeric($_date)) return false;
        return true;
    }

    //数据是否一致
    static public function checkEqueals($_data,$_otherdata) {
       if(trim($_data) != trim($_otherdata)) return true;
        return false;
    }

    //验证电子邮件
    static public function checkEmail($_data) {
        if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_data)) return true;
        return false;
    }

    static function checkSession() {
        if(!isset($_SESSION['admin'])) Tool::alertBack('非法登录!');
    }
}