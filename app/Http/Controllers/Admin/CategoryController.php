<?php
namespace App\Http\Controllers\Admin;

use App\Bls\Admin\Category\CategoryBls;
use Illuminate\Http\Request;
use App\Exceptions\LogicException;
use App\Library\Response\JsonResponse;

class CategoryController extends BaseController
{

    public function index()
    {
        return $this->view('category.index');
    }

    public function create()
    {
        return $this->view('category.create');
    }

    public function store(Request $request)
    {

        if(CategoryBls::createCategory($request)){
            return (new JsonResponse())->success('添加成功');
        }
    }

    public function edit()
    {
        return $this->view('category.edit');
    }

}
