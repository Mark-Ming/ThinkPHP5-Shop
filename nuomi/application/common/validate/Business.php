<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/9
 * Time: 下午2:38
 */
namespace app\common\validate;

use think\Validate;

class Business extends Validate{
    protected $rule = [
        'username' => 'require|max:30',
        'password' => 'require|min:6',
        'phone' => 'mobile',
        'email' => 'email',
        'person_id' => 'require',
        'person_img' => 'require',
        'province' => 'require'
    ];

    protected $message = [
        'username.require' => '用户名不能为空',
        'username.max' => '用户名长度不能超过30',
        'password.require' => '密码不能为空',
        'password.min' => '密码长度不能少于6位',
        'phone' => '手机号码不正确',
        'email' => '邮箱格式不正确',
        'person_id.require' => '身份证号不能为空',
        'person_img.require' => '请上传身份证照片',
        'province.require' => '请选择所在省份'
    ];

    protected $scene = [
        'add' => ['username', 'password', 'phone', 'email', 'person_id', 'person_img', 'province']
    ];


}