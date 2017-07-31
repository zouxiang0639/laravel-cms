<?php
namespace App\Http\Controllers\Admin\Category;

use App\Bls\Admin\Category\CategoryBls;
use App\Bls\Admin\Page\PageBls;
use App\Consts\Admin\Category\CategoryGroupConst;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Category\Validator\CategoryFormValidator;
use App\Library\Response\JsonResponse;
use Input;
use App\Http\Controllers\Admin\Category\Traits\CategoryTrait;

class CategoryController extends BaseController
{

    use CategoryTrait;

    public function __construct(Request $request)
    {
        if(empty($request->group)) {
            $request->merge(['group' => CategoryGroupConst::HEADER]);
        }
    }

    public function index(Request $request)
    {
        $model = CategoryBls::getAllCategory(function($query) use ($request) {
            $query->where('group', $request->group);
        });
        $this->formatCategory($model);

        return $this->view('category.index',[
            'list' => $model
        ]);
    }

    public function create()
    {

        return $this->view('category.create', [
            'page'      => PageBls::getAllPage(),
            'category'  => CategoryBls::getTreeCategory(Input::get('group'))
        ]);
    }

    public function store(CategoryFormValidator $request)
    {
        if(CategoryBls::createCategory($request)){
            return (new JsonResponse())->success('添加成功');
        }
    }

    public function edit($id)
    {
        $model = CategoryBls::getOneCategory($id);
        return $this->view('category.edit', [
            'page'      => PageBls::getAllPage(),
            'category'  => CategoryBls::getTreeCategory(Input::get('group')),
            'info'      => $model
        ]);
    }

    public function update(CategoryFormValidator $request, $id)
    {
        $model = CategoryBls::getOneCategory($id);
        if(categoryBls::updateCategory($request, $model)) {
            return (new JsonResponse())->success('修改成功');
        }
    }

    public function sort(Request $request)
    {
        if(CategoryBls::categorySort($request->date)){
            return (new JsonResponse())->success('排序成功');
        }
    }

    public function destroy()
    {

    }
}
