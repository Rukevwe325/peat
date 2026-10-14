@extends('layouts.app')

@section('title', $shop->first_name.' '.$shop->last_name.' | Peamech Car Service')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<div class="container py-5">
    @if(session('success'))
        <div class="success-alert">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endif
    <div class="shop-profile-card">
        
        <div class="profile-header">
            <div class="profile-cover" 
                 style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('{{ $shop->profile_photo ? asset('storage/'.$shop->profile_photo) : 'https://via.placeholder.com/1200x400' }}');">
            </div>

            <div class="profile-image-wrapper">
                <img src="{{ $shop->profile_photo ? asset('storage/'.$shop->profile_photo) : 'https://via.placeholder.com/120' }}" 
                     alt="Profile" class="profile-image">
            </div>
            
            <h2 class="profile-name">{{ $shop->first_name }} {{ $shop->last_name }}</h2>

            @php
                use Carbon\Carbon;
                $now = Carbon::now();
                $start = $shop->start_datetime ? Carbon::parse($shop->start_datetime) : null;
                $end   = $shop->end_datetime ? Carbon::parse($shop->end_datetime) : null;
                $available = $start && $end && $now->between($start, $end);
                $timeRange = $start && $end ? $start->format('g:i A') . ' – ' . $end->format('g:i A') : 'Not set';
            @endphp
            
            <p class="shop-availability {{ $available ? 'available' : 'unavailable' }}">
                <i class="fa-solid {{ $available ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                {{ $available ? 'Available to Receive Cars' : 'Currently Unavailable' }}
            </p>

            <p class="available-period mt-3">
                Available Period: <span class="time-range">{{ $shop->available_range ?? $timeRange }}</span>
            </p>

            <p class="profile-role">Shop Administrator</p>
        </div>

        <div class="info-grid">
            
            <div class="info-column">
                <h3 class="column-title">Contact Information</h3>
                
                <div class="info-item">
                    <div class="info-icon-box bg-blue-glow">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <p class="info-label">Email</p>
                        <p class="info-value">{{ $shop->email ?? 'Not provided' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon-box bg-green-glow">
                        <i class="fa-solid fa-phone-flip"></i>
                    </div>
                    <div>
                        <p class="info-label">Phone</p>
                        <p class="info-value">{{ $shop->phone ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <div class="info-column">
                <h3 class="column-title">Location Details</h3>
                
                <div class="info-item">
                    <div class="info-icon-box bg-red-glow">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="info-label">Address</p>
                        <p class="info-value">{{ $shop->address ?? 'Not provided' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon-box bg-purple-glow">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <div>
                        <p class="info-label">Business Type</p>
                        <p class="info-value">Car Service Center</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            @if($shop->email)
            <a href="mailto:{{ $shop->email }}" class="btn btn-primary">
                Contact Admin
            </a>
            @endif
            
            @if($shop->phone)
            <a href="tel:{{ $shop->phone }}" class="btn btn-success">
                Call Now
            </a>
            @endif

            <button type="button" class="btn btn-outline-primary" onclick="openBookingModalFunc()">
                Book Appointment
            </button>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div class="booking-modal" id="bookingModalUnique">
    <div class="booking-modal-content" id="bookingModalContentUnique">
        <div class="booking-modal-header">
            <h4>Schedule Appointment</h4>
            <button type="button" class="close-modal" onclick="closeBookingModalFunc()">&times;</button>
        </div>

        <form class="booking-form" id="bookingFormUnique" method="POST" action="{{ route('book.store', $shop->id) }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="full_name_booking">Full Name</label>
                <input type="text" id="full_name_booking" name="full_name" placeholder="Your name" required>
            </div>

            <div class="form-group">
                <label for="phone_booking">Phone Number</label>
                <input type="text" id="phone_booking" name="phone" placeholder="Your phone number" required>
            </div>

            <div class="form-group">
                <label for="car_model_booking">Car Model</label>
                <input type="text" id="car_model_booking" name="car_model" placeholder="e.g. Toyota Camry" required>
            </div>

            <div class="form-group text-center">
                <label for="carPhotoInputBooking">Car Photo (Optional)</label>
                <img id="carPhotoPreviewBooking" class="car-photo-preview" alt="Car Preview" style="display:none; width:100px; height:100px; object-fit:cover; border-radius:8px; margin-bottom:8px; border:1px solid #ccc;" />
                <input type="file" name="car_photo" id="carPhotoInputBooking" accept="image/*" onchange="previewCarPhoto(this)">
            </div>

            <div class="form-group">
                <label for="preferred_date_booking">Preferred Date</label>
                <input type="date" id="preferred_date_booking" name="preferred_date" required>
            </div>

            <div class="form-group">
                <label for="preferred_time_booking">Preferred Time</label>
                <input type="time" id="preferred_time_booking" name="preferred_time" required>
            </div>

            <div class="form-group">
                <label for="service_description_booking">Service Description</label>
                <textarea id="service_description_booking" name="service_description" rows="3" placeholder="Brief description of the issue"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100" onclick="console.log('Submit button clicked'); return true;">
                Submit Request
            </button>
        </form>
    </div>
</div>

<style>
    body { background: #f1f5f9; font-family: 'Inter', sans-serif; }
    .success-alert {
        background: #d1fae5;
        color: #065f46;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .success-alert i {
        font-size: 20px;
    }

    .close-alert {
        margin-left: auto;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #065f46;
        line-height: 1;
    }
    .shop-profile-card { 
        max-width: 900px; 
        margin: 0 auto; 
        background: white; 
        border-radius: 16px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
        overflow: hidden; 
    }

    .profile-cover { 
        height: 180px; 
        background-size: cover !important; 
        background-position: center !important;
        background-repeat: no-repeat !important;
    }

    .profile-header { text-align: center; padding-bottom: 2rem; border-bottom: 1px solid #e5e7eb; }
    .profile-image-wrapper { margin-top: -60px; margin-bottom: 1rem; position: relative; z-index: 2; }
    .profile-image { width: 120px; height: 120px; border-radius: 50%; border: 4px solid white; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
    .profile-name { font-size: 28px; font-weight: 700; color: #1f2937; margin: 0.5rem 0; }
    .profile-role { color: #6b7280; font-size: 16px; margin: 0; }
    
    .shop-availability { font-weight: 600; padding: 6px 14px; border-radius: 20px; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 5px; }
    .shop-availability.available { color: #065f46; background: #d1fae5; }
    .shop-availability.unavailable { color: #b91c1c; background: #fee2e2; }

    .available-period { color: #4b5563; font-size: 14px; }
    .time-range { font-weight: 600; color: #1f2937; }

    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; padding: 2rem; }
    .info-column { display: flex; flex-direction: column; gap: 1rem; }
    .column-title { font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid #3b82f6; }
    
    .info-item { display: flex; gap: 1rem; align-items: center; padding: 1rem; border-radius: 12px; background: #f9fafb; }
    
    .info-icon-box {
        width: 45px; height: 45px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; flex-shrink: 0; font-size: 18px;
    }

    .bg-blue-glow { background: #ebf3ff; color: #3b82f6; box-shadow: 0 0 15px rgba(59, 130, 246, 0.2); }
    .bg-green-glow { background: #ecfdf5; color: #10b981; box-shadow: 0 0 15px rgba(16, 185, 129, 0.2); }
    .bg-red-glow { background: #fef2f2; color: #ef4444; box-shadow: 0 0 15px rgba(239, 68, 68, 0.2); }
    .bg-purple-glow { background: #f5f3ff; color: #8b5cf6; box-shadow: 0 0 15px rgba(139, 92, 246, 0.2); }

    .info-label { font-size: 11px; color: #6b7280; font-weight: 700; text-transform: uppercase; margin: 0; }
    .info-value { font-size: 15px; color: #1f2937; font-weight: 500; margin: 0; }

    .action-buttons { display: flex; gap: 1rem; padding: 2rem; justify-content: center; border-top: 1px solid #e5e7eb; flex-wrap: wrap; }
    .btn { 
        padding: 12px 32px; 
        border-radius: 8px; 
        font-weight: 600; 
        text-decoration: none; 
        transition: all 0.2s ease; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        border: none;
        cursor: pointer;
        display: inline-block;
    }
    .btn-primary { background: #3b82f6; color: white; }
    .btn-primary:hover { background: #2563eb; box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3); }
    .btn-success { background: #10b981; color: white; }
    .btn-success:hover { background: #059669; box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3); }
    .btn-outline-primary { 
        background: white; 
        color: #3b82f6; 
        border: 2px solid #3b82f6; 
    }
    .btn-outline-primary:hover { 
        background: #3b82f6; 
        color: white; 
    }

    @media (max-width: 768px) {
        .info-grid { grid-template-columns: 1fr; }
        .action-buttons { flex-direction: column; align-items: stretch; }
        .btn { text-align: center; }
    }

    /* Booking Modal Styles */
    .booking-modal {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .booking-modal.active { display: flex; }

    .booking-modal-content {
        background: white;
        width: 100%;
        max-width: 450px;
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }

    .booking-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .booking-modal-header h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        color: #1f2937;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #6b7280;
        line-height: 1;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-modal:hover {
        color: #1f2937;
    }

    .booking-form .form-group { margin-bottom: 1rem; }

    .booking-form label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        display: block;
        margin-bottom: 6px;
    }

    .booking-form input,
    .booking-form textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 14px;
        font-family: inherit;
    }

    .booking-form input:focus,
    .booking-form textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .booking-form .w-100 {
        width: 100%;
    }

    .booking-form .text-center {
        text-align: center;
    }
</style>

<script>
    // Use unique function names to avoid conflicts
    function openBookingModalFunc() {
        console.log('Opening modal...');
        var modal = document.getElementById('bookingModalUnique');
        if (modal) {
            modal.classList.add('active');
            console.log('Modal opened');
        } else {
            console.error('Modal not found!');
        }
    }

    function closeBookingModalFunc() {
        console.log('Closing modal...');
        var modal = document.getElementById('bookingModalUnique');
        if (modal) {
            modal.classList.remove('active');
        }
    }

    function previewCarPhoto(input) {
        console.log('File selected');
        var preview = document.getElementById('carPhotoPreviewBooking');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Click outside to close
    document.addEventListener('click', function(e) {
        var modal = document.getElementById('bookingModalUnique');
        if (e.target === modal) {
            closeBookingModalFunc();
        }
    });

    // Debug form submission
    window.addEventListener('load', function() {
        var form = document.getElementById('bookingFormUnique');
        if (form) {
            console.log('Form found. Action:', form.action);
            form.addEventListener('submit', function(e) {
                console.log('FORM SUBMITTING NOW!');
                console.log('Action URL:', this.action);
                console.log('Method:', this.method);
                // Don't prevent default - let it submit
            });
        } else {
            console.error('Form not found!');
        }
    });
</script>
@endsection