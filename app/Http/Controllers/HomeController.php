<?php

namespace App\Http\Controllers;

use App\Traits\AllowedAction;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    use AllowedAction;

    public function __construct()
    {
        $this->setPrefixPermisionName('home')->addPermission('view', 'index')->registerPermission();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with(['page_title' => 'Home']);
    }
}
