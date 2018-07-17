<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/11
 * Time: 上午10:52
 */
namespace app\merchant\controller;

use app\common\controller\Base;
use think\App;

class Shop extends Base{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Shop');
    }

    public function index()
    {
        $data = $this->model_obj->getAllShops();
        return view('', [
            'data' => $data
        ]);
    }

    //添加店铺的页面
    public function add()
    {
        //获取省份信息
        $provinceArray = model('Region')->getRegionByParentID();
        //获取所有一级分类
        $categories = model('Category')->getChildLevelByParentID();
        return view('', [
            'provinceData' => $provinceArray,
            'categories' => $categories
        ]);
    }

    //获取下级分类
    public function subcategory()
    {
        $parent_id = input('id');
        $data = model('Category')->getChildLevelByParentID($parent_id);
        return json($data);
    }

    //
    public function save()
    {
        $data = input();
        //校验数据
        $validate = validate('Shop');
        $res = $validate->scene('add')->check($data);
        if (!$res)
        {
            $this->error($validate->getError());
        }
        //校验地址
        $region = model('Region');
        $map = \Map::getLngLat($region->getRegionNameByID($data['province']).$region->getRegionNameByID($data['city']).'市'.$data['address']);
        if ($map['status'] && $map['result']['location']['confidence'] >= 80)
        {
            $this->error('您输入的地址不正确');
        }
        //整理数据
        $shop_data['name'] = $data['name'];
        $shop_data['category_id'] = implode(',', $data['category_id']);
        $shop_data['logo'] = $data['logo'];
        $shop_data['license'] = $data['license'];
        $shop_data['telphone'] = $data['telphone'];
        $shop_data['city_id'] = $data['province'].','.$data['city'];
        $shop_data['address'] = $data['address'];
        $shop_data['open_time'] = $data['open_time'];
        $shop_data['content'] = $data['content'];
        $shop_data['longitude'] = $map['result']['location']['lng'];
        $shop_data['latitude'] = $map['result']['location']['lat'];
        $shop_data['bis_id'] = $this->userInfo->id;

        //存储
        $res = $this->model_obj->save($shop_data);
        if (!$res)
        {
            $this->error('商铺添加失败');
        }
        else
        {
            $this->success('商铺添加成功');
        }
    }


    public function edit()
    {
        if ($_POST)
        {
            $data = input();
            //校验数据
            $validate = validate('Shop');
            $res = $validate->scene('edit')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }

            //存储
            $res = $this->model_obj->save($data, ['id' => $data['id']]);
            if (!$res)
            {
                $this->error('商铺更新失败');
            }
            else
            {
                $this->success('商铺更新成功');
            }
        }
        else
        {
            $id = input('id');
            $info = $this->model_obj->where(['id' => $id])->find();
            return view('', [
                'shop' => $info
            ]);
        }
    }




}