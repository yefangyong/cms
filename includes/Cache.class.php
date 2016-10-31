<?php
//静态页面局部不缓存
class Cache {

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
    private function getContentCount($_content) {
        $_count = $_content->getOneContent()->count;
        echo "
			function getContentCount() {
				document.write('$_count');
			}
		";
    }
}
?>