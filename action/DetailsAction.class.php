<?php
class DetailsAction extends Action {
    //构造方法，初始化
    public function __construct(&$_tpl){
       parent::__construct($_tpl);
    }

    public function _action() {
        $this->getDetails();
    }

    //获得文档详细内容
    private function getDetails() {
        if(isset($_GET['id'])) {
            parent::__construct($this->_tpl,new ContentModel());
            $this->_model->id = $_GET['id'];
            if(!$this->_model->setContentCount()) Tool::alertBack('警告:不存在此文档!');
            $_content = $this->_model->getOneContent();
            $this->_tpl->assign('id',$this->_model->id);
            $this->_tpl->assign('title',$_content->title);
            $this->_tpl->assign('date',$_content->date);
            $this->_tpl->assign('source',$_content->source);
            $this->_tpl->assign('author',$_content->author);
            $this->_tpl->assign('info',$_content->info);
            $this->_tpl->assign('tag',$_content->tag);
            $this->_tpl->assign('content',Tool::unHtml($_content->content));
            $this->getNav($_content->nav);
            if(FRONT_CACHE) {
                $this->_tpl->assign('count','<script type="text/javascript">getContentCount();</script>');
            }else{
                $this->_tpl->assign('count',$_content->count);
            }

        }
    }

    //获取前台显示的导航
    public function getNav($_id) {
            $_nav = new NavModel();
            $_nav->id = $_id;
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
    }



}