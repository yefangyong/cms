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
            default:
                Tool::alertBack('非法操作!');
        }

    }

    public function reg() {
        $this->_tpl->assign('reg',true);
    }

    public function add() {
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
            if(Validate::checkEqueals($_POST['code'],$_SESSION['code'])) Tool::alertBack('验证码不正确!');
            $this->_model->user = $_POST['user'];
            $this->_model->pass = sha1($_POST['pass']);
            $this->_model->email = $_POST['email'];
            $this->_model->addUser()?Tool::alertLocation('恭喜您，注册成功','./'):Tool::alertBack('对不起，注册失败!');
        }
    }


}