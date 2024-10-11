@extends('dashboard.layout.side')

@section('content')
<div class="w-full mt-12 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 pb-4 flex items-center">
        <i class="fas fa-capsules mr-3"></i>Drug Categories
    </h2>

    
    <a href="{{ route('dashboard.drug_categories.create') }}" class="mb-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md px-4 py-2 transition duration-200">
        Add New Category
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category Name</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drugCategories as $drugCategory)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $drugCategory->category_name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex space-x-2">
                        <a href="{{ route('dashboard.drug_categories.edit', $drugCategory->id) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="openDeleteModal({{ $drugCategory->id }})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg overflow-hidden shadow-lg w-1/3">
        <div class="p-6">
            <h3 class="text-lg font-semibold">Delete Category</h3>
            <p>Are you sure you want to delete this category?</p>
            <div class="mt-4 flex justify-end">
                <button id="confirmDelete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                <button onclick="closeDeleteModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-2">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteId;

    function openDeleteModal(id) {
        deleteId = id; // Store the category ID for deletion
        document.getElementById('deleteModal').classList.remove('hidden'); // Show the modal
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden'); // Hide the modal
    }

    // Handle deletion when the confirm button is clicked
    document.getElementById('confirmDelete').addEventListener('click', function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("dashboard.drug_categories.destroy", ":id") }}'.replace(':id', deleteId);

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
        form.submit(); // Submit the form
    });
</script>

@endsection
