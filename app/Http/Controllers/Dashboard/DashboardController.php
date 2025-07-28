<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalCategories = Category::count();
        $lowStockItems = Item::where('quantity', '<', 10)->count();

        return view('index', compact('totalItems', 'totalCategories', 'lowStockItems'));
    }
}
