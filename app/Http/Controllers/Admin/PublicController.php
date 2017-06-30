<?php
namespace App\Http\Controllers\Admin;

class PublicController extends BaseController
{

    public function index()
    {
        return $this->view('index');
    }

}
