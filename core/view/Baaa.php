<?php
namespace core\view;
class Baaa{

    //设置一个加载模板路径的属性
    protected $q;

    protected $v=[];
    public function make(){
        $this->q = 'app/'.MM.'/view/'.strtolower(CC).'/'.AA.'.php';
//        echo $this->q;
        //返回当前对象
        return $this;

    }



    //设置一个with方法
    public function with($name,$value){
        //给当前的变量属性$vv赋值
        $this->v[$name] = $value;
//        pr($this->v[$name]);die;
        //返回当期对象
        return $this;
    }




    //把对象转成字符串进行输出的一个魔术方法
    public function __toString()
    {

        extract($this->v);
        //引入加载的模板路径
        include $this->q;
        //然后返回一个空的字符串
        return '';
    }
}




?>