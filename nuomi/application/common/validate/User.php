<?php
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require|max:30',
        'password' => 'require|min:6',
        'phoneNumber' => 'mobile',
        'email' => 'email'
    ];

    protected $message = [
        'username.require' => '用户名必须',
        'username.max' => '用户名长度不能超过30',
        'password.require' => '密码不能为空',
        'password.min' => '密码长度不能少于6位',
        'phoneNumber' => '手机号码不正确',
        'email' => '邮箱格式不正确'
    ];

    protected $scene = [
        'add' => ['username', 'password', 'phoneNumber', 'email'],
        'login' => ['username', 'password']
    ];
}
