@extends('admin.layouts.app')

@section('content')

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        {{-- Sidebar --}}
        @include('admin.dashboard.sidenav')

        <div class="layout-page">

            {{-- Top Navigation --}}
            @include('admin.dashboard.topnav')

            <div class="container mt-5">

                <h3 class="mb-4 fw-bold">Upload Car for Sale</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">

                                <!-- Car Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Car Name</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        class="form-control form-control-lg"
                                        placeholder="e.g., Toyota Camry 2018"
                                        required>
                                </div>

                                <!-- Car Price -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Price (₦)</label>
                                    <input 
                                        type="number" 
                                        name="price" 
                                        class="form-control form-control-lg"
                                        placeholder="e.g., 8500000"
                                        required>
                                </div>

                                <!-- Car Model -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Model</label>
                                    <input 
                                        type="text" 
                                        name="model" 
                                        class="form-control form-control-lg"
                                        placeholder="e.g., SE, XLE"
                                        required>
                                </div>

                                <!-- Car Year -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Year</label>
                                    <input 
                                        type="number" 
                                        name="year" 
                                        class="form-control form-control-lg"
                                        placeholder="e.g., 2018"
                                        required>
                                </div>

                                <!-- Car Description -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea 
                                        name="description" 
                                        class="form-control form-control-lg" 
                                        rows="4"
                                        placeholder="Write a short description of the car..."
                                        required></textarea>
                                </div>

                                <!-- Images Section -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Upload Car Images (3 required)</label>

                                    <div class="row g-3 mt-1">

                                        <!-- Image 1 -->
                                        <div class="col-md-4">
                                            <div class="p-3 border rounded-3 text-center shadow-sm bg-light">
                                                <p class="mb-2 fw-semibold">Image 1</p>
                                                <input 
                                                    type="file" 
                                                    name="image_1" 
                                                    accept="image/*"
                                                    class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Image 2 -->
                                        <div class="col-md-4">
                                            <div class="p-3 border rounded-3 text-center shadow-sm bg-light">
                                                <p class="mb-2 fw-semibold">Image 2</p>
                                                <input 
                                                    type="file" 
                                                    name="image_2" 
                                                    accept="image/*"
                                                    class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Image 3 -->
                                        <div class="col-md-4">
                                            <div class="p-3 border rounded-3 text-center shadow-sm bg-light">
                                                <p class="mb-2 fw-semibold">Image 3</p>
                                                <input 
                                                    type="file" 
                                                    name="image_3" 
                                                    accept="image/*"
                                                    class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button class="btn btn-primary btn-lg px-4">Upload Car</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
