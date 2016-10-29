<?php
    //管理员实体类
    class NavModel extends Model {

        private $limit;
        private $nav_name;
        private $nav_info;
        private $id;
        private $pid;
        private $sort;
        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public  function __get($_key) {
            return $this->$_key;
        }

        public function getAllNavChildId() {
            $_sql = "SELECT
                           id
                      FROM
                           cms_nav
                     WHERE
                          pid<>0";
            return parent::all($_sql);
        }


        //获取主类的字类的id
        public function getNavChildId() {
            $_sql ="SELECT
                           id
                      FROM
                           cms_nav
                    WHERE
                           pid='$this->id'";
            return parent::all($_sql);
        }

        //导航排序
        public function setNavSort() {
            foreach ($this->sort as $_key=>$_value) {
                if (!is_numeric($_value)) continue;
                $_sql .= "UPDATE cms_nav SET sort='$_value' WHERE id='$_key';";
            }
            return parent::multi($_sql);
        }
        //前台显示指定的主导航
        public function getFrontNav() {
            $_sql = "SELECT
                             id,
                             nav_name
                      FROM
                             cms_nav
                      WHERE
                             pid=0
                      ORDER BY
                             sort ASC
                      LIMIT
                            0,".NAV_SIZE;
            return parent::all($_sql);
        }



        //获得主导航的总记录
        public function getNavTotal() {
            $_sql = "SELECT COUNT(*) FROM cms_nav WHERE pid=0";
            return parent::total($_sql);
        }

        //获得子导航的总记录
        public function getNavChildTotal() {
            $_sql = "SELECT COUNT(*) FROM cms_nav WHERE pid='$this->id'";
            return parent::total($_sql);
        }

        //查询所有的导航
        public function getALLNav() {
            $_sql = "SELECT
                             id,
                             nav_name,
                             nav_info,
                             sort
                      FROM
                             cms_nav
                      WHERE
                             pid=0
                    ORDER BY
                              sort ASC
                             $this->limit
                      ";
            return parent::all($_sql);
        }

        //查询所有的导航,不带limit
        public function getALLFrontNav() {
            $_sql = "SELECT
                             id,
                             nav_name,
                             nav_info,
                             sort
                      FROM
                             cms_nav
                      WHERE
                             pid=0
                    ORDER BY
                              sort ASC
                      ";
            return parent::all($_sql);
        }
        //查询所有的子导航,带limit
        public function getALLChildNav() {
        $_sql = "SELECT
                             id,
                             nav_name,
                             nav_info,
                             sort
                      FROM
                             cms_nav
                      WHERE
                             pid='$this->id'
                      ORDER BY
                           sort ASC
                             $this->limit";
        return parent::all($_sql);
    }

        //查询所有的子导航，不带limit,在前台显示用的
        public function getALLChildFrontNav() {
            $_sql = "SELECT
                             id,
                             nav_name,
                             nav_info,
                             sort
                      FROM
                             cms_nav
                      WHERE
                             pid='$this->id'
                      ORDER BY
                           sort ASC
                            ";
            return parent::all($_sql);
        }

        //添加导航
        public function addNav() {
            $sql = "INSERT INTO
                               cms_nav(
                                    nav_name,
                                    nav_info,
                                    pid,
                                    sort
                                              )
                        VALUES(
                               '$this->nav_name',
							   '$this->nav_info',
							   '$this->pid',
							   ".parent::nextId('cms_nav')."
                                               ) ";
            return parent::aud($sql);
        }

        public function deleteNav() {
            $sql = "DELETE FROM
                             cms_nav
                       WHERE
                             id='$this->id'
                       LIMIT
                             1";
            return parent::aud($sql);
        }

        //查询单条数据
        public function getOneNav() {
            $_sql = "SELECT
										n1.id,
										n1.nav_name,
										n1.nav_info,
										n2.id iid,
										n2.nav_name nnav_name
								FROM
										cms_nav n1
								LEFT JOIN
								       cms_nav n2
								      ON
								        n1.pid=n2.id
							WHERE
										n1.id='$this->id'
							  OR
							            n1.nav_name='$this->nav_name'
								LIMIT
										1";
            return parent::one($_sql);
        }

        //修改数据
        public function updateNav() {
            $sql = "UPDATE
                         cms_nav
                       SET
                         nav_name = '$this->nav_name',
                         nav_info='$this->nav_info'
                     WHERE
                          id='$this->id'
                      LIMIT
                           1";
            return parent::aud($sql);
        }
    }