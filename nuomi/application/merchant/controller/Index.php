<?php
namespace app\merchant\controller;

use app\common\controller\Base;

class Index extends Base
{
    public function index()
    {
        $this->userInfo = session('user');
        $this->assign('userInfo', $this->userInfo);
        //商家登录后显示的首页
        return view();
    }

    public function welcome()
    {
        //测试地图接口
        return view();
    }


    public function logout()
    {
        session('user', null);
        $this->redirect('login/index');
    }
}


