<?php
class Page {
    private $total;    //总记录数
    private $pagesize;  //每页多少条
    private $limit;    //数据库选取多少条
    private $page;    //分页数
    private $pagenum;  //总页码
    private $bothnum;  //两边保持分页数字的量

    //构造方法初始化
    public function __construct($_total,$_pagesize){
        $this->total = $_total;
        $this->pagesize = $_pagesize;
        $this->pagenum = ceil($this->total / $this->pagesize);
        $this->page = $this->setPage();
        $this->limit = "LIMIT ".($this->page-1)*$this->pagesize.",$this->pagesize";
        $this->url = $this->setUrl();
        $this->bothnum = 3;
    }

    //拦截器
    public function __get($_key) {
        return $this->$_key;
    }

    //获得当前页码
    private function setPage() {
        if(!empty($_GET['page'])) {
            if($_GET['page']>0) {
                if($_GET['page']>$this->pagenum) {
                    return $this->pagenum;
                }else{
                    return $_GET['page'];
                }
            }else {
                return 1;
            }
        }else{
            return 1;
        }
    }

    //解析url解决多余的page问题，动态获取地址
    private function setUrl() {
        $_url = $_SERVER["REQUEST_URI"];
        $_par = parse_url($_url);//解析url
        //print_r($_par);
        if(isset($_par['query'])){
            parse_str($_par['query'],$_query);
            //print_r($_query);
            unset($_query['page']);
            $_url = $_par['path'].'?'.http_build_query($_query);
        }
        return $_url;
    }

    //数字目录
    private function pageList() {
        //显示当前页前三条数据
        for ($i=$this->bothnum;$i>=1;$i--) {
            $_page = $this->page-$i;
            if ($_page < 1) continue;
            $_pagelist .= ' <a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a> ';
        }
        //显示当前页数据
        $_pagelist .= ' <span class="me">'.$this->page.'</span> ';
        //显示当前页后三条的数据
        for ($i=1;$i<=$this->bothnum;$i++) {
            $_page = $this->page+$i;
            if ($_page > $this->pagenum) break;
            $_pagelist .= ' <a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a> ';
        }
        return $_pagelist;
    }

    private function first() {
        if($this->page>$this->bothnum+1) {
            return ' <a href="' . $this->url . '">1</a>... ';
        }
    }

    private function prev() {
        if($this->page == 1) {
            return '<span class="disabled">上一页</span>';
        }
        return ' <a href="'.$this->url.'&page='.($this->page-1).'">上一页</a> ';
    }

    private function next() {
        if($this->page == $this->pagenum) {
            return '<span class="disabled">下一页</span>';
        }
        return ' <a href="'.$this->url.'&page='.($this->page+1).'">下一页</a> ';
    }

    private function last() {
        if(($this->pagenum - $this->page) > $this->bothnum) {
        return ' ...<a href="'.$this->url.'&page='.($this->pagenum).'">'.$this->pagenum.'</a> ';
        }
    }


    public function showpage() {
        $page.=$this->first();
        $page.=$this->pageList();
        $page.=$this->last();
        $page.=$this->prev();
        $page.=$this->next();
        return $page;

    }


}