
    <!-- Booking Start -->
    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp d-none" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="text-white mb-4">Certified and Award Winning Car Repair Service Provider</h1>
                        <p class="text-white mb-0">At Peamech Car Service, we combine certified expertise with years of proven excellence. Our award-winning team delivers reliable diagnostics, professional repairs, and exceptional customer care. Whether it's routine maintenance or complex mechanical work, we ensure your vehicle receives top-quality attention. With modern tools, trusted technicians, and a commitment to honesty and precision, we keep your car running safely and smoothly—every time.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                    <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">Book For A Service</h1>
                       {{-- <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data"> --}}
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">

                                <!-- Name -->
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="name" class="form-control border-0" placeholder="Your Name" style="height: 55px;" required>
                                </div>

                                <!-- Email -->
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;" required>
                                </div>

                                <!-- Service -->
                                <div class="col-12 col-sm-6">
                                    <select name="service" class="form-select border-0" style="height: 55px;" required>
                                        <option value="">All Mechanics</option>

                                        @foreach ($admins as $admin)
                                            <option value="{{ $admin->id }}">
                                                {{ $admin->first_name }} {{ $admin->last_name }} {{ $admin->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="notAvailableModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Mechanic Not Available</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        The mechanic is not available at the selected time.
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-primary">Visit Store</a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Choose Another Time</button>
                                    </div>
                                    </div>
                                </div>
                                </div>


                                <!-- Service Date -->
                                <div class="col-12 col-sm-6">
                                    <input type="date" name="service_date" class="form-control border-0" style="height: 55px;" required>
                                </div>

                                <!-- Car Model -->
                                <div class="col-12 col-sm-12">
                                    <select name="car_model" class="form-select border-0" style="height: 55px;" required>
                                        <option value="">Select Car Model</option>
                                        <option>Toyota Camry</option>
                                        <option>Toyota Corolla</option>
                                        <option>Honda Accord</option>
                                        <option>Honda Civic</option>
                                        <option>Mercedes C300</option>
                                        <option>Mercedes E350</option>
                                        <option>BMW 3 Series</option>
                                        <option>BMW 5 Series</option>
                                        <option>Lexus RX350</option>
                                        <option>Lexus ES350</option>
                                        <option>Kia Sportage</option>
                                        <option>Hyundai Sonata</option>
                                        <option>Range Rover Evoque</option>
                                        <option>Range Rover Velar</option>
                                        <option>Ford Explorer</option>
                                        <option>Nissan Altima</option>
                                        <option>Nissan Pathfinder</option>
                                    </select>
                                </div>

                                <!-- Car Photo Upload -->
                                <div class="col-12 col-sm-12">
                                    <div class="custom-file-upload border-0 d-flex flex-column align-items-center p-2 bg-white rounded"
                                        style="height: 55px; cursor: pointer; border: 1px dashed #bbb;"
                                        onclick="document.getElementById('carPhotoInput').click()">
                                        <span id="uploadText" class="text-muted">Upload Car Photo</span>
                                        <input type="file" name="car_photo" id="carPhotoInput" accept="image/*" style="display: none;" onchange="previewCarPhoto(event)">
                                    </div>

                                    <!-- Image Preview -->
                                    <img id="carPhotoPreview" src="" alt=""
                                        class="img-fluid mt-2 d-none rounded"
                                        style="max-height: 150px; object-fit: cover;">
                                </div>

                                <!-- JS Preview -->
                                <script>
                                    function previewCarPhoto(event) {
                                        const file = event.target.files[0];
                                        const preview = document.getElementById("carPhotoPreview");
                                        const uploadText = document.getElementById("uploadText");

                                        if (file) {
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                preview.src = e.target.result;
                                                preview.classList.remove("d-none");
                                                uploadText.innerText = file.name;
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                </script>

                                <!-- Special Request -->
                                <div class="col-12">
                                    <textarea name="special_request" class="form-control border-0" placeholder="Special Request"></textarea>
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Book Now</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->