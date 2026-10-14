@extends('layouts.app')

@section('title')
    Cars for Sale | Peamech Car Service
@endsection

@section('content')

<div class="container py-5">
    <div class="row">

        @foreach ($cars as $car)
            <div class="col-md-4 mb-4">
                <a href="#" data-bs-toggle="modal" data-bs-target="#accountModal" class="text-decoration-none">

                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('storage/' . $car->image_1) }}" 
                             class="card-img-top" 
                             alt="{{ $car->name }}">

                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $car->name }}</h5>
                            <p class="card-text text-muted mb-1">
                                Model: {{ $car->model }} | Year: {{ $car->year }}
                            </p>
                            <p class="card-text text-muted mb-1">
                                Price: ₦{{ number_format($car->price) }}
                            </p>
                            <p class="card-text text-truncate">
                                {{ $car->description }}
                            </p>
                        </div>
                    </div>

                </a>
            </div>
        @endforeach

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="accountModalLabel">Create an Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        You need to create an account to view this car’s details.
      </div>

      <div class="modal-footer">
        <a href="{{ url('/userregister') }}" class="btn btn-primary">Create Account</a>
      </div>

    </div>
  </div>
</div>

@endsection
