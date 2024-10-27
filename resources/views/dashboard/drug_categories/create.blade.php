@extends('dashboard.layout.side')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-light">
    <div class="w-full max-w-full bg-white rounded-lg shadow-lg p-10">
        <h2 class="text-3xl font-semibold text-center text-gray-dark mb-6">Add New Drug Category</h2>
        
        <form action="{{ route('dashboard.drug_categories.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Category Name -->
            <div class="relative">
                <label for="category_name" class="block text-gray-dark text-sm font-medium">Category Name</label>
                <input type="text" id="category_name" name="category_name" value="{{ old('category_name') }}" class="mt-2 block w-full bg-light border border-gray rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 p-2" required>
                @error('category_name')
                    <span class="text-danger text-sm">{{ $message }}</span> <!-- Error message in red -->
                @enderror
            </div>

            <!-- Submit Button -->
             <div class="text-center">
                <button type="submit" 
                    class="w-full text-white font-semibold rounded-lg py-3 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-600" 
                    style="background-color: #007bff;" 
                    onmouseover="this.style.backgroundColor='#0056b3';" 
                    onmouseout="this.style.backgroundColor='#007bff';">
                    Submit
                </button>
                </div>
        </form>
    </div>
</div>
@endsection
