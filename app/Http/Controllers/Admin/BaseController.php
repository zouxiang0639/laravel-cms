<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use View;

abstract class BaseController extends Controller
{
    public function __construct()
    {

    }

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
        $config = config('admin.views');
        $data = array_merge($config, $data);

        return View::make($config['prefix'].'.'.$view, $data, $mergeData);
    }

}
