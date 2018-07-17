<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/6/28
 * Time: 下午3:21
 */
namespace app\common\model;

use think\Model;

class Region extends Model{
    //获取热门城市  条件: status = 2
    public function getHotCities()
    {
        $con = [
            'status' => 2
        ];
        return $this->where($con)->order('pinyin asc')->select();
    }

    //获取默认城市   条件: is_default = 1
    public function getDefaultCity()
    {
        $con = [
            'is_default' => 1
        ];
        return $this->where($con)->find();
    }

    public function getRegionByParentID($parent_id = 0)
    {
        $res = $this->where("status > 0 and parent_id=".$parent_id)->select();
        return $res;
    }

    public function getRegionNameByID($id)
    {
        return $this->where(['id'=> $id])->value('name');
    }
}
