<?php
namespace core\view;
class View{
    public function __call($name, $arguments)
    {
        return self::kk($name, $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::kk($name, $arguments);
    }

    public static function kk($name, $arguments){
        return call_user_func_array([new Baaa(),$name],$arguments);
    }

}



?>