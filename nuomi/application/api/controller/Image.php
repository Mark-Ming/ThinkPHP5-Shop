<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2018/7/9
 * Time: 上午9:51
 */
namespace app\api\controller;

use think\Controller;

class Image extends Controller{
    //接收前端上传来的图片
    public function upload()
    {
        $imgFile = request()->file('file');
        //将文件移动到某个目录下
        $info = $imgFile->move('upload');
        if ($info)
        {
            //上传成功
            return json([
                'status' => 1,
                'url' => '/'.$info->getPathname()
            ]);
        }
        else{
            //上传失败
            return json([
                'status' => 0,
                'msg' => '上传失败'
            ]);
        }
    }
}