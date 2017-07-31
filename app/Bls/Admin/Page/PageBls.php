<?php

namespace App\Bls\Admin\Page;

use App\Bls\Admin\Page\Model\PageModel;
use Illuminate\Http\Request;

class PageBls
{


    public static function pageList(Request $request, $limit = 20)
    {
        $model = PageModel::query();
        return $model->paginate($limit);

    }

    public static function createPage(Request $request)
    {
        $model                  = new PageModel();
        $model->title           = $request->title;
        $model->parent_id       = $request->parent_id;
        $model->template_type   = $request->template_type;
        $model->template_page   = $request->template_page;
        $model->template_info   = $request->template_info;
        $model->status          = $request->status;
        $model->picture         = $request->picture;
        $model->path            = self::PagePath($model->parent_id);

        return $model->save();


    }

    public static function updatePage(PageModel $model, Request $request)
    {
        $model->title           = $request->title;
        $model->parent_id       = $request->parent_id;
        $model->template_type   = $request->template_type;
        $model->template_page   = $request->template_page;
        $model->template_info   = $request->template_info;
        $model->status          = $request->status;
        $model->picture         = $request->picture;
        $model->path            = self::PagePath($model->parent_id);

        return $model->save();
    }

    /**
     * 获取一条数据
     * @param int $id
     * @return PageModel
     */
    public static function getOenPage($id)
    {
        return PageModel::find($id);
    }

    /**
     * 获取所有数据
     */
    public static function getAllPage()
    {
        return PageModel::lists('title','id');
    }

    /**
     * 导航路由
     * @param int $parent_id  父级ID
     * @return string
     */
    private static function PagePath($parent_id)
    {
        if ($parent_id != 0) {
            $model = PageModel::find($parent_id);
            if($model){
                return $model->path.','.$parent_id;
            }
        }
        return $parent_id;
    }
}