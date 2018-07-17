<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status){
    if ($status == 1)
    {
        return "<span class=\"label label-success radius\">已启用</span>";
    }
    else if($status == 0){
        return "<span class=\"label label-danger radius\">已删除</span>";
    }
    else if($status == -1){
        return "<span class=\"label label-warning radius\">已禁用</span>";
    }
}

//根据性别字符获取性别汉字
function getGender($gender){
    if ($gender == 'F')
    {
        return '女';
    }
    else
    {
        return '男';
    }
}

//根据address的内容（100， 101）获取城市信息
function getAddress($idString){
    //将字符串根据逗号拆分成数组
    $arr = explode(',', $idString);
    $str = '';
    for ($i = 0; $i < count($arr); $i++)
    {
        $str .= model('Region')->getRegionNameByID($arr[$i]);
    }
    return $str.'市';
}

//curl方法
function doCurl($url, $type= 0, $data = []){
    //初始curl会话
    $ch = curl_init();
    //设置参数
    curl_setopt($ch, CURLOPT_URL, $url); //设置要请求的url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//请求的结果以文本流形式返回
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置是否返回头部信息
    if ($type == 1)
    {
        //post请求
        curl_setopt($ch, CURLOPT_POST, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置post请求体
    }
    //执行请求
    $result = curl_exec($ch);
    //关闭请求
    curl_close($ch);

    return $result;
}

//根据分类字符串获取分类名称
function getNameByCategoryID($category_ids){
    $array = explode(',', $category_ids);
    $temp = [];
    $model = model('Category');
    foreach ($array as $value)
    {
        $temp[] = $model->getNameByCategoryID($value);
    }
    return implode(',', $temp);
}

//根据店铺id获取店铺名称
function getNameByShopID($shop_id)
{
    $model = model('Shop');
    return $model->where(['id' => $shop_id])->value('name');
}