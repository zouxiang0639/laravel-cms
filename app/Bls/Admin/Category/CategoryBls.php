<?php

namespace App\Bls\Admin\Category;

use App\Bls\Admin\Category\Model\CategoryModel;
use Illuminate\Http\Request;

class CategoryBls
{


    public static function getCategory()
    {

    }

    public static function createCategory(Request $request)
    {
        $model                  = new CategoryModel();
        $model->title           = $request->title;
        $model->parent_id       = $request->parent_id;
        $model->template_type   = $request->template_type;
        $model->template_page   = $request->template_page;
        $model->template_info   = $request->template_info;
        $model->status          = $request->status;
        $model->picture         = $request->picture;
        $model->path            = self::CategoryPath($model->parent_id);

        return $model->save();


    }


    /**
     * 导航路由
     *
     */
    private static function CategoryPath($parent_id)
    {
        if ($parent_id != 0) {
            $model = CategoryModel::find($parent_id);
            if($model){
                return $model->path.','.$parent_id;
            }
        }
        return $parent_id;
    }
}