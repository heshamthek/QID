@extends('dashboard.layout.side')

@section('content')
<div class="w-full mt-12 p-6 bg-white rounded-lg shadow-lg">

  <h2 class="text-2xl font-semibold text-gray-800 pb-4 flex items-center">
    <i class="fas fa-pills mr-3"></i> Drugs
</h2>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <!-- Add New Drug Button -->
    <a href="{{ route('dashboard.drug.create') }}" class="mb-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md px-4 py-2 transition duration-200">
        Add New Drug
    </a>

    <!-- Drugs Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantity</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($drugs as $drug)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $drug->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $drug->drug_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $drug->drug_description }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $drug->drug_quantity }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">${{ number_format($drug->drug_price, 2) }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm flex space-x-2">
                        <!-- Edit Button with Icon -->
                        <a href="{{ route('dashboard.drug.edit', $drug->id) }}" class="text-blue-600 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Delete Button with Icon -->
                        <button class="text-red-600 hover:text-red-700" onclick="openDeleteModal({{ $drug->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-2 px-4 border-b text-center">No drugs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class=" mt-6">
      {{ $drugs->links() }} 
  </div>
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 sm:w-1/3">
            <h3 class="text-lg font-semibold">Delete Confirmation</h3>
            <p class="mt-2">Are you sure you want to delete this drug entry?</p>
            <div class="mt-4 flex justify-end">
                <button class="bg-gray-300 hover:bg-gray-400 text-black rounded-lg px-4 py-2" onclick="closeDeleteModal()">Cancel</button>
                <button id="confirmDelete" class="bg-red-600 hover:bg-red-700 text-white rounded-lg px-4 py-2 ml-2">Delete</button>
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
    </script>
</div>
@endsection
