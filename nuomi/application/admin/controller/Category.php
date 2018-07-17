<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/3
 * Time: 下午5:24
 */
namespace app\admin\controller;

use app\common\controller\Base;
use think\App;

//分类管理
class Category extends Base {

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Category');
    }

    public function index()
    {
        //获取所有一级分类
        $data = $this->model_obj->getChildLevelByParentID();
        return view('', [
            'data' => $data
        ]);
    }

    //根据上一级分类的ID获取二、三级分类
    public function subcategory()
    {
        $parent_id = input('id');
        $data = $this->model_obj->getChildLevelByParentID($parent_id);
        return view('', [
            'data' => $data
        ]);
    }

}