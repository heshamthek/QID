<?php
namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        // Fetch all drugs from the database
        $drugs = Drug::simplePaginate(10);

        // Pass drugs to the view
        return view('websitelayout.shop', compact('drugs'));
    }
}
