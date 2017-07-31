<?php
namespace App\Consts\Admin\Page;

/**
 * 模版类型
 */
class PageTemplateConst
{
    const PAGE  = [1, '单页模版'];
    const INFO  = [2, '信息模版'];

    const ABOUT = [11, '关于我们', 'about'];
    const NEWS  = [12, '新闻', 'news'];
    const NEWS_INFO  = [13, '新闻内页', 'news_info'];

    public static function desc()
    {
        return [
            self::PAGE[0]       => self::PAGE[1],
            self::INFO[0]       => self::INFO[1],
            self::ABOUT[0]      => self::ABOUT[1],
            self::NEWS[0]       => self::NEWS[1],
            self::NEWS_INFO[0]  => self::NEWS_INFO[1],
        ];
    }

    public static function getJson()
    {
        $array = [
            ['name'=>static::PAGE[1], 'value'=>static::PAGE[0], 'city'=>[ //单页模型
                ['name'=>static::ABOUT[1],'value'=>static::ABOUT[0]]
            ]],
            ['name'=>static::INFO[1], 'value'=>static::INFO[0], 'city'=>[ //信息模型
                ['name'=>static::NEWS[1],'value'=>static::NEWS[0], 'area'=>[
                    ['name'=>static::NEWS_INFO[1], 'value'=>static::NEWS_INFO[0]]
                ]]
            ]]
        ];

        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    public static function getDesc($item)
    {
        return array_get(self::desc(), $item, '');
    }
}