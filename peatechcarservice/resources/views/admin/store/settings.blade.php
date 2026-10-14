@extends('admin.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('admin.dashboard.sidenav')

        <div class="layout-page">

            @include('admin.dashboard.topnav')

            <div class="container mt-5">
                <h3 class="mb-4">Profile Settings</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.store.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- Store Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Store Name</label>
                            <input type="text" name="store_name" class="form-control" required>
                        </div>

                        <!-- Store Address -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Store Address</label>
                            <input type="text" name="store_address" class="form-control" required>
                        </div>

                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" required>
                        </div>

                        <!-- Store Images -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Upload Store Images (2 Images)</label>
                            <input 
                                type="file" 
                                name="store_images[]" 
                                class="form-control" 
                                accept="image/*" 
                                multiple 
                                required>
                            <small class="text-muted">Upload exactly 2 images.</small>
                        </div>

                        <!-- Registration Document -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Registration Document</label>
                            <input 
                                type="file" 
                                name="registration_doc" 
                                class="form-control" 
                                accept=".pdf,image/*" 
                                required>
                            <small class="text-muted">PDF or Image.</small>
                        </div>

                        <!-- Available Hours -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Opening Time</label>
                            <input type="time" name="opening_time" class="form-control" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Closing Time</label>
                            <input type="time" name="closing_time" class="form-control" required>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Save Store</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
