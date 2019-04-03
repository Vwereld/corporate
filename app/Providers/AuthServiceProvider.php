<?php

namespace Corp\Providers;

use Corp\Article;
use Corp\Menu;
use Corp\Permission;
use Corp\Policies\ArticlePolicy;
use Corp\Policies\MenusPolicy;
use Corp\Policies\PermissionPolicy;
use Corp\Policies\UserPolicy;
use Corp\User;
use \Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenusPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('VIEW_ADMIN', function($user){
            return $user->canDo(['VIEW_ADMIN','ADD_ARTICLES'], TRUE);
        });
        $gate->define('VIEW_ADMIN_ARTICLES', function($user){
            return $user->canDo(['VIEW_ADMIN_ARTICLES','ADD_ARTICLES'], TRUE);
        });
        $gate->define('EDIT_USERS', function($user){
            return $user->canDo(['EDIT_USERS'], TRUE);
        });
        $gate->define('VIEW_ADMIN_MENU', function($user){
            return $user->canDo(['VIEW_ADMIN_MENU'], TRUE);
        });
//        $gate->define('EDIT_MENU', function($user){
//            return $user->canDo(['EDIT_MENU'], TRUE);
//        });
    }
}
