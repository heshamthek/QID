@extends('dashboard.layout.side')

@section('content')
<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 text-white py-4 px-6">
            <h2 class="text-2xl font-bold">Edit Drug Warehouse</h2>
        </div>
        
        <form action="{{ route('dashboard.drug_warehouses.update', $drugWarehouse) }}" method="POST" class="p-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Warehouse Name -->
            <div>
                <label for="warehouse_name" class="block text-sm font-medium text-gray-700 mb-1">Warehouse Name</label>
                <input type="text" id="warehouse_name" name="warehouse_name" value="{{ old('warehouse_name', $drugWarehouse->warehouse_name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                @error('warehouse_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo Upload -->
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo (optional)</label>
                <input type="file" id="logo" name="logo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if ($drugWarehouse->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $drugWarehouse->logo) }}" alt="{{ $drugWarehouse->warehouse_name }}" class="w-16 h-16 object-cover">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300">
                    Update Warehouse
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
