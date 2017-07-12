<?php
namespace App\Http\Controllers\Admin;

use Menu;
use Auth;

class PublicController extends BaseController
{

    public function index()
    {
        return $this->view('index');
    }

    public function main()
    {
        return $this->view('main');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.index');

    }
}
