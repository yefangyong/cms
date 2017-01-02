<?php
class FeedBackAction extends Action {
    //构造方法，初始化
    public function __construct(&$_tpl){
       parent::__construct($_tpl,new CommentModel());
    }
    //action
    public function _action(){
        $this->addComment();
        $this->showComment();
        }

    private function addComment() {
        if($_POST['send']) {
            $_cookie = new Cookie('user');
            if($_cookie->getCookie()) {
                $this->_model->user = $_cookie->getCookie();
            }else {
                $this->_model->user = '游客';
            }
            $this->_model->cid =$_GET['id'];
            $this->_model->manner = $_POST['manner'];
            $this->_model->content = $_POST['content'];
            $this->_model->addComment()?Tool::alertLocation('评论添加成功，请等待管理员审核！','feedback.php?id='.$this->_model->cid) : Tool::alertLocation('评论添加失败，请重新添加！','feedback.php?id='.$this->_model->cid);
        }
    }

    private function showComment () {
        if($_GET['id']) {
            $this->_model->cid = $_GET['id'];
            parent::page($this->_model->getCommentCount());
            $_object = $this->_model->getAllComment();
            if($_object) {
                foreach($_object as $_value) {
                    switch ($_value->manner) {
                        case -1:
                            $_value->manner = '反对';
                            break;
                        case 0 :
                            $_value->manner = '中立';
                            break;
                        case 1 :
                            $_value->manner ='支持';
                            break;
                    }
                    if(empty($_value->face)) {
                        $_value->face = '00.gif';
                    }
                }
            }
            $this->_tpl->assign('id',$this->_model->cid);
            $this->_tpl->assign('AllComment',$_object);
        }else {
            Tool::alertBack('非法操作!');
        }
    }

}