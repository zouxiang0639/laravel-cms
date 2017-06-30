<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use View;

abstract class BaseController extends Controller
{
    /**
     * Show view.
     *
     * @param $view
     * @param array $data
     * @param array $mergeData
     *
     * @return mixed
     */
    public function view($view, $data = array(), $mergeData = array())
    {
        $prefix = config('admin.prefix');
        return View::make($prefix.'.'.$view, $data, $mergeData);
    }

}
