@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Pharmacy Information</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some issues with your submission.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pharmacy.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- User Selection -->
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Owner Name -->
        <div class="form-group">
            <label for="owner_name">Owner Name</label>
            <input type="text" name="owner_name" id="owner_name" class="form-control" value="{{ old('owner_name') }}" required>
        </div>

        <!-- Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
        </div>

        <!-- Pharmacy Name -->
        <div class="form-group">
            <label for="pharmacy_name">Pharmacy Name</label>
            <input type="text" name="pharmacy_name" id="pharmacy_name" class="form-control" value="{{ old('pharmacy_name') }}" required>
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
        </div>

        <!-- License Image -->
        <div class="form-group">
            <label for="license_image">License Image</label>
            <input type="file" name="license_image" id="license_image" class="form-control-file" accept="image/*">
            <small class="form-text text-muted">Accepted formats: jpg, jpeg, png. Max size: 10MB.</small>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
