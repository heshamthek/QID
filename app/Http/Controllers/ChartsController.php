<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Drug;
use App\Models\DrugWarehouse;
use App\Models\DrugCategory;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function index()
    {
        // Count the total number of users, drugs, warehouses, and drug categories
        $userCount = User::count();
        $drugCount = Drug::count();
        $warehouseCount = DrugWarehouse::count();
        $drugCategoryCount = DrugCategory::count();

        return view('dashboard.charts.index', compact('userCount', 'drugCount', 'warehouseCount', 'drugCategoryCount'));
    }
}
