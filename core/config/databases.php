<?php
//设置连接数据库的配置项的数组
$config = [
    'host' => 'localhost',
    'dbname' => 'zzz',
    'username' => 'root',
    'password' => 'root'
];


//由于当前文件是自动加载的，优先级是高于其他的任何方法的，所以这里调用的方法会被优先调用
\core\model\Model::getConfig($config);



?>