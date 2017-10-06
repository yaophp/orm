<?php
namespace yaophp\service;

use think\Model as ThinkModel;
class Model extends ThinkModel
{
    protected $createTime = 'time_create';
    // 更新时间字段
    protected $updateTime = 'time_update';
}