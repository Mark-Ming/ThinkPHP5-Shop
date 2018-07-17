<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/6/29
 * Time: 下午5:34
 */
namespace app\common\model;

use think\Model;

class Category extends Model{

    //获取所有菜单信息:（前端使用）
    public function getAllCategories()
    {
        $con = [
            'status' => 1
        ];
        return $this->where($con)->select();
    }

    //获取一/二/三级分类（根据上一级的id）
    public function getChildLevelByParentID($parent_id = 0)
    {
        $con = [
            'parent_id' => $parent_id
        ];
        return $this->where($con)->select();
    }

    //根据分类id获取分类名称
    public function getNameByCategoryID($category_id)
    {
        return $this->where(['id' => $category_id])->value('name');
    }
}