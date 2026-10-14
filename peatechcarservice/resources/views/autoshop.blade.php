@extends('layouts.app')

@section('title')
    Auto Shops Nearby | Peamech Car Service
@endsection

@section('content')

<style>
    .shop-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .shop-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
    }

    .shop-img {
        height: 180px;
        object-fit: cover;
        border-bottom: 1px solid #eee;
    }

    .shop-state {
        font-size: 12px;
        background: #eef2ff;
        color: #3b4cca;
        padding: 3px 10px;
        border-radius: 50px;
        display: inline-block;
    }
</style>

<div class="container py-5">
    <h2 class="mb-4 fw-bold">Nearby Auto Shops</h2>

    <div class="row g-4">

        @foreach ($stores as $store)
            <div class="col-md-4">
                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#accountModal">

                    <div class="card shop-card shadow-sm">
                        <img src="{{ asset('storage/' . $store->image_1) }}"
                             class="shop-img w-100"
                             alt="{{ $store->store_name }}">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title text-dark fw-semibold mb-0">
                                    {{ $store->store_name }}
                                </h5>
                                <span class="shop-state">
                                    {{ $store->state }}
                                </span>
                            </div>

                            <p class="text-muted mb-2" style="font-size: 14px;">
                                {{ $store->store_address }}
                            </p>

                            <div class="text-primary fw-semibold" style="font-size: 13px;">
                                View Details →
                            </div>

                        </div>
                    </div>

                </a>
            </div>
        @endforeach

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-sm">

      <div class="modal-header">
        <h5 class="modal-title fw-bold">Create an Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        You need to create an account to view this auto shop’s details.
      </div>

      <div class="modal-footer">
        <a href="{{ url('/userregister') }}" class="btn btn-primary px-4">Create Account</a>
      </div>

    </div>
  </div>
</div>

@endsection
