<?php
namespace App\Bls\Admin;

use Menu;
use Request;
use Exception;

class MenuBls
{

    public function categoryMenu($parameters)
    {
        $array = [
            'admin.category.list'      => ['name' => '我的账户'],
            'admin.category.create'     => ['name' => '创建导航'],
            'admin.category.edit'       => ['name' => '编辑导航', 'parameters' => $parameters, 'attributes' =>['style'=>'display: none;']]
        ];
        self::tabMenu($array);
        return Menu::get('tab_menu');
    }

    private function tabMenu($array){

        Menu::create('tab_menu', function ($menu) use ($array){
            try {
                $menu->setPresenter(config('menus.styles.tabMenu'));

                $menu->dropdown('账户管理', function ($sub) use ($array) {

                    $routeName = Request::route()->getName();
                    foreach ($array as $key => $value) {
                        $attributes = $routeName == $key ? ['class' => 'layui-this'] : array_get($value, 'attributes', []);
                        $sub->route($key, $value['name'], array_get($value, 'parameters', []), 1, $attributes);
                    }

                }, '', ['icon' => 'fa fa-users']);
            } catch (NoMenuException $e) {
            }
        });
    }
}

class NoMenuException extends Exception
{}