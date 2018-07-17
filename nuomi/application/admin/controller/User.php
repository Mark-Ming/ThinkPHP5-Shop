<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/2
 * Time: 下午5:13
 */
namespace app\admin\controller;

use app\common\controller\Base;
use think\App;

class User extends Base {

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('User');
    }

    public function index()
    {
        $count = \app\common\model\User::count();
        $data = $this->model_obj->getAllUsers();
        return view('', [
            'data' => $data,
            'count' => $count
        ]);
    }
}