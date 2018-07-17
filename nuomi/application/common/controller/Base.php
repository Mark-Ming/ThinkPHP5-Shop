<?php
namespace app\common\controller;

use think\App;
use think\Controller;

class Base extends Controller
{
    public $model_obj;
    public $userInfo;

    //构造函数
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        //登录验证
        $this->checkLogin();
    }

    public function checkLogin()
    {
        $login_user = $this->getUserInfo();
        if (!$login_user)
        {
            //跳转到登录页
            $this->redirect('login/index');
        }
    }

    //获取用户信息
    public function getUserInfo()
    {
        if (!$this->userInfo)
        {
            $this->userInfo = session('user');
        }
        return $this->userInfo;
    }
    

    //修改状态的方法（删除或停用）
    public function status()
    {
        //获取前端传递过来的id和status值
        $data = input();
        //执行更新
        $res = $this->model_obj->save(['status' => $data['status']], ['id' => $data['id']]);
        if ($res)
        {
            return json([
                'status' => 1,
                'msg' => '状态修改成功'
            ]);
        }
        else{
            return json([
                'status' => 0,
                'msg' => '状态修改失败'
            ]);
        }
    }
}
