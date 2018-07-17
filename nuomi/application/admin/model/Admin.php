<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/4
 * Time: 上午11:54
 */
namespace app\admin\model;

use think\Model;

class Admin extends Model{

    public function getAllAdmin()
    {
        return $this->select();
    }
}