<?php
namespace App\Http\Controllers\Admin\Page;

use App\Bls\Admin\Page\PageBls;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\Page\Traits\PageTrait;
use App\Http\Controllers\Admin\Page\Validator\PageFormValidator;
use Illuminate\Http\Request;
use App\Library\Response\JsonResponse;

class PageController extends BaseController
{
    use PageTrait;

    public function index(Request $request)
    {
        $model = PageBls::pageList($request,1);
        $this->formatPage($model->getCollection());

        return $this->view('page.index',[
            'list' => $model
        ]);
    }

    public function create()
    {
        return $this->view('page.create');
    }

    public function store(PageFormValidator $request)
    {

        if (PageBls::createPage($request)) {
            return (new JsonResponse())->success('添加成功');
        } else {
            return (new JsonResponse())->error(1010001, '添加成功');
        }
    }

    public function edit($id)
    {
        $info = PageBls::getOenPage($id);

        return $this->view('page.edit',[
            'info' => $info
        ]);
    }

    public function update(PageFormValidator $request, $id)
    {
        $model = PageBls::getOenPage($id);
        if (PageBls::updatePage($model, $request)) {
            return (new JsonResponse())->success('更新成功');
        } else {
            return (new JsonResponse())->error(1010001, '更新失败');
        }
    }

    public function destroy(Request $request)
    {

        $model = PageBls::getOenPage($request->id);

        if (!$model) {
            return (new JsonResponse())->error(1010001);
        }

        if($model->delete()){
            return (new JsonResponse())->success('删除成功');
        } else {
            return (new JsonResponse())->error(1010001, '删除失败');
        }
    }

}
