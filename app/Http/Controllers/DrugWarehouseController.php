<?php

namespace App\Http\Controllers;

use App\Models\DrugWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DrugWarehouseController extends Controller
{
    public function index()
    {
        $warehouses = DrugWarehouse::all();
        return view('dashboard.drug_warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('dashboard.drug_warehouses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $warehouse = new DrugWarehouse();
        $warehouse->warehouse_name = $request->warehouse_name;

        if ($request->hasFile('logo')) {
            $warehouse->logo = $request->file('logo')->store('logos', 'public');
        }

        $warehouse->save();
        return redirect()->route('dashboard.drug_warehouses.index')->with('success', 'Drug Warehouse created successfully.');
    }

    public function edit(DrugWarehouse $drugWarehouse)
    {
        return view('dashboard.drug_warehouses.edit', compact('drugWarehouse'));
    }

    public function update(Request $request, DrugWarehouse $drugWarehouse)
    {
        $request->validate([
            'warehouse_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $drugWarehouse->warehouse_name = $request->warehouse_name;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($drugWarehouse->logo) {
                Storage::disk('public')->delete($drugWarehouse->logo);
            }
            $drugWarehouse->logo = $request->file('logo')->store('logos', 'public');
        }

        $drugWarehouse->save();
        return redirect()->route('dashboard.drug_warehouses.index')->with('success', 'Drug Warehouse updated successfully.');
    }

    public function destroy(DrugWarehouse $drugWarehouse)
    {
        // Delete logo file if exists
        if ($drugWarehouse->logo) {
            Storage::disk('public')->delete($drugWarehouse->logo);
        }

        $drugWarehouse->delete();
        return redirect()->route('dashboard.drug_warehouses.index')->with('success', 'Drug Warehouse deleted successfully.');
    }
}
