<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/4
 * Time: 下午4:50
 */
namespace app\admin\controller;

use app\common\controller\Base;
use think\App;

class Business extends Base{

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Business');
    }

    public function index()
    {
        //查询出所有的商户信息
        $data = $this->model_obj->getAllBusiness();
        return view('', [
            'data' => $data
        ]);
    }

}