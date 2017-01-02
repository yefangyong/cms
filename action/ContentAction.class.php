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
           $this->getPostContent();
            $this->_model->addContent()?Tool::alertLocation('文档发布成功！','?action=add'):Tool::alertBack('新增失败!');

        }
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','新增文档');
        $this->nav();
        $this->_tpl->assign('author',$_SESSION['admin']['admin_user']);
    }

    private function delete() {
        if($_GET['id']) {
            $this->_model->id = $_GET['id'];
            $this->_model->deleteContent()?Tool::alertLocation('文档删除成功!',PREV_URL):Tool::alertBack('文档删除失败!');
        }else{
            Tool::alertBack('非法操作!');
        }
    }

    //commend
    private function commend($_commend) {
        $_commendArr = array(1=>'允许评论',0=>'禁止评论');
        foreach ($_commendArr as $_key=>$_value) {
            if ($_key == $_commend) $_checked='checked="checked"';
            $_html .= '<input type="radio" '.$_checked.' name="commend" value="'.$_key.'" />'.$_value;

        }
        $this->_tpl->assign('commend',$_html);
    }

    //sort
    private function sort($_sort) {
        $_sortArr = array(0=>'默认排序',1=>'置顶一天',2=>'置顶一周',3=>'置顶一月',4=>'置顶一年');
        foreach ($_sortArr as $_key=>$_value) {
            if ($_key == $_sort) $_selected='selected="selected"';
            $_html .= '<option '.$_selected.' value="'.$_key.'" style="color:'.$_key.';">'.$_value.'</option>';
            $_selected = '';
        }
        $this->_tpl->assign('sort',$_html);
    }

    //readlimit
    private function readlimit($_readlimit) {
        $_readlimitArr = array(0=>'开放浏览',1=>'初级会员',2=>'中级会员',3=>'高级会员',4=>'VIP会员');
        foreach ($_readlimitArr as $_key=>$_value) {
            if ($_key == $_readlimit) $_selected='selected="selected"';
            $_html .= '<option '.$_selected.' value="'.$_key.'" style="color:'.$_key.';">'.$_value.'</option>';
            $_selected = '';
        }
        $this->_tpl->assign('readlimit',$_html);
    }


    //color
    private function color($_color) {
        $_colorArr = array(''=>'默认颜色','red'=>'红色','blue'=>'蓝色','orange'=>'橙色');
        foreach ($_colorArr as $_key=>$_value) {
            if ($_key == $_color) $_selected='selected="selected"';
            $_html .= '<option '.$_selected.' value="'.$_key.'" style="color:'.$_key.';">'.$_value.'</option>';
            $_selected = '';
        }
        $this->_tpl->assign('color',$_html);
    }

    //attr
    private function attr($_attr) {
        $_attrArr = array('头条','推荐','加粗','跳转');
        $_attrS = explode(',',$_attr);
        $_attrNo = array_diff($_attrArr,$_attrS);
        if ($_attrS[0] != '无') {
            foreach ($_attrS as $_value) {
                $_html .= '<input type="checkbox" checked="checked" name="attr[]" value="'.$_value.'" />'.$_value;
            }
        }
        foreach ($_attrNo as $_value) {
            $_html .= '<input type="checkbox" name="attr[]" value="'.$_value.'" />'.$_value;
        }
        $this->_tpl->assign('attr',$_html);
    }

    private function update() {
        if(isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            $this->getPostContent();
            $this->_model->updateContentById() ? Tool::alertLocation('文档修改成功!',$_POST['prev_url']):Tool::alertBack('文档修改失败!');
        }
       if(isset($_GET['id'])) {
           $this->_tpl->assign('update',true);
           $this->_tpl->assign('title','修改文档');
           $this->_model->id = $_GET['id'];
           $_content = $this->_model->getOneContent();
           if($_content) {
               $this->_tpl->assign('id',$this->_model->id);
               $this->_tpl->assign('titlec',$_content->title);
               $this->_tpl->assign('tag',$_content->tag);
               $this->_tpl->assign('keyword',$_content->keyword);
               $this->_tpl->assign('thumbnail',$_content->thumbnail);
               $this->_tpl->assign('source',$_content->source);
               $this->_tpl->assign('author',$_content->author);
               $this->_tpl->assign('content',$_content->content);
               $this->_tpl->assign('info',$_content->info);
               $this->_tpl->assign('count',$_content->count);
               $this->_tpl->assign('gold',$_content->gold);
               $this->_tpl->assign('prev_url',PREV_URL);
               $this->nav($_content->nav);
               $this->attr($_content->attr);
               $this->color($_content->color);
               $this->sort($_content->sort);
               $this->readlimit($_content->readlimit);
               $this->commend($_content->commend);
           }else{
               Tool::alertBack('警告：不存在此文档!');
           }
       }else{
           Tool::alertBack('警告：非法操作!');
       }
    }

    private function getPostContent() {
        if(Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题内容不得为空!');
        if(Validate::checkLength($_POST['title'],2,'min')) Tool::alertBack('警告：标题长度不得小于两位!');
        if(Validate::checkLength($_POST['title'],50,'max')) Tool::alertBack('警告：标题长度不得大于五十位!');
        if(Validate::checkNull($_POST['nav'])) Tool::alertBack('警告：必须选择一个栏目!');
        if(Validate::checkLength($_POST['tags'],30,'max')) Tool::alertBack('警告：标签内容不得大于三十位!');
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
        $this->_model->tag = $_POST['tags'];
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
        $this->_model->sort = $_POST['sort'];
        $this->_model->readlimit = $_POST['readlimit'];
    }

    private function nav($_n = 0) {
        $_nav = new NavModel();
        foreach ($_nav->getALLFrontNav() as $_object) {
            $_html.='<optgroup label="'.$_object->nav_name.'">'."\r\t";
            $_nav->id = $_object->id;
            if(!!$_childnav = $_nav->getALLChildFrontNav()) {
                foreach($_childnav as $_object) {
                    if($_n == $_object->id) {
                    $_html.='<option selected="selected" value="'.$_object->id.'">'.$_object->nav_name.'</option>'."\r\t";
                }else{
                        $_html.='<option value="'.$_object->id.'">'.$_object->nav_name.'</option>'."\r\t";

                    }
                }
            }
            $_html.='</optgroup>';
        }
        $this->_tpl->assign('nav',$_html);
    }

}