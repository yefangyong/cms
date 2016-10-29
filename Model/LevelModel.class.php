<?php
    //管理员实体类
    class LevelModel extends Model {
        private $level_name;
        private $level_info;
        private $id;
        private $level;
        private $limit;

        //拦截器(__set)
        public function __set($_key, $_value) {
            $this->$_key = $_value;
        }

        //拦截器(__get)获取不能访问的变量和值
        public function __get($_key) {
            return $this->$_key;
        }

        //获得等级的总记录
        public function getLevelTotal()
        {
            $_sql = "SELECT COUNT(*) FROM cms_level";
            return parent::total($_sql);
        }

        //查询所有等级,不带limit
        public function getAllLevel() {
            $sql = "SELECT
                           id,
                           level_name
                      FROM
                           cms_level
                   ORDER BY
                           id ASC";
            return parent::all($sql);
        }

        //查询所有等级带limit
        public function getAllLimitLevel() {
            $sql = "SELECT
                           id,
                           level_name
                      FROM
                           cms_level
                   ORDER BY
                           id ASC
                           $this->limit;
                           ";
            return parent::all($sql);
        }

        //查询单条数据
        public function getOneLevel() {
            $_sql = "SELECT
										id,
										level_name,
										level_info
								FROM
										cms_level
							WHERE
										id='$this->id'
							  OR
							            level_name='$this->level_name'
								LIMIT
										1";
            return parent::one($_sql);
        }

        //查询所有的等级
        public function getLevel() {
            $sql = "SELECT
                      id,
                      level_name,
                      level_info
                    FROM
                      cms_level
                    ORDER BY
                      id ASC
                    LIMIT
                      0,10";
            return parent::all($sql);
        }

        public function addLevel() {
            $sql = "INSERT INTO
                               cms_level(
                                    level_name,
                                    level_info
                                              )
                        VALUES(
                               '$this->level_name',
							   '$this->level_info'
                                               ) ";
            return parent::aud($sql);
        }

        public function updateLevel() {
            $sql = "UPDATE
                         cms_level
                       SET
                         level_name = '$this->level_name',
                         level_info='$this->level_info'
                     WHERE
                          id='$this->id'
                      LIMIT
                           1";
            return parent::aud($sql);
        }

        public function deleteLevel() {
            $sql = "DELETE FROM
                             cms_level
                       WHERE
                             id='$this->id'
                       LIMIT
                             1";
             return parent::aud($sql);
        }
    }