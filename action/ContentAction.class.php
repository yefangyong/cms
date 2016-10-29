<?php
class ContentAction extends Action {
    //构造方法，初始化
    public function __construct(&$_tpl){
       parent::__construct($_tpl,new ContentModel());
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
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','文档列表');
        $this->nav();
        $_nav = new NavModel();
        if(empty($_GET['nav'])) {
            $id = $_nav->getAllNavChildId();
            $this->_model->nav = Tool::objArrofStr($id,'id');
        }else{
            $_nav->id = $_GET['nav'];
            if(!$_nav->getOneNav()) Tool::alertBack('警告：类别参数传输错误!');
            $this->_model->nav=$_nav->id;
        }
        parent::page($this->_model->getListContentTotal());
        $_object = $this->_model->getListContent();
        $_object = Tool::subStr($_object,'title',20,'utf-8');
        $this->_tpl->assign('searchContent',$_object);
    }

    private function add() {
        if($_POST['send']) {
            if(Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题内容不得为空!');
            if(Validate::checkLength($_POST['title'],2,'min')) Tool::alertBack('警告：标题长度不得小于两位!');
            if(Validate::checkLength($_POST['title'],50,'max')) Tool::alertBack('警告：标题长度不得大于五十位!');
            if(Validate::checkNull($_POST['nav'])) Tool::alertBack('警告：必须选择一个栏目!');
            if(Validate::checkLength($_POST['tag'],30,'max')) Tool::alertBack('警告：标签内容不得大于三十位!');
            if(Validate::checkLength($_POST['keyword'],30,'max')) Tool::alertBack('警告：关键字不得小于三十位!');
            if (Validate::checkLength($_POST['source'],20,'max')) Tool::alertBack('警告：文章来源长度不得大于二十位！');
            if (Validate::checkLength($_POST['author'],10,'max')) Tool::alertBack('警告：作者长度不得大于十位！');
            if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：内容摘要不得大于两百位！');
            if (Validate::checkNull($_POST['area'])) Tool::alertBack('警告：详细内容不得为空！');
            if (Validate::checkNum($_POST['count'])) Tool::alertBack('警告：浏览次数必须是数字！');
            if (Validate::checkNum($_POST['gold'])) Tool::alertBack('警告：消费金币必须是数字！');
            if(isset($_POST['attr'])) {
                $this->_model->attr = implode(',',$_POST['attr']);
            }else{
                $this->_model->attr = '无属性值';
            }
            $this->_model->title = $_POST['title'];
            $this->_model->nav = $_POST['nav'];
            $this->_model->tag = $_POST['tag'];
            $this->_model->info = $_POST['info'];
            $this->_model->thumbnail = $_POST['thumbnail'];
            $this->_model->author = $_POST['author'];
            $this->_model->keyword = $_POST['keyword'];
            $this->_model->source = $_POST['source'];
            $this->_model->content = $_POST['area'];
            $this->_model->commend = $_POST['commend'];
            $this->_model->count = $_POST['count'];
            $this->_model->gold = $_POST['gold'];
            $this->_model->color = $_POST['color'];
            $this->_model->addContent()?Tool::alertLocation('文档发布成功！','?action=add'):Tool::alertBack('新增失败!');

        }
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','新增文档');
        $this->nav();
        $this->_tpl->assign('author',$_SESSION['admin']['admin_user']);
    }

    private function delete() {

    }

    private function update() {

    }

    private function nav() {
        $_nav = new NavModel();
        foreach ($_nav->getALLFrontNav() as $_object) {
            $_html.='<optgroup label="'.$_object->nav_name.'">'."\r\t";
            $_nav->id = $_object->id;
            if(!!$_childnav = $_nav->getALLChildFrontNav()) {
                foreach($_childnav as $_object) {
                    $_html.='<option value="'.$_object->id.'">'.$_object->nav_name.'</option>'."\r\t";
                }
            }
            $_html.='</optgroup>';
        }
        $this->_tpl->assign('nav',$_html);
    }

}