<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/14
 * Time: 下午3:17
 */
namespace app\common\validate;

use think\Validate;

class Shop extends Validate
{
    protected $rule = [
        'name' => 'require|max:20',
        'category_id' => 'require',
        'telphone' => 'mobile',
        'logo' => 'require',
        'license' => 'require',
        'province' => 'require',
        'city' => 'require',
        'address' => 'require',
        'content' => 'require',
        'open_time' => 'require'
    ];

    protected $message = [
        'name.require' => '请填写店铺名',
        'name.max' => '用户名长度不能超过20',
        'category_id.require' => '请选择分类',
        'telphone' => '手机号码不正确',
        'logo.require' => '请上传logo图片',
        'license.require' => '请上传营业执照',
        'province.require' => '请选择所在省份',
        'city.require' => '请选择所在城市',
        'address.require' => '请输入详细地址',
        'content.require' => '请输入简介',
        'open_time.require' => '请选择营业时间'
    ];

    protected $scene = [
        'add' => ['name', 'category_id', 'telphone', 'logo', 'license', 'province', 'city', 'address', 'content', 'open_time'],
        'edit' => ['name', 'telphone', 'logo', 'content', 'open_time']
    ];
}