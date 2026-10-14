@extends('admin.layouts.app')

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('admin.dashboard.sidenav')

        <div class="layout-page">

            @include('admin.dashboard.topnav')

            <div class="container mt-5">
                <h3 class="mb-4">Set Availability Date & Time</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Start DateTime -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date & Time</label>
                            <input type="datetime-local"
                                name="start_datetime"
                                class="form-control"
                                value="{{ $setting->start_datetime ?? '' }}"
                                required>
                        </div>

                        <!-- End DateTime -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date & Time</label>
                            <input type="datetime-local"
                                name="end_datetime"
                                class="form-control"
                                value="{{ $setting->end_datetime ?? '' }}"
                                required>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
