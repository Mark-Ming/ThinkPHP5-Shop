<?php
namespace app\index\controller;

//控制器类
use function PHPSTORM_META\type;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $city = model('Region');
        //获取默认城市:
        $defaultCity = $city->getDefaultCity();
        //获取热门城市信息:
        $cities = $city->getHotCities();

        //获取菜单列表信息:
        $category = model('Category');
        $data = $category->getAllCategories();
        //整理数据:
        $menuData = array();
        foreach($data as $item)
        {
            //筛选出一级分类
            if ($item['root_parent_id'] == 0 && $item['parent_id'] == 0){
                $menuData[] = [
                    'id' => $item['id'],
                    'title' => $item['name'],
                    'se_category' => []
                ];
            }
        }

        foreach($data as $item){
            //二级分类
            if ($item['root_parent_id'] == $item['parent_id'] && $item['parent_id'] != 0)
            {
                for($i = 0; $i < count($menuData); $i++)
                {
                    if ($menuData[$i]['id'] == $item['parent_id'])
                    {
                        $menuData[$i]['se_category'][] = [
                            'id' => $item['id'],
                            'se_title' => $item['name'],
                            'third_category' => []
                        ];
                    }
                }
            }
        }

        foreach ($data as $item){
            //三级分类
            if ($item['root_parent_id'] != $item['parent_id'])
            {
                for ($i = 0; $i < count($menuData); $i++)
                {
                    //判断属于这个一级分类
                    if ($item['root_parent_id'] == $menuData[$i]['id'])
                    {
                        for ($j = 0; $j < count($menuData[$i]['se_category']); $j++)
                        {
                            if ($item['parent_id'] == $menuData[$i]['se_category'][$j]['id'])
                            {
                                $menuData[$i]['se_category'][$j]['third_category'][] = [
                                    'id' => $item['id'],
                                    'th_title' => $item['name']
                                ];
                            }
                        }
                    }
                }
            }
        }

        //从session中读取用户名
        $username = session('username');
        return view('', [
            'username' => $username,
            'cities' => $cities,
            'defaultCity' => $defaultCity,
            'data' => $menuData
        ]);
    }
}
