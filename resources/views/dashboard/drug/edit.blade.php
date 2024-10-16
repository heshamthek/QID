@extends('dashboard.layout.side')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-lg bg-white rounded-lg shadow-lg p-10 m-5">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Edit Drug Info</h2>
        
        <form action="{{ route('dashboard.drug.update', $drug->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Drug Name -->
            <div class="relative">
                <label for="drug_name" class="block text-gray-600 text-sm font-medium">Drug Name</label>
                <input type="text" id="drug_name" name="drug_name" value="{{ old('drug_name', $drug->drug_name) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('drug_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Drug Description -->
            <div class="relative">
                <label for="drug_description" class="block text-gray-600 text-sm font-medium">Drug Description</label>
                <textarea id="drug_description" name="drug_description" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" rows="4">{{ old('drug_description', $drug->drug_description) }}</textarea>
                @error('drug_description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Side Effects -->
            <div class="relative">
                <label for="side_effects" class="block text-gray-600 text-sm font-medium">Side Effects</label>
                <textarea id="side_effects" name="side_effects" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" rows="4">{{ old('side_effects', $drug->side_effects) }}</textarea>
                @error('side_effects')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Drug Price -->
            <div class="relative">
                <label for="drug_price" class="block text-gray-600 text-sm font-medium">Drug Price</label>
                <input type="number" id="drug_price" name="drug_price" step="0.01" value="{{ old('drug_price', $drug->drug_price) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('drug_price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Drug Quantity -->
            <div class="relative">
                <label for="drug_quantity" class="block text-gray-600 text-sm font-medium">Drug Quantity</label>
                <input type="number" id="drug_quantity" name="drug_quantity" value="{{ old('drug_quantity', $drug->drug_quantity) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('drug_quantity')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category Selection -->
            <div class="relative">
                <label for="category_id" class="block text-gray-600 text-sm font-medium">Select Category</label>
                <select id="category_id" name="category_id" class="p-2 mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $drug->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                    
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Warehouse Selection -->
            <div class="relative">
                <label for="warehouse_id" class="block text-gray-600 text-sm font-medium">Select Warehouse</label>
                <select id="warehouse_id" name="warehouse_id" class="p-2 mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                    @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $drug->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                            {{ $warehouse->warehouse_name }}
                        </option>
                    @endforeach
                </select>
                @error('warehouse_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-3 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Drug Info
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

