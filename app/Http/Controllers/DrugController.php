<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\DrugCategory;
use App\Models\DrugWarehouse;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    protected $fillableFields = [
        'drug_name',
        'drug_description',
        'side_effects',
        'drug_price',
        'drug_quantity',
        'category_id',
        'warehouse_id',
        'image_path',
    ];

    /**
     * Display a listing of the drugs.
     */
    public function index()
    {
        $drugs = Drug::paginate(9);
        return view('dashboard.drug.index', compact('drugs'));
    }

    /**
     * Show the form for creating a new drug.
     */
    public function create()
    {
        $categories = DrugCategory::all();
        $warehouses = auth()->user()->warehouses()->get();
        return view('dashboard.drug.create', compact('categories', 'warehouses'));
    }

    /**
     * Store a newly created drug in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate($this->validationRules());

    // Check if the authenticated user is allowed to add drugs to this warehouse
    if (!$this->isUserAllowedToEditWarehouse($request->warehouse_id)) {
        return redirect()->back()->withErrors(['error' => 'You are not allowed to add drugs to this warehouse.']);
    }

    // Initialize imagePath to null
    $imagePath = null;

    // Check if the request contains a file for the image
    if ($request->hasFile('image')) {
        // Store the uploaded image in the 'public/drugs' directory and get the path
        $imagePath = $request->file('image')->store('drugs', 'public'); 
    }

    // Create a new drug entry in the database, including the image path
    Drug::create(array_merge($request->only($this->fillableFields), [
        'image_path' => $imagePath, // Store the relative image path
    ]));

    // Redirect back to the drug index with a success message
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
        $warehouses = auth()->user()->warehouses()->get();
        return view('dashboard.drug.edit', compact('drug', 'categories', 'warehouses'));
    }

    /**
     * Update the specified drug in storage.
     */
    public function update(Request $request, Drug $drug)
    {
        $request->validate($this->validationRules());

        // Check if the authenticated user is allowed to update this drug in the specified warehouse
        if (!$this->isUserAllowedToEditWarehouse($request->warehouse_id)) {
            return redirect()->back()->withErrors(['error' => 'You are not allowed to update drugs in this warehouse.']);
        }

        // Handle the image upload
        $imagePath = $drug->image_path; // Keep the existing image path
        if ($request->hasFile('image')) {
            // If a new image is uploaded, store it and update the path
            $imagePath = $request->file('image')->store('images/drugs', 'public');
        }

        $drug->update(array_merge($request->only($this->fillableFields), [
            'image_path' => $imagePath, // Update the image path
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

    /**
     * Validation rules for drug.
     */
    protected function validationRules()
    {
        return [
            'drug_name' => 'required|string|max:255',
            'drug_description' => 'required|string',
            'side_effects' => 'required|string',
            'drug_price' => 'required|numeric',
            'drug_quantity' => 'required|integer',
            'category_id' => 'required|exists:drug_categories,id',
            'warehouse_id' => 'required|exists:drug_warehouses,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }

    /**
     * Check if the user is allowed to edit the warehouse.
     */
    protected function isUserAllowedToEditWarehouse($warehouseId)
    {
        $user = auth()->user();
        return $user->warehouses()->where('drug_warehouses.id', $warehouseId)->exists();
    }
}
