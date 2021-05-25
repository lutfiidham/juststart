<?php

use App\Http\Controllers\AccessManagement\DeletedUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuSearchController;
use App\Http\Controllers\AccessManagement\MenuController;
use App\Http\Controllers\AccessManagement\RoleController;
use App\Http\Controllers\AccessManagement\UserController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false, 'verify' => true,]);

Route::group(['middleware' => ['auth']], function () {

    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('profile', [AccountController::class, 'profile'])->name('profile');
        Route::get('change-password', [AccountController::class, 'changePassword'])->name('change_password');

        Route::post('update-profile', [AccountController::class, 'updateProfile'])->name('update_profile');
        Route::post('update-password', [AccountController::class, 'updatePassword'])->name('update_password');
    });

    Route::group(['prefix' => 'access-management', 'as' => 'access_management.'], function () {

        Route::group(['prefix' => 'menus', 'as' => 'menus.'], function () {
            Route::get('hierarki', [MenuController::class, 'hierarki']);
        });

        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('datatable', [RoleController::class, 'datatable'])->name('datatable');
            Route::post('destroy-multiple', [RoleController::class, 'destroyMultiple'])->name('destroy_multiple');
        });
        Route::resource('roles', RoleController::class);

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('datatable', [UserController::class, 'datatable'])->name('datatable');

            Route::post('destroy-multiple', [UserController::class, 'destroyMultiple'])->name('destroy_multiple');

            Route::post('deactivate-multiple', [UserController::class, 'deactivateMultiple'])->name('deactivate_multiple');
            Route::post('reactivate-multiple', [UserController::class, 'reactivateMultiple'])->name('reactivate_multiple');

            Route::get('{user}/change-password', [UserController::class, 'changePassword'])->name('change_password');
            Route::post('{user}/update-password', [UserController::class, 'updatePassword'])->name('update_password');

            Route::group(['prefix' => 'deleted', 'as' => 'deleted.'], function () {
                Route::get('/', [DeletedUserController::class, 'index'])->name('index');
                Route::get('datatable', [DeletedUserController::class, 'datatable'])->name('datatable');
                // Route::delete('destroy/{user}', [DeletedUserController::class, 'destroy'])->name('destroy');
                // Route::put('restore/{user}', [DeletedUserController::class, 'restore'])->name('restore');
                Route::post('destroy-multiple', [DeletedUserController::class, 'destroyMultiple'])->name('destroy_multiple');
                Route::post('restore-multiple', [DeletedUserController::class, 'restoreMultiple'])->name('restore_multiple');
            });
        });
        Route::resource('users', UserController::class);
    });

    // Quick search dummy route to display html elements in search dropdown (header search)
    Route::get('search-menu', MenuSearchController::class)->name('search_menu');
});
