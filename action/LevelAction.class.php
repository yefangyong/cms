<?php
class LevelAction extends Action {
    //构造方法，初始化
    public function __construct(&$_tpl){
       parent::__construct($_tpl,new LevelModel());
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
            case 'delete' :
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作！');
        }

    }

    private function show() {
        parent::page($this->_model->getLevelTotal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','等级列表');
        $this->_tpl->assign('AllLevel',$this->_model->getAllLimitLevel());

    }

    private function add() {
        if(isset($_POST['send'])) {
            if(Validate::checkNull($_POST['level_name'])) Tool::alertBack('警告：等级名称不得为空');
            if(Validate::checkLength($_POST['level_name'],2,'min'))Tool::alertBack('警告:等级名称不得小于两位!');
            if(Validate::checkLength($_POST['level_name'],6,'max'))Tool::alertBack('警告:等级名称不得大于6位!');
            if(Validate::checkLength($_POST['level_info'],200,'max'))Tool::alertBack('警告:描述信息不得大于200位!');
            $this->_model->level_name = $_POST['level_name'];
            if($this->_model->getOneLevel())Tool::alertBack('此等级名称已经存在!');
            $this->_model->level_info = $_POST['level_info'];
            if($this->_model->addLevel()) {
                Tool::alertlocation('恭喜你，新增等级成功!','level.php?action=show');
            }else {
                Tool::alertBack('很遗憾，新增等级失败!');
            }
        }
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','添加等级');
    }

    private function delete() {
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $_manage = new ManageModel();
            $_manage->level=$this->_model->id;
            if($_manage->getOneManage())Tool::alertBack('警告：此等级已有管理员使用！无法删除!请先删除相关用户!');
            $this->_model->deleteLevel()?Tool::alertLocation('恭喜您，删除成功','level.php?action=show'):Tool::alertBack('对不起，删除失败！');
        }else {
            Tool::alertBack('非法操作！');
        }
    }

    private function update() {
        if(isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            $this->_model->level_name = $_POST['level_name'];
            $this->_model->level_info = $_POST['level_info'];
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_model->updateLevel()?Tool::alertLocation('恭喜你，修改成功！',$_POST['prev_url']):Tool::alertBack('很遗憾，修改失败！');
        }
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $_level = $this->_model->getOneLevel();
            is_object($_level)?true:Tool::alertBack('等级传值的id有误');
            $this->_tpl->assign('level_name',$_level->level_name);
            $this->_tpl->assign('id',$_level->id);
            $this->_tpl->assign('level_info',$_level->level_info);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('title','修改等级');
        }else {
            Tool::alertBack('非法操作！');
        }
    }
}