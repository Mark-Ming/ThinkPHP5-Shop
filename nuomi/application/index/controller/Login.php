<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/6/26
 * Time: 上午11:23
 */
namespace app\index\controller;

use think\Controller;

class Login extends Controller{
    public function index()
    {
        return view();
    }
    //登录
    public function login()
    {
        //获取到用户名和密码
        $data = input('post.');
        //数据校验
        $validate = validate('User');
        $res = $validate->scene('login')->check($data);
        if (!$res)
        {
            $this->error($validate->getError());
        }
        //进行数据库匹配
        $res = model('User')->checkUsername($data['username']);
        if (!$res)
        {
            return json([
                'status' => '-1',
                'message' => '该用户名不存在'
            ]);
        }
        else{
            if ($res['password'] != md5($data['password']))
            {
                return json([
                    'status' => '0',
                    'message' => '密码错误',
                ]);
            }
            else
            {
                //将用户名存入session
                session('username', $data['username']);
                return json([
                    'status' => '1',
                    'message' => '登录成功'
                ]);
            }
        }
    }

    //退出登录
    public function logout()
    {
        //清空当前session
        session('username', null);
        //页面跳转到登录页
        $this->redirect('index/index');
    }
}