@extends('dashboard.layout.side')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-1 bg-white rounded-lg shadow-lg p-10 m-5">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Edit User</h2>

        <form action="{{ route('dashboard.user.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="relative">
                <label for="name" class="block text-gray-600 text-sm font-medium">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="relative">
                <label for="email" class="block text-gray-600 text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- New Password -->
            <div class="relative">
                <label for="password" class="block text-gray-600 text-sm font-medium">New Password (Leave blank to keep the current password)</label>
                <input type="password" id="password" name="password" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="relative">
                <label for="password_confirmation" class="block text-gray-600 text-sm font-medium">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2">
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- User Role -->
            <div class="relative">
                <label for="is_admin" class="block text-gray-600 text-sm font-medium">User Role</label>
                <select id="is_admin" name="is_admin" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                    <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>User</option>
                    <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ $user->is_admin == 2 ? 'selected' : '' }}>Superadmin</option>
                </select>
                @error('is_admin')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- User Status -->
            <div class="relative">
                <label for="status" class="block text-gray-600 text-sm font-medium">Status</label>
                <select id="status" name="status" class="mt-2 block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 p-2" required>
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-3 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
