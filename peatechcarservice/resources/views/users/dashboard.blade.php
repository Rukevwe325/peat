@extends('users.layout')

@section('title', 'Dashboard')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <style>
    /* Ping animation */
    .ping-dot {
        position: absolute;
        top: -4px;
        right: 8px;
        height: 16px;
        width: 16px;
        border-radius: 50%;
        z-index: 50; /* stays above card */
    }

    .ping-dot::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 50%;
        animation: ping 1.4s infinite cubic-bezier(0, 0, 0.2, 1);
        opacity: .75;
        z-index: 49;
    }

    @keyframes ping {
        0% {
            transform: scale(0.6);
            opacity: 1;
        }
        100% {
            transform: scale(2.3);
            opacity: 0;
        }
    }

    .dot-success {
        background-color: #28a745;
    }
    .dot-success::before {
        background-color: #28a745;
    }

    .dot-danger {
        background-color: #dc3545;
    }
    .dot-danger::before {
        background-color: #dc3545;
    }

    /* Make card clickable without blue text */
    .card-link {
        text-decoration: none !important;
        color: inherit !important;
    }
</style>

<div class="row">
    @foreach($stores as $store)
        <div class="col-xl-3 col-md-6 mb-4 position-relative">
            <a href="#" class="card-link">
                <!-- Verified / Unverified Ping -->
                <div class="ping-dot {{ $store->verified ? 'dot-success' : 'dot-danger' }}"></div>

                <div class="card border-left-primary shadow h-100">
                    <!-- Shop Image -->
                    <img src="{{ $store->image_1 ? asset('storage/' . $store->image_1) : 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800' }}" 
                         class="card-img-top" 
                         style="height:160px; object-fit:cover;">

                    <div class="card-body py-3">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            {{ $store->store_name }}
                        </div>
                        <div class="h6 mb-0 text-gray-800">
                            {{ $store->state }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>



@endsection
