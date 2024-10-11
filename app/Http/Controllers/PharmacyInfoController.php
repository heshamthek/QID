<?php

namespace App\Http\Controllers;

use App\Models\PharmacyInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class PharmacyInfoController extends Controller
{
    public function index()
    {
        $pharmacyInfos = PharmacyInfo::all();
        return view('dashboard.pharmacyinfo.index', compact('pharmacyInfos')); 
    }

    public function create()
    {
        $users = User::all();
        return view('dashboard.pharmacyinfo.create', compact('users')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'owner_name' => 'required', 
            'location' => 'required',
            'pharmacy_name' => 'required', 
            'phone_number' => 'required|string|min:6|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'license_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validate the license image
        ]);

        $data = $request->all(); // Get all request data

        // Handle the file upload
        if ($request->hasFile('license_image')) {
            $file = $request->file('license_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('licenses', $filename, 'public'); // Store the file in 'licenses' folder
            $data['license_image'] = $filename; // Add the filename to the data array
        }

        PharmacyInfo::create($data); // Create a new PharmacyInfo record

        return redirect()->route('dashboard.pharmacy.index'); 
    }

    public function show(PharmacyInfo $pharmacyInfo)
    {
        return view('dashboard.pharmacyinfo.show', compact('pharmacyInfo')); 
    }

    public function edit(PharmacyInfo $pharmacyInfo)
    {
        $users = User::all();
        return view('dashboard.pharmacyinfo.edit', compact('pharmacyInfo', 'users'));
    }

    public function update(Request $request, PharmacyInfo $pharmacyInfo)
    {
        $request->validate([
            'user_id' => 'required',
            'owner_name' => 'required', 
            'location' => 'required',
            'pharmacy_name' => 'required', 
            'phone_number' => 'required|string|min:6|max:15|regex:/^([0-9\s\-\+\(\)]*)$/', 
            'license_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validate the license image
        ]);

        $data = $request->all(); // Get all request data

        // Handle the file upload if a new file is provided
        if ($request->hasFile('license_image')) {
            // Delete the old image if it exists (optional)
            if ($pharmacyInfo->license_image) {
                Storage::disk('public')->delete('licenses/' . $pharmacyInfo->license_image); // Updated line
            }

            $file = $request->file('license_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('licenses', $filename, 'public'); // Store the file
            $data['license_image'] = $filename; // Add the filename to the data array
        }

        $pharmacyInfo->update($data); // Update the PharmacyInfo record

        return redirect()->route('dashboard.pharmacy.index'); 
    }

    public function destroy(PharmacyInfo $pharmacyInfo)
    {
        if ($pharmacyInfo->license_image) {
            Storage::disk('public')->delete('licenses/' . $pharmacyInfo->license_image); // Updated line
        }

        $pharmacyInfo->delete(); 
        return redirect()->route('dashboard.pharmacy.index'); 
    }
}
