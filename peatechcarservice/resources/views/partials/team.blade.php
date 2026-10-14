<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">Our Top Mechanics</h6>
            <h1 class="mb-5">Meet Trusted Professionals</h1>
        </div>

        <div class="row g-4">

            @foreach ([
                ['img/team-1.jpg', 'John Williams', 'Engine Specialist'],
                ['img/team-2.jpg', 'Grace Okafor', 'Tire Technician'],
                ['img/team-3.jpg', 'Daniel Ibrahim', 'Diagnostic Expert'],
                ['img/team-4.jpg', 'Mary Johnson', 'General Mechanic']
            ] as [$img, $name, $role])

            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="team-item text-center rounded p-4">
                    <img class="img-fluid rounded mb-3" src="{{ $img }}" alt="">
                    <h5>{{ $name }}</h5>
                    <span class="text-primary">{{ $role }}</span>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>
