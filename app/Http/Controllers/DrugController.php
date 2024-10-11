<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\DrugCategory;
use App\Models\DrugWarehouse;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the drugs.
     */
    public function index()
    {
        // $drugs = Drug::all();
        $drugs = Drug::paginate(9); 
        return view('dashboard.drug.index', compact('drugs'));
    }

    /**
     * Show the form for creating a new drug.
     */
    public function create()
    {
        $categories = DrugCategory::all(); 
        $warehouses = DrugWarehouse::all(); 
        return view('dashboard.drug.create', compact('categories', 'warehouses'));
    }

    /**
     * Store a newly created drug in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'drug_name' => 'required|string|max:255',
            'drug_description' => 'required|string',
            'drug_price' => 'required|numeric',
            'drug_quantity' => 'required|integer',
            'category_id' => 'required|exists:drug_categories,id',
            'warehouse_id' => 'required|exists:drug_warehouses,id',
        ]);

        Drug::create($request->only([
            'drug_name',
            'drug_description',
            'side_effects',
            'drug_price',
            'drug_quantity',
            'category_id',
            'warehouse_id',
        ]));

        return redirect()->route('dashboard.drug.index')->with('success', 'Drug added successfully.');
    }

    /**
     * Display the specified drug.
     */
    public function show(Drug $drug)
    {
        return view('dashboard.drug.show', compact('drug'));
    }

    /**
     * Show the form for editing the specified drug.
     */
    public function edit(Drug $drug)
    {
        $categories = DrugCategory::all();
        $warehouses = DrugWarehouse::all();
        return view('dashboard.drug.edit', compact('drug', 'categories', 'warehouses'));
    }

    /**
     * Update the specified drug in storage.
     */
    public function update(Request $request, Drug $drug)
    {
        $request->validate([
            'drug_name' => 'required|string|max:255',
            'drug_description' => 'required|string',
            'drug_price' => 'required|numeric',
            'drug_quantity' => 'required|integer',
            'category_id' => 'required|exists:drug_categories,id',
            'warehouse_id' => 'required|exists:drug_warehouses,id',
        ]);

        $drug->update($request->only([
            'drug_name',
            'drug_description',
            'side_effects',
            'drug_price',
            'drug_quantity',
            'category_id',
            'warehouse_id',
        ]));

        return redirect()->route('dashboard.drug.index')->with('success', 'Drug updated successfully.');
    }

    /**
     * Remove the specified drug from storage.
     */
    public function destroy(Drug $drug)
    {
        $drug->delete();
        return redirect()->route('dashboard.drug.index')->with('success', 'Drug deleted successfully.');
    }
}
