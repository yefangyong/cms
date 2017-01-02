<?php
class IndexAction extends Action {

    //构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl);
    }
    //action
    public function _action(){
        $this->login();
        $this->lastUser();

    }

    public function lastUser() {
        $user = new UserModel();
        $this->_tpl->assign('AllLaterUser',$user->getLastUser());

    }

    public function login() {
        $_cookie = new Cookie('user');
        $user = $_cookie->getCookie();
        $_cookie = new Cookie('face');
        $face = $_cookie->getCookie();
        if($face && $user) {
            $this->_tpl->assign('user',$user);
            $this->_tpl->assign('face',$face);
        }else {
            $this->_tpl->assign('login',true);
        }
    }




}