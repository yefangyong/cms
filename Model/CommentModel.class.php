<?php
    //管理员实体类
    class CommentModel extends Model {

        private $user;
        private $content;
        private $cid;
        private $manner;
        private $limit;

        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public function __get($_key) {
            return $this->$_key;
        }

        //所有评论的数量
        public function getCommentCount() {
            $sql = "SELECT
                         count(*)
                      FROM
                        cms_comment";
            return parent::total($sql);
        }
        //取得所有评论
        public function getAllComment(){
            $_sql = "SELECT
                             c.user,
                             c.content,
                             c.manner,
                             c.date,
                             u.face
                       FROM
                             cms_comment c
                  LEFT JOIN
                             cms_user u
                         ON
                             u.user = c.user
                      WHERE
                             cid ='$this->cid'
                   ORDER BY
                             c.date DESC
                             $this->limit";
            return parent::all($_sql);
        }

        //添加评论
        public function addComment() {
            $sql = "INSERT INTO
                      cms_comment  (
                                     user,
                                     content,
                                     cid,
                                     manner,
                                     date)
                            VALUES (
                                    '$this->user',
                                    '$this->content',
                                    '$this->cid',
                                    '$this->manner',
                                    NOW())";
            return parent::aud($sql);
        }



    }