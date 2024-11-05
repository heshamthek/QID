@extends('dashboard.layout.side')

@section('content')
<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 text-white py-4 px-6">
            <h2 class="text-2xl font-bold">Add New Drug Category</h2>
        </div>
        
        <form action="{{ route('dashboard.drug_categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <!-- Category Name -->
            <div>
                <label for="category_name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" id="category_name" name="category_name" value="{{ old('category_name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                @error('category_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
