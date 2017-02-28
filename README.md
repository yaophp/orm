
An orm lib independence from ThinkPHP 5.0.2 


About ThinkPHP (http://thinkphp.cn)


Fast start: git clone or composer require then make a demo.php

................................................................demo.php

<?php
require "vendor/autoload.php";

use orm\Database;
use think\Db;
use think\Model;

//your database config, more info in orm/src/config.php
Database::config([
        'username' => 'yourusername',
        'password' => 'yourpassword',
        'database' => 'yourdatabase'
    ]);

//example Orign:
var_dump(Db::query('select * from article where id = :id', ['id' => 1]));

//example Active Record:
var_dump(Db::name('article')->where(['id' => 1])->find());

//example ORM:
//do not use the way "\think\Loader::model()" to get an instance of Model
class Article extends Model
{
    public function getId($id)
    {
        return $this->where(['id' => $id])->find();
    }
}
$article = new Article();
var_dump($article->getId(1));

................................................................having fun
