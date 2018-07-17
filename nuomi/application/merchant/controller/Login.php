<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/5
 * Time: 上午10:03
 */
namespace app\merchant\controller;

use app\common\controller\Base;
use think\App;

class Login extends Base{

    private $business;

    public function __construct(App $app = null)
    {
        if (session('user'))
        {
            $this->redirect('index/index');
        }
        $this->business = model('Business');
    }

    public function index()
    {
        return view();
    }

    public function check()
    {
        $data = input();
        $captcha = $data['verifyCode'];
        //校验验证码:
        if (!captcha_check($captcha)){
            //验证失败:
            $this->error('验证码有误');
        }
        else{
            //验证用户名和密码:
            $username = trim($data['username']);
            $res = $this->business->where(['username' => $username])->find();
            if (!$res)
            {
                $this->error('该用户不存在');
            }
            else
            {
                if (md5($data['password']) != $res['password']){
                    $this->error('密码错误');
                }
                else
                {
                    //存储sesion
                    session('user', $res);
                    $this->success('登录成功', 'index/index');
                }
            }
        }
    }

    //退出登录的方法不要写在这里，方式重定向302错误发生

}