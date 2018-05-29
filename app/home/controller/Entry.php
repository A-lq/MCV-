<?php
namespace app\home\controller;
use core\view\View;
use system\model\Stu;

class Entry{
    public function index(){

        $aa = Stu::find(12)->toarray();
//        pr($aa);
        return View::make()->with('version','版本:v1.10');
    }
}




?>