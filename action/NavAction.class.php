<?php
class NavAction extends Action {

    //构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl, new NavModel());
    }
    //action
    public function _action(){
        //业务流程控制
        switch($_GET['action']) {
            case 'show' :
                $this->show();
                break;
            case 'add' :
                $this->add();
                break;
            case 'update' :
                $this->update();
                break;
            case 'sort' :
                $this->sort();
                break;
            case 'delete' :
                $this->delete();
                break;
            case 'logout' :
                $this->logout();
                break;
            case 'showChild' :
                $this->showChild();
                break;
            case 'addChild' :
                $this->addChild();
                break;
            default:
                Tool::alertBack('非法操作！');
        }

    }


    private function sort() {
        if(isset($_POST['send'])) {
            $this->_model->sort = $_POST['sort'];
            if($this->_model->setNavSort())Tool::alertLocation(null,PREV_URL);
        }
    }

    private function show() {
        parent::page($this->_model->getNavTotal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','导航列表');
        $this->_tpl->assign('Alllevel',$this->_model->getAllNav());
    }

    public function showFront() {
        $this->_tpl->assign('frontNav',$this->_model->getFrontNav());
    }

    private function add() {
        if(isset($_POST['send'])) {
            if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack('警告：导航名称不得为空');
            if(Validate::checkLength($_POST['nav_name'],2,'min'))Tool::alertBack('警告:导航名称不得小于两位!');
            if(Validate::checkLength($_POST['nav_name'],6,'max'))Tool::alertBack('警告:导航名称不得大于6位!');
            if(Validate::checkLength($_POST['nav_info'],200,'max'))Tool::alertBack('警告:描述信息不得大于200位!');
            $this->_model->nav_name = $_POST['nav_name'];
            $this->_model->pid = $_POST['pid'];
            $_returnUrl = $this->_model->pid?'nav.php?action=showChild&id='.$this->_model->pid:'nav.php?action=show';
            if($this->_model->getOneNav())Tool::alertBack('此导航名称已经存在!');
            $this->_model->nav_info = $_POST['nav_info'];
            if($this->_model->addNav()) {
                Tool::alertlocation('恭喜你，新增导航成功!',$_returnUrl);
            }else {
                Tool::alertBack('很遗憾，新增导航失败!');
            }
        }
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','添加导航');


    }

    private function delete() {
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $this->_model->deleteNav()?Tool::alertLocation('恭喜您，删除成功',PREV_URL):Tool::alertBack('对不起，删除失败！');
        }else {
            Tool::alertBack('非法操作！');
        }
    }

    private function update() {
        if(isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            $this->_model->nav_name = $_POST['nav_name'];
            $this->_model->nav_info = $_POST['nav_info'];
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_model->updateNav()?Tool::alertLocation('恭喜你，修改成功！',$_POST['prev_url']):Tool::alertBack('很遗憾，修改失败！');
        }
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav)?true:Tool::alertBack('导航传值的id有误');
            $this->_tpl->assign('nav_name',$_nav->nav_name);
            $this->_tpl->assign('id',$_nav->id);
            $this->_tpl->assign('nav_info',$_nav->nav_info);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('title','修改导航');
        }else {
            Tool::alertBack('非法操作！');
        }
    }

    //增加子导航
    public function addChild() {
        if($_POST['send']) {
            $this->add();
        }
        if(isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav)?true:Tool::alertBack('导航传值得id有误!');
            $this->_tpl->assign('id',$_nav->id);
            $this->_tpl->assign('addChild',true);
            $this->_tpl->assign('title','新增子导航');
            $this->_tpl->assign('prev_name',$_nav->nav_name);
            $this->_tpl->assign('prev_url',PREV_URL);
        }
    }

    public function showChild() {
        if(isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav)?true:Tool::alertBack('导航传值得id有误!');
            parent::page($this->_model->getNavChildTotal());
            $this->_tpl->assign('id',$_nav->id);
            $this->_tpl->assign('showChild',true);
            $this->_tpl->assign('title','子导航列表');
            $this->_tpl->assign('prev_name',$_nav->nav_name);
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('AllChildNav',$this->_model->getALLChildNav());

        }
        $this->_tpl->assign('showChild',true);

    }

}