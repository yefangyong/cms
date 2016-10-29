<?php
//模型基类
class Model {


    //获取下一个增值id模型
    public function nextId($_table) {
        $_sql = "SHOW TABLE STATUS LIKE '$_table'";
        $_object = $this->One($_sql);
        return $_object->Auto_increment;
    }
    //查询总记录模型
    protected function total($_sql) {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_total =$_result->fetch_row();
        DB::unDB($_result,$_db);
        return $_total[0];
    }
    //查询单个数据模型
    protected function One($sql) {
        $_db = DB::getDB();
        $result = $_db->query($sql);
        $_object = $result->fetch_object();
        DB::unDB($result,$_db);
        return $_object;
    }

    //查询多条数据模型
    protected function all($sql) {
        $_db = DB::getDB();
        $_result = $_db->query($sql);
        $_html = array();
        while (!!$_objects = $_result->fetch_object()) {
            $_html[] = $_objects;
        }
        DB::unDB($_result,$_db);
        return $_html;
    }


    //增删修模型
        protected function aud($sql) {
            $_db = DB::getDB();
            $_db->query($sql);
            $_affected_rows = $_db->affected_rows;
            DB::unDB($result=null,$_db);
            return $_affected_rows;
        }

    //执行多条SQL语句
    public function multi($_sql) {
        $_db = DB::getDB();
        $_db->multi_query($_sql);
        DB::unDB($_result = null, $_db);
        return true;
    }
}