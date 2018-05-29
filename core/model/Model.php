<?php
namespace core\model;
class Model{
    //定义连接数据库的配置项属性
    protected static $config;

    public function __call($name, $arguments)
    {
        return self::abc($name, $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
//       echo $name;die;
        return self::abc($name, $arguments);
    }


    public static function abc($name,$arguments){

        //这个方法，可以获得当前类的名称,获得的是一个数组，用一个变量来接收
        $lm = get_called_class();

        //然后把获得到的类名称切割成数组，取下标为2的就是要被调用的类的名称
        $table = explode('\\',$lm)[2];

        $table = strtolower($table);
//        pr($table);die;
        return call_user_func_array([new Baaa(self::$config,$table),$name],$arguments);
    }




    //设置一个获取配置项的方法
    public static function getConfig($config){
        //将$config变成一个当前对象的属性
        self::$config = $config;
    }
}



?>