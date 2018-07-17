<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/16
 * Time: 下午5:09
 */
namespace app\common\validate;

use think\Validate;

class Goods extends Validate{
    protected $rule = [
        'name' => 'require|max:30',
        'shop_id' => 'require',
        'old_price' => 'require',
        'new_price' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'image_url' => 'require',
        'good_desc' => 'require',
        'notice' => 'require',
        'count' => 'require'
    ];

    protected $message = [
        'name.require' => '商品名不能为空',
        'name.max' => '商品名称长度不能超过30',
        'shop_id.require' => '请选择店铺',
        'old_price.require' => '请输入原价',
        'new_price.require' => '请输入现价',
        'start_time.require' => '请选择活动开始日期',
        'end_time.require' => '请选择活动结束日期',
        'image_url.require' => '请上传商品图片',
        'good_desc.require' => '请输入商品描述',
        'notice.require' => '请输入购买须知',
        'count.require' => '请输入库存量'
    ];

    protected $scene = [
        'add' => ['name', 'shop_id', 'old_price', 'new_price', 'start_time', 'end_time', 'image_url', 'good_desc', 'notice', 'count']
    ];
}