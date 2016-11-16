<?php
    //管理员实体类
    class UserModel extends Model {
        private $id;
        private $user;
        private $pass;
        private $email;
        private $answer;
        private $question;
        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public  function __get($_key) {
            return $this->$_key;
        }


        //添加导航
        public function addUser() {
            $sql = "INSERT INTO
                               cms_user(
                                    user,
                                    pass,
                                    email,
                                    question,
                                    answer,
                                    date
                                              )
                        VALUES(
                               '$this->user',
							   '$this->pass',
							   '$this->email',
							   '$this->question',
							   '$this->answer',
							   NOW()
                                               ) ";
            return parent::aud($sql);
        }

    }