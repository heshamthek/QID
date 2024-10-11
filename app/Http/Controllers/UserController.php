<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DrugWarehouse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(6);
        return view('dashboard.user.index', compact('users'));
    }

    // Display the create user form with warehouses
    public function create()
    {
        $warehouses = DrugWarehouse::all(); // Get all warehouses
        return view('dashboard.user.create', compact('warehouses'));
    }

    // Store a newly created user and assign to a warehouse
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'warehouse_id' => 'required|exists:drug_warehouses,id', // Validation for warehouse
    ]);

    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'status' => 'pending',
    ]);

    // Attach the user to the selected warehouse
    $user->warehouses()->attach($request->warehouse_id); // Ensure many-to-many relationship is set up

    return redirect()->route('dashboard.user.view')->with('success', 'User created successfully!');
}


    public function edit(User $user)
    {
        $warehouses = DrugWarehouse::all();
        return view('dashboard.user.edit', compact('user', 'warehouses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'warehouse_id' => 'required|exists:drug_warehouses,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        // Update warehouse assignment
        $user->warehouses()->sync([$request->warehouse_id]);

        return redirect()->route('dashboard.user.view')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.user.view')->with('success', 'User deleted successfully!');
    }
}
