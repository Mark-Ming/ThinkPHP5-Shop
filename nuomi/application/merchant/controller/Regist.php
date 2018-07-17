<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/5
 * Time: 上午11:26
 */
namespace app\merchant\controller;

use think\Controller;

class Regist extends Controller{
    public function index()
    {
        //获取省级信息
        $provinceArray = model('Region')->getRegionByParentID();
        return view('', [
            'provinceData' => $provinceArray
        ]);
    }

    //根据一级省份id获取其城市
    public function getCitiesByID()
    {
        $parent_id = input('id');
        $data = model('Region')->getRegionByParentID($parent_id);
        return json($data);
    }

    //注册商户的添加方法
    public function save()
    {
        $data = input();
        unset($data['file']);
        //校验数据
        $validate = validate('Business');
        $res = $validate->scene('add')->check($data);
        if (!$res)
        {
            $this->error($res->getError());
        }
        else
        {
            //保存信息
            $data['password'] = md5($data['password']);
            if (empty($data['city']))
            {
                $data['address'] = $data['province'];
            }
            else{
                $data['address'] = $data['province'].','.$data['city'];
            }
            unset($data['province']);
            unset($data['city']);
            $res = model('Business')->save($data);
            if (!$res)
            {
                $this->error('注册失败');
            }
            else{
                $this->success('注册成功', 'login/index');
            }
        }
    }

}