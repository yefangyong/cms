<?php
class Image {
    private $file;   //图片地址
    private $width;  //宽度
    private $height; //高度
    private $type;   //图片的类型

    //构造方法，初始化
    public function __construct($_file) {
        $this->file = $_SERVER["DOCUMENT_ROOT"].$_file;
        list($this->width,$this->height,$this->type)=getimagesize($this->file);
        $this->img = $this->getFormImg($this->file,$this->type);
    }


    //缩略图(固定长高容器，图像等比例，扩容填充，裁剪)[固定了大小，不失真，不变形]
    public function thumb($new_width,$new_height) {

        //创建一个容器
        $_n_w = $new_width;
        $_n_h = $new_height;

        //创建裁剪点
        $_cut_width = 0;
        $_cut_height = 0;

        //等比例缩放
        if ($this->width < $this->height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_height = ($new_width / $this->width) * $this->height;
        }


        if ($new_width < $_n_w) { //如果新高度小于新容器高度
            $r = $_n_w / $new_width; //按长度求出等比例因子
            $new_width *= $r; //扩展填充后的长度
            $new_height *= $r; //扩展填充后的高度
            $_cut_height = ($new_height - $_n_h) / 2; //求出裁剪点的高度
        }

        if ($new_height < $_n_h) { //如果新高度小于容器高度
            $r = $_n_h / $new_height; //按高度求出等比例因子
            $new_width *= $r; //扩展填充后的长度
            $new_height *= $r; //扩展填充后的高度
            $_cut_width = ($new_width - $_n_w) / 2; //求出裁剪点的长度
        }


        $this->new = imagecreatetruecolor($_n_w,$_n_h);
        imagecopyresampled($this->new,$this->img,0,0,$_cut_width,$_cut_height,$new_width,$new_height,$this->width,$this->height);
    }

    //加载图片，返回图片各种资源类型，
    private function getFormImg($_file,$_type) {
        switch($_type) {
            case 1:
                $img = imagecreatefromgif($_file);
                break;
            case 2 :
                $img = imagecreatefromjpeg($_file);
                break;
            case 3:
                $img = imagecreatefrompng($_file);
                break;
            default :
                Tool::alertBack('警告：本图片类型本系统不支持!');
        }
        return $img;
    }

    public function out() {
        imagepng($this->new,$this->file);
        imagedestroy($this->img);
        imagedestroy($this->new);
    }
}
