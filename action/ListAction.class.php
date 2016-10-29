<?php
class ListAction extends Action {
    //构造方法，初始化
    public function __construct(&$_tpl){
       parent::__construct($_tpl);
    }

    public function _action() {
        $this->getNav();
        $this->getListContent();
    }

    //获取前台列表的内容
    public function getListContent() {
        if(isset($_GET['id'])) {
            parent::__construct($this->_tpl,new ContentModel());
            $nav = new NavModel();
            $nav->id = $_GET['id'];
            $_navId = $nav->getNavChildId();
            if($_navId) {
                $this->_model->nav = Tool::objArrofStr($_navId,'id');
            }else{
                $this->_model->nav = $nav->id;
            }
            parent::page($this->_model->getListContentTotal(),ARTICLE_SIZE);
            $_object = $this->_model->getListContent();
            $_object = Tool::subStr($_object,'info',120,'utf-8');
            $_object = Tool::subStr($_object,'title',35,'utf-8');
            $this->_tpl->assign('allListContent',$_object);
        }
    }

    //获取前台显示的导航
    public function getNav() {
        if(isset($_GET['id'])) {
            $_nav = new NavModel();
            $_nav->id = $_GET['id'];
            if($_nav->getOneNav()){
                //主导航
                if ($_nav->getOneNav()->nnav_name) $_nav1 = '<a href="list.php?id='.$_nav->getOneNav()->iid.'">'.$_nav->getOneNav()->nnav_name.'</a> &gt; ';
                $_nav2 = '<a href="list.php?id='.$_nav->getOneNav()->id.'">'.$_nav->getOneNav()->nav_name.'</a>';
                $this->_tpl->assign('nav',$_nav1.$_nav2);
                //子导航集
                $this->_tpl->assign('childNav',$_nav->getALLChildFrontNav());
            }else {
                Tool::alertBack('警告：此导航不存在!');
            }
        }else {
            Tool::alertBack('警告:非法操作!');
        }
    }

}