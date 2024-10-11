@extends('dashboard.layout.side')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-10">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Add New Drug Category</h2>
        
        <form action="{{ route('dashboard.drug_categories.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Category Name -->
            <div class="relative">
                <label for="category_name" class="block text-gray-600 text-sm font-medium">Category Name</label>
                <input type="text" id="category_name" name="category_name" value="{{ old('categorie_name') }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('category_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-3 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
