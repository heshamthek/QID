@extends('dashboard.layout.side')

@section('content')
<div class="w-full mt-12 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 pb-4 flex items-center">
        <i class="fas fa-warehouse mr-3"></i> Drug Warehouses
    </h2>

    <!-- Create Drug Warehouse Button -->
    <a href="{{ route('dashboard.drug_warehouses.create') }}" class="mb-4 inline-block bg-blue-600 hover:bg-blue-800 text-white font-semibold rounded-md px-4 py-2 transition duration-200">
        Create Drug Warehouse
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Warehouse Name
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Logo
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($warehouses as $warehouse)
                <tr>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        {{ $warehouse->warehouse_name }}
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                                @if ($warehouse->logo)
                                <img class="w-full h-full rounded-full object-cover" 
                                     src="{{ asset('storage/' . $warehouse->logo) }}" 
                                     alt="Warehouse Logo" />                         
                                @else
                                    <span class="text-gray-500">No Logo</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm flex space-x-2">
                        <a href="{{ route('dashboard.drug_warehouses.edit', $warehouse->id) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="openModal({{ $warehouse->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-lg w-1/3">
            <div class="p-6">
                <h3 class="text-lg font-semibold">Delete Warehouse</h3>
                <p>Are you sure you want to delete this warehouse?</p>
                <div class="mt-4 flex justify-end">
                    <button id="confirmDelete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    <button onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-2">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let warehouseId;

        function openModal(id) {
            warehouseId = id; 
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('confirmDelete').addEventListener('click', function() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("dashboard.drug_warehouses.destroy", ":id") }}'.replace(':id', warehouseId);

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        });
    </script>
</div>
@endsection
