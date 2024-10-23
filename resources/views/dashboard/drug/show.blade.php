@extends('dashboard.layout.side')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 pt-2"> <!-- Reduced top padding -->
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-6 m-5"> <!-- Increased width -->
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Drug Details</h2>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="w-full bg-gray-200">
                    <th class="py-2 text-left text-gray-600">Field</th>
                    <th class="py-2 text-left text-gray-600">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="py-2 font-medium">Drug Name</td>
                    <td class="py-2 text-gray-700">{{ $drug->drug_name }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-2 font-medium">Description</td>
                    <td class="py-2 text-gray-700">{{ $drug->drug_description }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-2 font-medium">Side Effects</td>
                    <td class="py-2 text-gray-700">{{ $drug->side_effects ?? 'Not specified' }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-2 font-medium">Price</td>
                    <td class="py-2 text-gray-700">${{ number_format($drug->drug_price, 2) }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-2 font-medium">Quantity</td>
                    <td class="py-2 text-gray-700">{{ $drug->drug_quantity }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-2 font-medium">Category</td>
                    <td class="py-2 text-gray-700">{{ $drug->category->name }}</td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-between mt-6">
            <a href="{{ route('dashboard.drug.edit', $drug->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2 px-4 transition duration-300 ease-in-out">
                Edit
            </a>

           
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
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
</div>
@endsection
