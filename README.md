
## About
An orm lib independence from ThinkPHP 

update to 5.1.0 RC1


## Installation

```
git clone  then composer install 
```

or

```
composer require yaophp/orm
```

## Usage
### Demo.php 
```php
<?php
require "vendor/autoload.php";

use yaophp\Orm;
use think\Db;
use think\Model;

//your database config, more info in orm/src/config.php
Orm::config([
        'username' => 'yourusername', 
        'password' => 'yourpassword', 
        'database' => 'yourdatabase'
    ]);

//example 1:
var_dump(Db::query('select * from article where id = :id', ['id' => 1]));

//example 2:
// from 5.1.0 RC1 where expression not support array type 
// var_dump(Db::name('article')->where(['id' => 1])->find()); // wrong
var_dump(Db::name('article')->where('id', '=', 1)->find()); // right

//example 3:
//do not use the way "\think\Loader::model()" to get an instance of Model
class Article extends Model
{
    public function getId($id)
    {
        return $this->where('id', '=', 1)->find();
    }
}
$article = new Article();
var_dump($article->getId(1));

```

## link
ThinkPHP (https://www.kancloud.cn/manual/thinkphp5_1/353997)