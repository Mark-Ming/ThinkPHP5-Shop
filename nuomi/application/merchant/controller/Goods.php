<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/16
 * Time: 下午3:12
 */
namespace app\merchant\controller;


use app\common\controller\Base;
use think\App;

class Goods extends Base {
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Goods');
    }

    public function index()
    {
        //获取所有商品
        $data = $this->model_obj->where(['bis_id' => $this->userInfo->id])->select();
        return view('', [
            'data' => $data
        ]);
    }

    public function add()
    {

        if ($_POST) //保存操作
        {
            $data = input();
            //校验数据
            $validate = validate('Goods');
            $res = $validate->scene('add')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }

            $data['bis_id'] = $this->userInfo->id;

            //保存数据
            $res = $this->model_obj->save($data);
            if (!$res)
            {
                $this->error('添加失败');
            }
            else {
                $this->success('添加成功');
            }
        }
        else //显示添加页面
        {
            //获取当前商户的所有店铺
            $shops = model('Shop')->getShopsByBisID($this->userInfo->id);
            return view('', [
                'shops' => $shops
            ]);
        }
    }


    public function edit()
    {
        if ($_POST)
        {
            $data = input();
            //校验数据
            $validate = validate('Goods');
            $res = $validate->scene('add')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }
            //保存数据
            $res = $this->model_obj->save($data, ['id' => $data['id']]);
            if (!$res)
            {
                $this->error('更新失败');
            }
            else {
                $this->success('更新成功');
            }
        }
        else {
                $id = input('id');
                $data = model('Goods')->where(['id' => $id])->find();
                $shops = model('Shop')->getShopsByBisID($this->userInfo->id);
                return view('', [
                    'good' => $data,
                    'shops' => $shops
                ]);
        }

    }

}