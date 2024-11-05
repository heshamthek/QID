@extends('dashboard.layout.side')

@section('content')
<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 text-white py-4 px-6">
            <h2 class="text-2xl font-bold">Edit Drug Info</h2>
        </div>
        
        <form action="{{ route('dashboard.drug.update', $drug->id) }}" method="POST" class="p-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Drug Name -->
                <div>
                    <label for="drug_name" class="block text-sm font-medium text-gray-700 mb-1">Drug Name</label>
                    <input type="text" id="drug_name" name="drug_name" value="{{ old('drug_name', $drug->drug_name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    @error('drug_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Drug Price -->
                <div>
                    <label for="drug_price" class="block text-sm font-medium text-gray-700 mb-1">Drug Price</label>
                    <input type="number" id="drug_price" name="drug_price" step="0.01" value="{{ old('drug_price', $drug->drug_price) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    @error('drug_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Drug Quantity -->
                <div>
                    <label for="drug_quantity" class="block text-sm font-medium text-gray-700 mb-1">Drug Quantity</label>
                    <input type="number" id="drug_quantity" name="drug_quantity" value="{{ old('drug_quantity', $drug->drug_quantity) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    @error('drug_quantity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Selection -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Select Category</label>
                    <select id="category_id" name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $drug->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Warehouse Selection -->
                <div>
                    <label for="warehouse_id" class="block text-sm font-medium text-gray-700 mb-1">Select Warehouse</label>
                    <select id="warehouse_id" name="warehouse_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $drug->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->warehouse_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('warehouse_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                    <input type="file" id="image" name="image" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Drug Description -->
            <div>
                <label for="drug_description" class="block text-sm font-medium text-gray-700 mb-1">Drug Description</label>
                <textarea id="drug_description" name="drug_description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('drug_description', $drug->drug_description) }}</textarea>
                @error('drug_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Side Effects -->
            <div>
                <label for="side_effects" class="block text-sm font-medium text-gray-700 mb-1">Side Effects</label>
                <textarea id="side_effects" name="side_effects" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('side_effects', $drug->side_effects) }}</textarea>
                @error('side_effects')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300">
                    Update Drug
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
