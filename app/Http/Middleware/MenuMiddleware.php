<?php
namespace App\Http\Middleware;

use Closure;
use Event;
use Exception;
use Menu;


class MenuMiddleware
{

    /** @var int  */
    protected $menuItems=0;

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Event::listen('router.matched', function ($route, $request){

            Menu::destroy('admin-menu');

            Menu::create('admin-menu', function ($menu) use ($route, $request) {

                $user = $request->user();

                if (is_null($user)) {
                    return;
                }

                $menu->enableOrdering();
                $menu->setPresenter(config('menus.styles.sidebarMenu'));
                $order = 1;
                $this->addMenuAccount($menu, $user, $order++);
                $this->addMenuTypographer($menu, $user, $order++);
            });
        });

        return $next($request);
    }

    protected function beginBuild()
    {
        $this->menuItems = 0;
    }

    protected function endBuild()
    {
        if ( $this->menuItems == 0 ) {
            throw new NoMenuException();
        }
    }
    protected function can($user, $permission)
    {

            $this->menuItems++;
            return true;

    }

    /**
     * 探测用户权限
     * @param $user
     * @param $permissions
     * @return bool
     */
    protected function detectPermissions($user, $permissions) {
        foreach ($permissions as $permission) {
            if ($user->is(RoleSlugConst::ROLE_SUPER) || $user->can($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $menu
     * @param $user
     * @param $order
     */
    public function addMenuAccount($menu, $user, $order)
    {
        try{
            $menu->dropdown('账户管理', function ($sub) use ($user) {

                $this->beginBuild();
                    $this->can($user, 'salesapply_sales_list') && $sub->route('admin.main', '我的账户', ['uid' => $user->id], 1);
                    $this->can($user, 'salesapply_sales_at') && $sub->route('admin.index', '收益', ['uid' => $user->id], 1);

                $this->endBuild();
            }, $order, ['icon' => 'fa fa-users']);
        }catch(NoMenuException $e){
        }
    }

    /**
     * 印刷商管理
     * @param $menu
     * @param $user
     * @param $order
     */
    public function addMenuTypographer($menu, $user, $order)
    {
        try{
            $menu->dropdown('印刷商管理', function ($sub) use ($user) {

                $this->beginBuild();
                $this->can($user, 'salesapply_sales_list') && $sub->route('admin.index', '印刷商列表', [], 1);

                $this->endBuild();

            }, $order, ['icon' => 'fa fa-users']);

        }catch(NoMenuException $e){
        }
    }

}

class NoMenuException extends Exception
{}