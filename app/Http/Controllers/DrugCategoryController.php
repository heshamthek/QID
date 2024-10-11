<?php

namespace App\Http\Controllers;

use App\Models\DrugCategory;
use Illuminate\Http\Request;

class DrugCategoryController extends Controller
{
    public function index()
    {
        $drugCategories = DrugCategory::all();
        return view('dashboard.drug_categories.index', compact('drugCategories'));
    }

    public function create()
    {
        return view('dashboard.drug_categories.create');
    }

    public function store(Request $request)
    {
        // Validate the input using the correct column name
        $request->validate([
            'category_name' => 'required|unique:drug_categories',
        ]);

        // Create a new drug category
        DrugCategory::create($request->all());

        return redirect()->route('dashboard.drug_categories.index');
    }

    public function show(DrugCategory $drugCategory)
    {
        return view('dashboard.drug_categories.show', compact('drugCategory'));
    }

    public function edit(DrugCategory $drugCategory)
    {
        return view('dashboard.drug_categories.edit', compact('drugCategory'));
    }

    public function update(Request $request, DrugCategory $drugCategory)
    {
        // Validate the input using the correct column name
        $request->validate([
            'category_name' => 'required|unique:drug_categories,category_name,' . $drugCategory->id,
        ]);

        // Update the drug category
        $drugCategory->update($request->all());

        return redirect()->route('dashboard.drug_categories.index');
    }

    public function destroy(DrugCategory $drugCategory)
    {
        // Soft delete the drug category
        $drugCategory->delete();
        return redirect()->route('dashboard.drug_categories.index');
    }
}
