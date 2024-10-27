@extends('dashboard.layout.side')

@section('content')
<div class="w-full max-w-7xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-lg">

    <h2 class="text-2xl font-semibold text-gray-800 pb-4 flex items-center">
        <i class="fas fa-pills mr-3"></i> Drugs
    </h2>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <!-- Add New Drug Button -->
    <a href="{{ route('dashboard.drug.create') }}" class="mb-4 inline-block bg-blue-800 hover:bg-blue-700 text-white font-semibold rounded-md px-4 py-2 transition duration-200">
        Add New Drug
    </a>

    <!-- Drugs Table -->
    <div id="drugsTable" class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($drugs as $drug)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $drug->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $drug->drug_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $drug->drug_description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $drug->drug_quantity }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">${{ number_format($drug->drug_price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                        <!-- View Button with Icon -->
                        <a href="{{ route('dashboard.drug.show', $drug->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i> 
                        </a>
                        <!-- Edit Button with Icon -->
                        <a href="{{ route('dashboard.drug.edit', $drug->id) }}" class="text-blue-600 hover:text-blue-800 mx-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Delete Button with Icon -->
                        <button class="text-red-600 hover:text-red-800" onclick="openDeleteModal({{ $drug->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-2 px-4 text-center text-sm text-gray-600">No drugs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $drugs->links() }} 
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 sm:w-1/3">
            <h3 class="text-lg font-semibold">Delete Confirmation</h3>
            <p class="mt-2">Are you sure you want to delete this drug entry?</p>
            <div class="mt-4 flex justify-end">
                <button class="bg-gray-300 hover:bg-gray-400 text-black rounded-lg px-4 py-2" onclick="closeDeleteModal()">Cancel</button>
                <button id="confirmDelete" class="bg-red-800 hover:bg-red-700 text-white rounded-lg px-4 py-2 ml-2">Delete</button>
            </div>
        </div>
    </div>

    <script>
        let deleteId;

        function openDeleteModal(id) {
            deleteId = id; // Store the drug ID for deletion
            document.getElementById('deleteModal').classList.remove('hidden'); // Show the modal
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden'); // Hide the modal
        }

        // Handle deletion when the confirm button is clicked
        document.getElementById('confirmDelete').addEventListener('click', function() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("dashboard.drug.destroy", ":id") }}'.replace(':id', deleteId);

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}'; // CSRF Token for security
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE'; // Specify the method for deletion
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit(); // Submit the form to delete the drug
        });

        // Toggle visibility of the drugs table
        document.getElementById('toggleContent').addEventListener('click', function() {
            const table = document.getElementById('drugsTable');
            if (table.classList.contains('hidden')) {
                table.classList.remove('hidden');
            } else {
                table.classList.add('hidden');
            }
        });
    </script>
</div>
@endsection
