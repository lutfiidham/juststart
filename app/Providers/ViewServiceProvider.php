<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(UserService $userService)
    {
        View::composer('layout.default', function ($view) use ($userService) {
            $user = auth()->user();
            $view->with('logged_in_user', $user);
            $view->with('logged_in_user_menus', $userService->getUserMenu($user));
        });
        require base_path('routes/breadcrumbs.php');
    }
}
