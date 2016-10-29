<?php
class Tool {
        //弹窗跳转
        static public function alertLocation($_info, $_url) {
            if (!empty($_info)) {
                echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
                exit();
            } else {
                header('Location:'.$_url);
                exit();
            }
        }

    //弹窗返回
    static public function alertBack($_info) {
        echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
        exit();
    }



    //弹窗赋值关闭(上传专用)
    static public function alertOpenerClose($_info,$_path) {
        echo "<script type='text/javascript'>alert('$_info');</script>";
        echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
        echo "<script type='text/javascript'>window.close();</script>";
        exit();
    }

    //将对象数组转化成字符串，并且去掉最后的逗号
    static public function objArrofStr($_object,$_filed) {
        if($_object) {
            foreach($_object as $_value) {
                $_html.=$_value->$_filed.',';
            }
        }
        return substr($_html,0,strlen($_html)-1);
    }
    //字符串截取函数
    static public function subStr($_object,$_filed,$_length,$_encoding) {
        if($_object) {
            foreach ($_object as $_value) {
                if(mb_strlen($_value->$_filed,$_encoding) > $_length) {
                    $_value->$_filed = mb_substr($_value->$_filed,0,$_length,$_encoding).'...';
                }
            }
        }
        return $_object;
    }

    //将html字符转化成html标签
    static public function unHtml($str) {
        return htmlspecialchars_decode($str);
    }

    static public function unSession() {
        if(session_start()) {
            session_destroy();
        }
    }

}