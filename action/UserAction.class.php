<?php
class UserAction extends Action {

    //构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl, new UserModel());
    }
    //action
    public function _action(){
        //业务流程控制
        switch($_GET['action']) {
            case 'show' :
                $this->show();
                break;
            case 'update' :
                $this->update();
                break;
            case 'add' :
                $this->add();
                break;
            case 'delete' :
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作！');
        }

    }

    private function show() {
        parent::page($this->_model->getUserTotal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','会员列表');
        $_object = $this->_model->getAllUser();
        foreach($_object as $_value) {
            switch($_value->state) {
                case 0 :
                    $_value->state = '被封杀的会员';
                    break;
                case 1 :
                    $_value->state = '待审核的会员';
                    break;
                case 2 :
                    $_value->state = '初级会员';
                    break;
                case 3 :
                    $_value->state = '中级会员';
                    break;
                case 4 :
                    $_value->state = '高级会员';
                    break;
                case 5 :
                    $_value->state = 'VIP会员';
                    break;
            }
        }
        $this->_tpl->assign('allUser',$_object);
    }

    private function delete() {
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $this->_model->deleteUser()?Tool::alertLocation('恭喜您，删除成功',PREV_URL):Tool::alertBack('对不起，删除失败！');
        }else {
            Tool::alertBack('非法操作！');
        }
    }

    private function add() {
        if($_POST['send']) {
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
            $this->_model->user = $_POST['user'];
            $this->_model->pass = sha1($_POST['pass']);
            $this->_model->email = $_POST['email'];
            $this->_model->face = $_POST['face'];
            $this->_model->state = $_POST['state'];
            if($this->_model->checkUser())Tool::alertBack('警告:用户名已经存在!');
            if($this->_model->checkEmail())Tool::alertBack('警告：此邮件已经存在!');
            if($this->_model->addUser()) {
                Tool::alertLocation('恭喜您，注册成功', 'user.php?action=show');
            }else{
                Tool::alertBack('对不起，注册失败!');
            }
        }else{
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','新增会员');
        $this->_tpl->assign('prev_url',PREV_URL);
        $this->_tpl->assign('OptionFaceOne',range(1,9));
        $this->_tpl->assign('OptionFaceTwo',range(10,24));
     }
    }

    private function update() {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['pass'])) {
                $this->_model->pass = $_POST['ppass'];
            } else {
                if (Validate::checkLength($_POST['pass'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
                $this->_model->pass = sha1($_POST['pass']);
            }
            if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮件不得为空！');
            if (Validate::checkEmail($_POST['email'])) Tool::alertBack('警告：电子邮件格式不正确！');
            if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
                $this->_model->question = $_POST['question'];
                $this->_model->answer = $_POST['answer'];
            }
            $this->_model->id = $_POST['id'];
            $this->_model->email = $_POST['email'];
            $this->_model->face = $_POST['face'];
            $this->_model->state = $_POST['state'];
            $this->_model->updateUser() ? Tool::alertLocation('恭喜你，修改成功！',$_POST['prev_url']) : Tool::alertBack('很遗憾，修改失败！');
        }
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $_user = $this->_model->getOneUser();
            $this->_tpl->assign('id',$_user->id);
            $this->_tpl->assign('user',$_user->user);
            $this->_tpl->assign('email',$_user->email);
            $this->_tpl->assign('answer',$_user->answer);
            $this->_tpl->assign('facesrc',$_user->face);
            $this->_tpl->assign('pass',$_user->pass);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('title','修改会员');
            $this->face($_user->face);
            $this->question($_user->question);
            $this->state($_user->state);
        }else {
            Tool::alertBack('非法操作！');
        }
    }

    //头像
    private function face($_face) {
        $_one = range(1,9);
        $_two = range(10,24);
        foreach ($_one as $_value) {
            if ('0'.$_value.'.gif' == $_face) $_selected='selected="selected"';
            $_html .= '<option '.$_selected.' value="0'.$_value.'.gif">0'.$_value.'.gif</option>';
            $_selected = '';
        }
        foreach ($_two as $_value) {
            if ($_value.'.gif' == $_face) $_selected='selected="selected"';
            $_html .= '<option '.$_selected.' value="'.$_value.'.gif">'.$_value.'.gif</option>';
            $_selected = '';
        }
        $this->_tpl->assign('face',$_html);
    }



    //状态
    private function state($_state) {
        $_stateArr = array('被封杀的会员','待审核的会员','初级会员','中级会员','高级会员','VIP会员');
        foreach ($_stateArr as $_key=>$_value) {
            if ($_state == $_key) $_checked='checked="checked"';
            $_html .= '<input type="radio" name="state" '.$_checked.' value="'.$_key.'" /> '.$_value.' ';
            $_checked = '';
        }
        $this->_tpl->assign('state',$_html);
    }

    //提问
    private function question($_question) {
        $_questionArr = array('您父亲的姓名？','您母亲的职业？','您配偶的性别？');
        foreach ($_questionArr as $_value) {
            if ($_value == $_question) $_selected='selected="selected"';
            $_html .= '<option '.$_selected.' value="'.$_value.'">'.$_value.'</option>';
            $_selected = '';
        }
        $this->_tpl->assign('question',$_html);
    }



}