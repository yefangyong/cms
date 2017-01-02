<?php
//静态页面局部不缓存
class Cache {


    private $flag;

    //构造方法初始化
    public function __construct($_noCache) {
        $this->flag = in_array(Tool::tplName(),$_noCache);
    }

    //返回不使用缓存的页面布尔值
    public function noCache() {
        return $this->flag;
    }

    //_action
    public function _action() {
        switch ($_GET['type']) {
            case 'details' :
                $this->details();
                break;
            case 'list' :
                $this->listc();
                break;
            case 'header':
                $this->header();
                break;
            case 'index':
                $this->index();
        }
    }

    public function index() {
        $_cookie = new Cookie('user');
        $user = $_cookie->getCookie();
        $_cookie = new Cookie('face');
        $face =$_cookie->getCookie();
        if($user && $face) {
            $result = array(
                'user'=>$user,
                'face'=>$face,
            );
            echo json_encode($result);
            exit;
        }else {
            $result ='';
            echo json_decode($result);
            exit;
        }

    }

    //header
    public function header() {
        $_cookie = new Cookie('user');
        $user =$_cookie->getCookie();
        if ($user) {
            $result = array(
                'user'=>$user,
            );
            echo (json_encode($result));
            exit;
        } else {
            $result = '';
            echo  json_encode($result);
            exit;
        }

    }
    //details
    public function details() {
        $_content = new ContentModel();
        $_content->id = $_GET['id'];
        $this->setCount($_content);
        $this->getContentCount($_content);
    }

     //累计
    private function setCount(&$_content) {
        $_content->setContentCount();
    }

    //获取
    private function getContentCount(&$_content) {
        $_count = $_content->getOneContent()->count;
        echo "
			function getContentCount() {
				document.write('$_count');
			}
		";
    }
}
?>