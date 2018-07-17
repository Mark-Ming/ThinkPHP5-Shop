<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/4
 * Time: 下午5:23
 */
namespace app\common\model;

use think\Model;

class Business extends Model{
    public function getAllBusiness()
    {
        return $this->select();
    }
}