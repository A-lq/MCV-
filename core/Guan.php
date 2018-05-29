<?php
namespace core;
class Guan{
    //进入到这个类中，会根据get参数传递的值进行安排
    public function index(){
//        pr($_GET);
        //进行判断,如果传递了get参数，就获取其下标值分别对应模块，控制器,方法

        if (isset($_GET['s'])){
            //把传递的get参数s的值进行分割,取其下标分别对应的值
            $info = explode('/',$_GET['s']);
//            pr($info);
            $m = $info[0];  //模块默认值
            $c = $info[1];  //控制器默认值
            $a = $info[2];  //方法默认值
        }else{
            //如果没有传递get参数，就给他设置默认值
            $m = 'home';  //默认的模块
            $c = 'Entry'; //默认的控制器
            $a = 'index'; //默认的方法
        }

        //定义三个默认的常量
        define('MM',$m);
        define('CC',$c);
        define('AA',$a);


        //把调用的控制器的类名组合起来
//        $class = 'app\home\controller\Entry';
        $class = 'app\\'.$m.'\\controller\\'.$c;
//        echo $class;
        echo call_user_func_array([new $class,$a],[]);
    }
}




?>