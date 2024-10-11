@extends('dashboard.layout.side')

@section('content')
<div class="w-full mt-12 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">Edit Drug Warehouse</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.drug_warehouses.update', $drugWarehouse) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="warehouse_name" class="block text-gray-700">Warehouse Name</label>
            <input type="text" name="warehouse_name" id="warehouse_name" value="{{ $drugWarehouse->warehouse_name }}" class="border border-gray-300 rounded p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="logo" class="block text-gray-700">Logo (optional)</label>
            <input type="file" name="logo" id="logo" class="border border-gray-300 rounded p-2 w-full">
            @if ($drugWarehouse->logo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $drugWarehouse->logo) }}" alt="{{ $drugWarehouse->warehouse_name }}" class="w-16 h-16">
                </div>
            @endif
        </div>

        <button type="submit" class="bg-blue-500 text-white rounded p-2">Update Warehouse</button>
    </form>
</div>
@endsection
