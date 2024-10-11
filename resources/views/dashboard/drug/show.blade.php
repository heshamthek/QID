@extends('dashboard.layout.side')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg p-10 m-5">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Pharmacy Details</h2>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium">Owner Name</label>
            <p class="mt-2 text-lg text-gray-700">{{ $pharmacy->owner_name }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium">Pharmacy Name</label>
            <p class="mt-2 text-lg text-gray-700">{{ $pharmacy->pharmacy_name }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium">Location</label>
            <p class="mt-2 text-lg text-gray-700">{{ $pharmacy->location }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium">Phone Number</label>
            <p class="mt-2 text-lg text-gray-700">{{ $pharmacy->phone_number }}</p>
        </div>

        <!-- Additional Information -->
        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium">Additional Notes</label>
            <p class="mt-2 text-lg text-gray-700">{{ $pharmacy->notes ?? 'No additional notes available.' }}</p>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('dashboard.pharmacy.edit', $pharmacy->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2 px-4 transition duration-300 ease-in-out">
                Edit
            </a>

            <button class="bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg py-2 px-4 transition duration-300 ease-in-out" onclick="openDeleteModal({{ $pharmacy->id }})">
                Delete
            </button>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                <h3 class="text-lg font-semibold">Delete Confirmation</h3>
                <p class="mt-2">Are you sure you want to delete this pharmacy entry?</p>
                <div class="mt-4 flex justify-end">
                    <button class="bg-gray-300 hover:bg-gray-400 text-black rounded-lg px-4 py-2" onclick="closeDeleteModal()">Cancel</button>
                    <button id="confirmDelete" class="bg-red-600 hover:bg-red-700 text-white rounded-lg px-4 py-2 ml-2">Delete</button>
                </div>
            </div>
        </div>

        <script>
            let deleteId;

            function openDeleteModal(id) {
                deleteId = id; // Store the pharmacy info ID for deletion
                document.getElementById('deleteModal').classList.remove('hidden'); // Show the modal
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden'); // Hide the modal
            }

            // Handle deletion when the confirm button is clicked
            document.getElementById('confirmDelete').addEventListener('click', function() {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("dashboard.pharmacy.destroy", ":id") }}'.replace(':id', deleteId);

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
                form.submit(); // Submit the form to delete the pharmacy
            });
        </script>
    </div>
</div>
@endsection
