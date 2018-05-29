<?php
namespace core\model;
class Baaa{
    //定义PDO属性
    protected $pdo;
    //定义一个表名属性
    protected $table;
    //定义一个where条件的属性,默认条件为空
    protected $where= '';
    //定义一个静态主键值的属性
    protected static $pri;


    //定义一个构造函数，只要调这个类，就可以自动连接数据库
    public function __construct($config,$table)
    {
        $this->table = $table;  //把获得到的表名赋值给表名属性
       $this->lianjie($config);  //自动连接数据库
    }


    //定义一个连接数据库的方法
    public function lianjie($config){
//        pp($config);die;
        if (is_null($this->pdo)){
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
            $username = $config['username'];
            $password = $config['password'];
            try{
                $this->pdo = new \PDO($dsn,$username,$password);
                $this->pdo->query('set name utf8');
            }catch(\PDOException $e){
                die($e->getMessage());
            }

        }
    }


    //获取单条数据的方法
    public function find($pri){

//        $sql = 'select * from stu where id=' .$pri;

        //调用下面获取主键名称的方法
        $zj = $this->getPri();
        //组合一个查询单挑数据的sql语句
        $sql = 'select * from ' .$this->table. ' where ' .$zj. '=' .$pri;
//        echo $sql;die;
        //执行sql语句
        $result = $this->pdo->query($sql);
//        pp($result);die;

        //获得sql语句的单条结果
        $data = $result->fetch(\PDO::FETCH_ASSOC);
        //获得所有的结果后，有两种处理方式
        //第一种，直接返回data数据
//        return $data;
        //第二种，返回当前对象,在调用的时候可以进行链式操作
        //返回对象的话，就要把执行sql语句后得到的结果数据(就是$data)存入当前对象中,然后再返回对象
        //这里选择返回对象这个处理方式后，就会用到下面的一个toarray()方法
        $this->data = $data;
        return $this;

    }

    //设置一个获取主键名称的方法
    public function getPri(){
        //组合一个查询表结构的sql语句
        $sql = 'desc '.$this->table;
//        echo $sql;die;
        //执行组合的sql语句
        $a = $this->pdo->query($sql);
        //获得sql语句的数据结果
        $b = $a->fetchAll(\PDO::FETCH_ASSOC);
//        pp($b);die;
        //循环$b,找到有主键id的值,然后返回主键名称的值
        //先设定一个空的字符串，来接收主键名称的值
        $cc = '';
        foreach ($b as $k => $v){
            //进行判断，如果$v里面的KEY 等于 PRI,就说明当前$v对应的就是主键的数据，然后取出主键名称
            if ($v['Key'] == 'PRI'){
                $cc = $v['Field'];
                //当找到主键数据后，就跳出当前循环
                break;
            }
        }
        //然后返回主键名称的值,当调用当前方法的时候，就会得到当前表的主键名称
        return $cc;
    }




    //获取多条数据的方法
    public function getD(){
//        $sql = 'select * from zzz where id > 2';
        //定义查询多条数据的sql语句,
        $sql = 'select * from ' . $this->table . $this->where;
        //调用query()方法来执行组合的sql语句
        $result = $this->pdo->query($sql);
        //获得执行后的数据的结果，设置获得关联数组
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        //获得所有的结果后，有两种处理方式
        //第一种，直接返回data数据
//        return $data;
        //第二种，返回当前对象,在调用的时候可以进行链式操作
        //返回对象的话，就要把执行sql语句后得到的结果数据(就是$data)存入当前对象中,然后再返回对象
        //这里选择返回对象这个处理方式后，就会用到下面的一个toarray()方法
        $this->data = $data;
        return $this;
    }
    //这个方法的作用就是为了返回当前对象的data数据
    public function toarray(){
        //返回当前对象的data数据
        return $this->data;
    }



    //设置一个组合where语句的方法
    public function where($where){
        //如果用户调用了当前条件方法，就说明sql语句是有where条件的
        //where 条件的前后一定要各加一个空格
        $this->where = ' where ' . $where;
//        echo $this->where;die;
        //然后返回当前对象，就是说谁调用这个方法，谁就得到这个where条件
        //返回当前对象，还可以在后面进行链式操作
        return $this;
    }





    //添加数据的方法
    public function add($data){
        //循环需要存入的数据$data
        //定义一个空的字符串来接收字段名的值
        $key = '';
        //定义一个空的字符串来接收字段值的值
        $val = '';
        foreach ($data as $k => $v){
            $key .= $k . ',';
//            echo $key;die;
            $val .= '"' . $v . '",';
        }
        //把最后的逗号去掉
        $key = rtrim($key,',');
        $val = rtrim($val,',');

        //组合sql语句
//        $sql = 'insert into stu (id) values(3)';
        $sql = 'insert into '.$this->table.' ('.$key.') values ('.$val.')';
        echo $sql;
        //执行sql语句
        $data = $this->pdo->exec($sql);
        //返回data数据
        return $data;
    }



    //设置一个编辑的方法
    public function edit($data){
        //循环data数据
        $str = '';
        foreach ($data as $k=>$v){
            $str .= $k .'="' . $v .'".';
        }
        $str = rtrim($str,',');
        //获取主键名称
        $prikey = $this->getPri();
        //组合sql语句
        $sql = 'update '.$this->table.' set '.$str. ' where '.$prikey.' = ' .self::$pri;
        //使用pdo对象调用exec方法来修改数据
        $data = $this->pdo->exec($sql);
        //返回$data数据
        return $data;
    }




    //删除数据的方法
    public function del($pri){
        //获取主键名称
        $prikey = $this->getPri();
//        $sql = 'delete from user where id = 1';
        $sql = 'delete from '.$this->table.' where '.$prikey.' = '.$pri;
        //调用exec方法修改数据
        $data = $this->pdo->exec($sql);
        //返回data数据
        return $data;
    }



    //查询的方法
    public  function query($sql){
        //调用PDO的query方法获取关联表的数据
        $result = $this->pdo->query($sql);
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        //将data数据存入当前对象的临时属性中
        $this->data = $data;
        return $this;
    }

}




?>