<?php
    //管理员实体类
    class ContentModel extends Model {

        private $title;
        private $nav;
        private $attr;
        private $tag;
        private $info;
        private $thumbnail;
        private $keyword;
        private $source;
        private $author;
        private $commend;
        private $count;
        private $content;
        private $gold;
        private $color;
        private $id;
        private $limit;

        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public function __get($_key) {
            return $this->$_key;
        }


        //获取文档总记录
        public function getListContentTotal() {
            $_sql = "SELECT
                            COUNT(*)
                      FROM
                             cms_content c,
                             cms_nav n
                      WHERE
                             c.nav=n.id
                       AND
                             c.nav IN($this->nav)";
            return parent::total($_sql);
        }

        //获取单条文档数据
        public function getOneContent() {
            $_sql = "SELECT
                           info,
                           author,
                           content,
                           date,
                           source,
                           title,
                           count,
                           id,
                           nav
                       FROM
                           cms_content
                       WHERE
                           id='$this->id'
                           ";
            return parent::One($_sql);
        }


        //获取文档列表内容
        public function getListContent() {
            $_sql = "SELECT
                            c.id,
                            c.title,
                            c.nav,
                            c.attr,
                            c.title t,
                            c.info,
                            c.thumbnail,
                            c.date,
                            c.count,
                            n.nav_name
                     From
                            cms_content c,
                            cms_nav n

                    WHERE
                           c.nav=n.id
                      AND
                            c.nav IN ($this->nav)
                 ORDER BY
                             c.date DESC
                                $this->limit";
            return parent::all($_sql);
        }

        //添加文档内容
        public function addContent() {
            $sql = "INSERT INTO
                               cms_content(
                                    title,
                                    nav,
                                    tag,
                                    info,
                                    thumbnail,
                                    keyword,
                                    source,
                                    author,
                                    commend,
                                    color,
                                    gold,
                                    attr,
                                    count,
                                    content,
                                    date
                                              )
                        VALUES(
                               '$this->title',
                               '$this->nav',
                               '$this->tag',
                               '$this->info',
                               '$this->thumbnail',
                               '$this->keyword',
                               '$this->source',
                               '$this->author',
                               '$this->commend',
                               '$this->color',
                               '$this->gold',
                               '$this->attr',
                               '$this->count',
                               '$this->content',
                               NOW()
                                               ) ";
            return parent::aud($sql);
        }

    }