<?php

namespace App\Http\Controllers\AccessManagement;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuService;


    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function hierarki()
    {
        $data = $this->menuService->getStructuredMenu();
        return response()->json(compact('data'), 200);
    }
}
