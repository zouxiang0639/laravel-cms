<?php

namespace App\Bls\Admin\Category;

use App\Bls\Admin\Category\Model\CategoryModel;
use App\Http\Controllers\Admin\Category\Validator\CategoryFormValidator;
use App\Library\Trees\Tree;
use Illuminate\Http\Request;

class CategoryBls
{


    public static function createCategory(CategoryFormValidator $request)
    {
        $model                  = new CategoryModel();
        $model->group           = $request->group;
        $model->title           = $request->title;
        $model->status          = $request->status;
        $model->parent_id       = $request->parent_id;
        $model->bind_page       = $request->bind_page;
        $model->page_id         = $request->page_id;
        $model->links           = $request->links;

        return $model->save();
    }

    public static function updateCategory(CategoryFormValidator $request, CategoryModel $model)
    {
        $model->title           = $request->title;
        $model->status          = $request->status;
        $model->parent_id       = $request->parent_id;
        $model->bind_page       = $request->bind_page;
        $model->page_id         = $request->page_id;
        $model->links           = $request->links;
        return $model->save();
    }

    public static function getAllCategory($where = '')
    {

        $model = CategoryModel::orderBy('sort', 'asc');

        if($where) {
            $model = $model->where($where);
        }

        return  $model->get();
    }

    public static function getOneCategory($id)
    {
        return CategoryModel::find($id);
    }

    public static function getTreeCategory($group)
    {
        $model = self::getAllCategory(function($query) use ($group) {
            $query->where('group', $group);
        });
        return  (new Tree('parent_id'))->create($model, function($object){
            $array = array();
            $items = $object->toLinearArray()->getItems();
            foreach ($items as $value) {
                $array[$value->id] = $value->icon.$value->title;
            }
            return $array;
        });
    }


    public static function categorySort($date, $parent_id = 0)
    {
        static $num = 0;

        foreach ($date as $value) {
            $num ++;
            CategoryModel::where('id', $value['id'])->update(['sort'=> $num,'parent_id' => $parent_id]);
            if(isset($value['children'])) {
                self::categorySort($value['children'], $value['id']);
            }
        }

        return true;
    }
}