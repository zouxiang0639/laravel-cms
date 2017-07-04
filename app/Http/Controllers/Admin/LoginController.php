<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use Validator;

class LoginController extends BaseController
{

    public function index()
    {
        return $this->view('login');
    }

    /**
     * 登录方法
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            //'captcha' => 'required|captcha',
        ], [
            'email.required' => '邮箱必填',
            'password.required' => '密码必填',
            'captcha.required' => '验证码必填',
            'captcha.captcha' => '验证码不正确！',
        ]);

        if ($validator->fails()) {
            return $this->backWithFailed($validator->errors()->first());
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        $user = Auth::getProvider()->retrieveByCredentials($credentials);


        //用户不存在
        if (empty($user)) {
            return $this->backWithFailed('登入失败!');
        }

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->route('admin.index')->withFlashMessage('登入成功!');
        }

       /* $user->last_login_ip = \input::ip();
        $user->last_login_time = date('Y-m-d H:i:s');
        $user->save();*/



    }

    private function backWithFailed($msg = '')
    {
        return \Redirect::to('admin/login')->withFlashMessage($msg ? $msg : '登录失败!')
            ->withFlashType('danger')
            ->withInput();
    }

}
