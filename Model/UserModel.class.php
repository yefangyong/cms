<?php
    //管理员实体类
    class UserModel extends Model {
        private $id;
        private $user;
        private $pass;
        private $email;
        private $answer;
        private $question;
        private $face;
        private $time;
        private $state;
        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public  function __get($_key) {
            return $this->$_key;
        }

        //获得所有记录数据的总和
        public function getUserTotal() {
            $_sql = "SELECT
										COUNT(*)
								FROM
										cms_user";
            return parent::total($_sql);
        }

        //获得单一用户数据
        public function getOneUser() {
            $_Sql = "SELECT
                            id,
                            user,
                            pass,
                            face,
                            email,
                            question,
                            answer,
                            state
                      FROM
                            cms_user
                      Where id='$this->id'";
            return parent::One($_Sql);
        }

        //修改会员
        public function updateUser() {
            $_sql = "UPDATE
											cms_user
									SET
											pass='$this->pass',
											face='$this->face',
											question='$this->question',
											answer='$this->answer',
											state='$this->state',
											email='$this->email'
							WHERE
											id='$this->id'
								LIMIT
											1";
            return parent::aud($_sql);
        }
        //获得所有的记录数据
        public function getAllUser() {
            $sql = "SELECT
                            *
                      FROM
                            cms_user";
            return parent::all($sql);
        }

        //删除选定的记录
        public function deleteUser() {
            $sql = "DELETE
                     FROM
                            cms_user
                     WHERE
                            id='$this->id'";
            return parent::aud($sql);
        }
        //更新最新的登录时间
        public function setLaterUser() {
            $sql = "update
                             cms_user
                       set
                             time='$this->time'
                     where
                            id='$this->id'";
            return parent::aud($sql);
        }

        //检查用户名
        public function checkUser() {
            $sql = "SELECT
                            user
                      from
                            cms_user
                      where
                            user='$this->user'";
            return parent::One($sql);
        }

        public function checkEmail() {
            $sql = "SELECT
                          email
                     from
                          cms_user
                    where
                          email='$this->email'";
            return parent::One($sql);
        }

        public function getLastUser() {
            $sql = "select
                           user,
                           face
                      from
                            cms_user
                      order by
                            time desc
                        limit
                             0,6";
            return parent::all($sql);
        }

        public function checkLogin() {
            $sql = "SELECT
                        user,
                        pass,
                        face,
                        id
                    FROM
                        cms_user
                   WHERE
                        user='$this->user'
                    AND
                        pass='$this->pass'";
            return parent::One($sql);
        }


        //增加会员
        public function addUser() {
            $sql = "INSERT INTO
                               cms_user(
                                    user,
                                    pass,
                                    email,
                                    question,
                                    answer,
                                    face,
                                    time,
                                    state,
                                    date
                                              )
                        VALUES(
                               '$this->user',
							   '$this->pass',
							   '$this->email',
							   '$this->question',
							   '$this->answer',
							   '$this->face',
							   '$this->time',
							   '$this->state',
							   NOW()
                                               ) ";
            return parent::aud($sql);
        }

    }