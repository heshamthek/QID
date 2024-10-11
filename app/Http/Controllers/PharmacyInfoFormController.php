<?php

namespace App\Http\Controllers;

use App\Models\PharmacyInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PharmacyInfoFormController extends Controller
{
    // Show the form to create pharmacy information
    public function create()
    {
        $users = User::all(); // Retrieve all users for the dropdown
        return view('pharmacy.create', compact('users')); // Return the view with users
    }

    // Store the pharmacy information
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'owner_name' => 'required',
            'location' => 'required',
            'pharmacy_name' => 'required',
            'phone_number' => 'required|string|min:6|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'license_image' => 'required|image|mimes:jpg,png,jpeg|max:10048', // Validate the license image
        ]);

        $data = $request->all(); // Get all request data

        
        if ($request->hasFile('license_image')) {
            $file = $request->file('license_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('licenses', $filename, 'public'); // Store in 'licenses' folder
            $data['license_image'] = $path; // Save the path to the data array
        }


        PharmacyInfo::create($data); // Create a new PharmacyInfo record

        return redirect()->route('auth.login'); // Redirect to the pharmacy index after storing
    }
}
