@extends('admin.layouts.app')

@section('content')
<!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('admin.dashboard.sidenav')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('admin.dashboard.topnav')
        
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl grow container-p-y">
                @php
                    $admin = auth('admin')->user();

                    $settingsIncomplete = empty($admin?->start_datetime) || empty($admin?->end_datetime);
                @endphp
                @if ($settingsIncomplete)
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-start gap-2" role="alert">
                        <i class="bx bx-time-five fs-5 mt-1"></i>

                        <div class="flex-grow-1">
                            <strong>Action required.</strong>
                            Please set your available time in the
                            <a href="{{ route('admin.settings.index') }}" class="alert-link">Settings</a>
                            page to start receiving bookings.
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

              <div class="row">

                <!-- Total Bookings -->
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                        <h5 class="card-title mb-1">Total Bookings</h5>
                        <h3 class="mb-0">{{ $totalBookings }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bx-bookmark-alt text-white" style="font-size: 28px;"></i>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Pending Bookings -->
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                        <h5 class="card-title mb-1">Pending Bookings</h5>
                        <h3 class="mb-0 text-warning">{{ $pendingBookings }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-warning rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bx-time text-white" style="font-size: 28px;"></i>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Confirmed Bookings -->
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                        <h5 class="card-title mb-1">Confirmed Bookings</h5>
                        <h3 class="mb-0 text-success">{{ $confirmedBookings }}</h3>
                        </div>
                        <div class="avatar avatar-lg bg-success rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bx-check-circle text-white" style="font-size: 28px;"></i>
                        </div>
                    </div>
                    </div>
                </div>

                </div>

                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>S/N</th>
                                    <th>Customer</th>
                                    <th>Phone</th>
                                    <th>Date & Time</th>
                                    <th>Car Model</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="table-border-bottom-0">
                                @forelse($appointments as $index => $appointment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td><strong>{{ $appointment->full_name }}</strong></td>

                                    <td>{{ $appointment->phone }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($appointment->preferred_date)->format('M d, Y') }}
                                        <br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('g:i A') }}
                                        </small>
                                    </td>

                                    <td>{{ $appointment->car_model }}</td>

                                    <td>
                                        @php
                                            $statusClass = match($appointment->status) {
                                                'pending' => 'badge bg-warning',
                                                'ongoing' => 'badge bg-primary',
                                                'completed' => 'badge bg-success',
                                                'rejected' => 'badge bg-danger',
                                                default => 'badge bg-secondary',
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ ucfirst($appointment->status) }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <button
                                                class="btn btn-sm btn-info view-booking-btn"
                                                data-booking='@json($appointment)'
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <form action="#" method="POST" class="m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No appointments found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="viewBookingModal" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Booking Details</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row g-3">

                                    <div class="col-md-8">
                                        <p><strong>Customer:</strong> <span id="vb-name"></span></p>
                                        <p><strong>Phone:</strong> <span id="vb-phone"></span></p>
                                        <p><strong>Date:</strong> <span id="vb-date"></span></p>
                                        <p><strong>Time:</strong> <span id="vb-time"></span></p>
                                        <p><strong>Status:</strong> <span id="vb-status"></span></p>

                                        <hr>

                                        <p class="mb-1"><strong>Service Description</strong></p>
                                        <p class="text-muted" id="vb-description"></p>

                                        <p class="mb-1 mt-3"><strong>Car Model</strong></p>
                                        <p id="vb-car-model"></p>
                                    </div>

                                    <div class="col-md-4 text-center">
                                        <p class="mb-2"><strong>Car Photo</strong></p>
                                        <img id="vb-car-photo"
                                            src=""
                                            class="img-fluid rounded border"
                                            style="max-height:200px; object-fit:cover;">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    document.querySelectorAll('.view-booking-btn').forEach(btn => {
                        btn.addEventListener('click', function () {
                            const booking = JSON.parse(this.dataset.booking);

                            document.getElementById('vb-name').textContent = booking.full_name;
                            document.getElementById('vb-phone').textContent = booking.phone;
                            document.getElementById('vb-date').textContent = booking.preferred_date;
                            document.getElementById('vb-time').textContent = booking.preferred_time;
                            document.getElementById('vb-description').textContent = booking.service_description || '—';
                            document.getElementById('vb-car-model').textContent = booking.car_model;
                            document.getElementById('vb-status').innerHTML =
                                `<span class="badge bg-secondary">${booking.status}</span>`;

                            const photo = booking.car_photo
                                ? `/storage/${booking.car_photo}`
                                : 'https://via.placeholder.com/300x200?text=No+Image';

                            document.getElementById('vb-car-photo').src = photo;

                            new bootstrap.Modal(document.getElementById('viewBookingModal')).show();
                        });
                    });
                </script>




          
            </div>
            <!-- / Content -->

        

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

@endsection