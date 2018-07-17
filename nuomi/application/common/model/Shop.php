<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/11
 * Time: 上午11:07
 */
namespace app\common\model;

use think\Model;

class Shop extends Model{
    public function getAllShops()
    {
        return $this->select();
    }

    //根据商户id获取店铺
    public function getShopsByBisID($bis_id = 0)
    {
        $con = [
            'bis_id' => $bis_id
        ];
        return $this->where($con)->select();
    }
}