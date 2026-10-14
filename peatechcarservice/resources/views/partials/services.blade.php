<div class="container-xxl service py-5">
    <div class="container">
        <div class="text-center">
            <h6 class="text-primary text-uppercase"> Our Services </h6>
            <h1 class="mb-5">Explore Our Services</h1>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="nav w-100 nav-pills me-4">
                    <button class="nav-link active w-100 d-flex align-items-center text-start p-4 mb-4"
                        data-bs-toggle="pill" data-bs-target="#tab-pane-1">
                        <i class="fa fa-car-side fa-2x me-3"></i>
                        <h4 class="m-0">Nearby Mechanics</h4>
                    </button>

                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4"
                        data-bs-toggle="pill" data-bs-target="#tab-pane-2">
                        <i class="fa fa-tools fa-2x me-3"></i>
                        <h4 class="m-0">Engine Diagnostics</h4>
                    </button>

                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4"
                        data-bs-toggle="pill" data-bs-target="#tab-pane-3">
                        <i class="fa fa-cog fa-2x me-3"></i>
                        <h4 class="m-0">Tire & Wheel Services</h4>
                    </button>

                    <button class="nav-link w-100 d-flex align-items-center text-start p-4"
                        data-bs-toggle="pill" data-bs-target="#tab-pane-4">
                        <i class="fa fa-oil-can fa-2x me-3"></i>
                        <h4 class="m-0">Oil & Fluid Checks</h4>
                    </button>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="tab-content w-100">

                    {{-- TAB 1 --}}
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        @include('partials.service-tab', [
                            'image' => 'img/service-1.jpg',
                            'title' => 'Find Mechanics Around You',
                            'text' =>
                                'Find certified and verified car mechanics closest to your location instantly.',
                        ])
                    </div>

                    {{-- TAB 2 --}}
                    <div class="tab-pane fade" id="tab-pane-2">
                        @include('partials.service-tab', [
                            'image' => 'img/service-2.jpg',
                            'title' => 'Advanced Engine Diagnostics',
                            'text' =>
                                'Get quick engine checks and error code interpretations from experts.',
                        ])
                    </div>

                    {{-- TAB 3 --}}
                    <div class="tab-pane fade" id="tab-pane-3">
                        @include('partials.service-tab', [
                            'image' => 'img/service-3.jpg',
                            'title' => 'Tire Repairs & Replacement',
                            'text' =>
                                'Locate tire technicians and shops for fast repairs and wheel balancing.',
                        ])
                    </div>

                    {{-- TAB 4 --}}
                    <div class="tab-pane fade" id="tab-pane-4">
                        @include('partials.service-tab', [
                            'image' => 'img/service-4.jpg',
                            'title' => 'Oil & Fluid Servicing',
                            'text' =>
                                'Find specialists to handle oil changes and basic fluid maintenance.',
                        ])
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
