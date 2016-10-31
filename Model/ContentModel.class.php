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
        private $sort;
        private $readlimit;
        private $limit;

        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public function __get($_key) {
            return $this->$_key;
        }

        //累计文档的点击量
        public function setContentCount() {
            $_sql = "UPDATE
											cms_content
									SET
											count=count+1
							WHERE
											id='$this->id'
								LIMIT
											1";
            return parent::aud($_sql);
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
                           attr,
                           sort,
                           readlimit,
                           color,
                           commend,
                           source,
                           title,
                           count,
                           id,
                           nav,
                           thumbnail,
                           tag,
                           keyword,
                           gold
                       FROM
                           cms_content
                       WHERE
                           id='$this->id'
                           ";
            return parent::One($_sql);
        }

        public function updateContentById() {
            $_sql = "UPDATE
											cms_content
								SET
											title='$this->title',
											nav='$this->nav',
											info='$this->info',
											thumbnail='$this->thumbnail',
											source='$this->source',
											author='$this->author',
											tag='$this->tag',
											keyword='$this->keyword',
											attr='$this->attr',
											content='$this->content',
											commend='$this->commend',
											count='$this->count',
											gold='$this->gold',
											color='$this->color',
											sort='$this->sort',
											readlimit='$this->readlimit'
							WHERE
											id='$this->id'
								LIMIT
											1";
            return parent::aud($_sql);
        }

        public function deleteContent() {
            $_sql = "DELETE

                      FROM
                             cms_content
                      WHERE
                            id='$this->id'
                      LIMIT
                            1";
            return parent::aud($_sql);
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
                                    sort,
                                    readlimit,
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
                               '$this->sort',
                               '$this->readlimit',
                               NOW()
                                               ) ";
            return parent::aud($sql);
        }

    }