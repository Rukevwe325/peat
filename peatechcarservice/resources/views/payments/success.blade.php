@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container py-5 text-center">
    <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
    <h2>Payment Successful 🎉</h2>

    <p class="text-muted mt-3">
        Your car purchase was completed successfully.
    </p>

    <p class="text-muted">
        Please check your email for payment confirmation and purchase details.
    </p>

    {{-- 
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">
        Go Home
    </a> 
    --}}
</div>
@endsection
