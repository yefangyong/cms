<?php
    //管理员实体类
    class ManageModel extends Model {
        private $admin_user;
        private $admin_pass;
        private $level;
        private $id;
        private $limit;
        private $last_ip;

        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public function __get($_key) {
            return $this->$_key;
        }

        public  function setLoginCount() {
            $_sql = "UPDATE
                           cms_manage
                        SET
                           login_count = login_count+1,
                           last_ip='$this->last_ip',
                           last_time=NOW()
                      WHERE
                           admin_user='$this->admin_user'
                      LIMIT
                           1";
            return parent::aud($_sql);
        }

        //查询登录管理员
        public function getLoginManage() {
            $_sql = "SELECT
										m.admin_user,
										l.level_name
								FROM
										cms_manage m,
										cms_level l
								WHERE
										m.admin_user='$this->admin_user'
									AND
										m.admin_pass='$this->admin_pass'
									AND
										m.level=l.id
									LIMIT 1";
            return parent::one($_sql);
        }

        //查询单个管理员
        public function getOneManage() {
            $_sql = "SELECT
										id,
										admin_user,
										admin_pass,
										level
								FROM
										cms_manage
							WHERE
										id='$this->id'
									OR
										admin_user='$this->admin_user'
									OR
										level='$this->level'
								LIMIT
										1";
            return parent::one($_sql);
        }

        //获得管理员的总记录
        public function getManageTotal() {
            $_sql = "SELECT COUNT(*) FROM cms_manage";
            return parent::total($_sql);
        }

        //查询所有的管理员
        public function getManage() {
            $sql = "SELECT
                      m.id,
                      m.admin_user,
                      m.login_count,
                      m.last_ip,
                      m.last_time,
                      l.level_name
                    FROM
                      cms_manage m,
                      cms_level l
                    WHERE
                      l.id = m.level
                    ORDER BY
                      m.id ASC
                    $this->limit";
            return parent::all($sql);
        }

        public function addManage() {
            $sql = "INSERT INTO
                               cms_manage(
                                    admin_user,
                                    admin_pass,
                                    level,
                                    reg_time
                                              )
                        VALUES(
                               '$this->admin_user',
							   '$this->admin_pass',
							   '$this->level',
							    NOW()
                                               ) ";
            return parent::aud($sql);
        }

        public function updateManage() {
            $sql = "UPDATE
                         cms_manage
                       SET
                         admin_pass = '$this->admin_user',
                         level='$this->level'
                     WHERE
                          id='$this->id'
                      LIMIT
                           1";
            return parent::aud($sql);
        }

        public function deleteManage() {
            $sql = "DELETE FROM
                             cms_manage
                       WHERE
                             id='$this->id'
                       LIMIT
                             1";
             return parent::aud($sql);
        }
    }