@extends('dashboard.layout.side')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-1 bg-white rounded-lg shadow-lg p-10 m-5">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Edit Pharmacy Info</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">{{ session('success') }}</strong>
            </div>
        @endif

        <form action="{{ route('dashboard.pharmacy.update', $pharmacyInfo->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- User Selection -->
            <div class="relative">
                <label for="user_id" class="block text-gray-600 text-sm font-medium">Select User</label>
                <select id="user_id" name="user_id" class="p-2 mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                    <option value="" disabled>Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $pharmacyInfo->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Owner Name -->
            <div class="relative">
                <label for="owner_name" class="block text-gray-600 text-sm font-medium">Owner Name</label>
                <input type="text" id="owner_name" name="owner_name" value="{{ old('owner_name', $pharmacyInfo->owner_name) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('owner_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Location -->
            <div class="relative">
                <label for="location" class="block text-gray-600 text-sm font-medium">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $pharmacyInfo->location) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pharmacy Name -->
            <div class="relative">
                <label for="pharmacy_name" class="block text-gray-600 text-sm font-medium">Pharmacy Name</label>
                <input type="text" id="pharmacy_name" name="pharmacy_name" value="{{ old('pharmacy_name', $pharmacyInfo->pharmacy_name) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('pharmacy_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone Number -->
            <div class="relative">
                <label for="phone_number" class="block text-gray-600 text-sm font-medium">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $pharmacyInfo->phone_number) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('phone_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- License Image Upload -->
            <div class="relative">
                <label for="license_image" class="block text-gray-600 text-sm font-medium">License Image</label>
                <input type="file" id="license_image" name="license_image" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2">
                @if ($pharmacyInfo->license_image)
                    <img src="{{ asset('storage/licenses/' . $pharmacyInfo->license_image) }}" alt="License Image" class="mt-2 mb-2 w-32 h-32 object-cover">
                @endif
                @error('license_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded-lg">Update Pharmacy Info</button>
        </form>
    </div>
</div>
@endsection
