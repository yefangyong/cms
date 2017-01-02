<?php
class RegisterAction extends Action {
    //构造方法，初始化
    public function __construct(&$_tpl){
       parent::__construct($_tpl);
    }

    public function _action() {
        switch($_GET['action']) {
            case 'reg':
                $this->reg();
                break;
            case 'add':
                $this->add();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                Tool::alertBack('非法操作!');
        }

    }

    private function logout() {
        $_cookie = new cookie('user');
        $_cookie->unCookie();
        Tool::alertLocation(null,'register.php?action=login');
    }

    private function reg() {
        if($_POST['send']) {
            parent::__construct($this->_tpl,new UserModel());
            if(validate::checkNull($_POST['user'])) Tool::alertBack('用户名不得为空!');
            if(Validate::checkLength($_POST['user'],2,'min')) Tool::alertBack('用户名长度小于大于两位!');
            if(Validate::checkLength($_POST['user'],8,'max')) Tool::alertBack('用户名长度不得大于8位');
            if(Validate::checkNull($_POST['pass'])) Tool::alertBack('密码不得为空!');
            if(Validate::checkLength($_POST['pass'],6,'min')) Tool::alertBack('密码不得小于六位');
            if(Validate::checkEqueals($_POST['pass'],$_POST['notpass'])) Tool::alertBack('密码必须保持一致');
            if(Validate::checkNull($_POST['email'])) Tool::alertBack('email不得为空!');
            if(Validate::checkEmail($_POST['email'])) Tool::alertBack('email格式不合法!');
            if(!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
                $this->_model->question = $_POST['question'];
                $this->_model->answer = $_POST['answer'];
            }
            if(Validate::checkLength($_POST['code'],4,'min')) Tool::alertBack('验证码不得小于四位');
            if(Validate::checkEqueals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('验证码不正确!');
            $this->_model->user = $_POST['user'];
            $this->_model->pass = sha1($_POST['pass']);
            $this->_model->email = $_POST['email'];
            $this->_model->face = $_POST['face'];
            $this->_model->time = time();
            $this->_model->state = 1;
            if($this->_model->checkUser())Tool::alertBack('警告:用户名已经存在!');
            if($this->_model->checkEmail())Tool::alertBack('警告：此邮件已经存在!');
            if($this->_model->addUser()) {
                $_cookie = new cookie('user', $this->_model->user, $_POST['time']);
                $_cookie->setCookie();
                $_cookie = new cookie('face', $this->_model->face, $_POST['time']);
                $_cookie->setCookie();
                Tool::alertLocation('恭喜您，注册成功', './');
            }else{
                Tool::alertBack('对不起，注册失败!');
            }
        }else {
            $this->_tpl->assign('reg', true);
            $this->_tpl->assign('OptionFaceOne',range(1,9));
            $this->_tpl->assign('OptionFaceTwo',range(10,24));
        }
    }

    public function login() {
        if($_POST['send']) {
            parent::__construct($this->_tpl,new UserModel());
            if(validate::checkNull($_POST['user'])) Tool::alertBack('用户名不得为空!');
            if(Validate::checkLength($_POST['user'],2,'min')) Tool::alertBack('用户名长度小于大于两位!');
            if(Validate::checkLength($_POST['user'],8,'max')) Tool::alertBack('用户名长度不得大于8位');
            if(Validate::checkNull($_POST['pass'])) Tool::alertBack('密码不得为空!');
            if(Validate::checkLength($_POST['pass'],6,'min')) Tool::alertBack('密码不得小于六位');
            if(Validate::checkEqueals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('验证码不正确!');
            $this->_model->user = $_POST['user'];
            $this->_model->pass = sha1($_POST['pass']);
            $user=$this->_model->checkLogin();
            if($user) {
                $_cookie = new cookie('user',$user->user,$_POST['time']);
                $_cookie->setCookie();
                $_cookie = new cookie('face',$user->face,$_POST['time']);
                $_cookie->setCookie();
                $this->_model->id=$user->id;
                $this->_model->time = time();
                $this->_model->setLaterUser();
                Tool::alertLocation('登录成功','./');
            }else{
                Tool::alertBack('用户名或密码错误!');
            }
        }else {
            $this->_tpl->assign('login', true);
        }
    }



}