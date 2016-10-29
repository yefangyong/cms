<?php
//上传类文件
class FileUpload {
    private $maxsize;  //表单最大值
    private $error;    //错误代码
    private $type;     //文件类型
    private $today;     //今天目录
    private $typeArr = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
    private $path;     //目录路径
    private $name;     //文件名
    private $tmp;      //临时文件
    private $linkPath; //连接路径
    private $linkToday;  //今天目录(相对位置)

    //构造方法，初始化,$_FILES超级全局变量获取相关上传文件的信息
    public function __construct($_file,$_maxsize) {
        $this->error = $_FILES[$_file]['error'];
        $this->maxsize = $_maxsize/1024;
        $this->type = $_FILES[$_file]['type'];
        $this->path = ROOT_PATH.UPDIR;
        $this->today = $this->path.date('Ymd').'/';
        $this->name = $_FILES[$_file]['name'];
        $this->tmp = $_FILES[$_file]['tmp_name'];
        $this->linkToday = date('Ymd').'/';
        $this->checkError();
        $this->checkType();
        $this->checkPath();
        $this->moveUpload();
    }

    //验证目录
    private function checkPath() {
        if (!is_dir($this->path) || !is_writeable($this->path)) {
            if (!mkdir($this->path)) {
                Tool::alertBack('警告：目录创建失败!');
            }
        }
        if (!is_dir($this->today) || !is_writeable($this->today)) {
            if (!mkdir($this->today)) {
                Tool::alertBack('警告：子目录创建失败!');
            }
        }
    }

    //返回路径
    public function getPath () {
        $_path = $_SERVER["SCRIPT_NAME"];
        //解决目录不在根目录下的问题
        $_dir = dirname(dirname($_path));
        if($_dir == '\\') $_dir = '/';
        $this->linkPath = $_dir.$this->linkPath;
        return $this->linkPath;
    }

    //移动文件
    private function moveUpload() {
        if(is_uploaded_file($this->tmp)) {
            if(!move_uploaded_file($this->tmp,$this->setNewName())) {
                Tool::alertBack('警告：上传失败');
            }
        }else {
            Tool::alertBack('警告：临时文件不存在!');
        }
    }

    //设置新文件名
    private function setNewName() {
        $nameArr = explode('.',$this->name);
        $postFix = $nameArr[count($nameArr)-1];
        $_newName = date('YmdHis').mt_rand(100,1000).'.'.$postFix;
        $this->linkPath = UPDIR.$this->linkToday.$_newName;
        return  $this->today.$_newName;
    }

    //验证类型
    private function checkType() {
        if(!in_array($this->type,$this->typeArr)) {
            Tool::alertBack('警告：不合法的类型!');
        }
    }

    //验证错误
    private function checkError() {
        if(!empty($this->error)) {
            switch($this->error) {
                case 1 :
                    Tool::alertBack('警告：上传值超过了约定值!');
                    break;
                case 2 :
                    Tool::alertBack('警告：上传值超过了'.'$this->maxsize'.'KB');
                    break;
                case 3 :
                    Tool::alertBack('警告：只有部分文件被上传！');
                    break;
                case 4 :
                    Tool::alertBack('警告：没有任何文件被上传!');
                    break;
                default:
                    Tool::alertBack('未知错误!');
            }
        }
    }
}