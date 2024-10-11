@extends('dashboard.layout.side')

@section('content')
<div class="w-full mt-12 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 pb-4">Pharmacy Info Details</h2>
    
    <div class="space-y-4">
        <p><strong>Owner Name:</strong> {{ $pharmacyInfo->owner_name }}</p>
        <p><strong>Location:</strong> {{ $pharmacyInfo->location }}</p>
        <p><strong>Pharmacy Name:</strong> {{ $pharmacyInfo->pharmacy_name }}</p>
        <p><strong>Phone Number:</strong> {{ $pharmacyInfo->phone_number }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('dashboard.pharmacy.edit', $pharmacyInfo->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md px-4 py-2 transition duration-200">Edit</a>
        <form action="{{ route('dashboard.pharmacy.destroy', $pharmacyInfo->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this pharmacy info?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md px-4 py-2 transition duration-200">Delete</button>
        </form>
    </div>
</div>
@endsection
