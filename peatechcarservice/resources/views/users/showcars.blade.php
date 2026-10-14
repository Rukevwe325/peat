@extends('users.layout')

@section('title', 'Cars for Sale')

@section('content')

<!-- Hero Marquee -->
<div class="marquee-container bg-dark text-white py-2">
    <div class="marquee">
        <span>🚗 PREMIUM VEHICLES • BEST DEALS • CERTIFIED CARS • FLEXIBLE PAYMENT • FREE INSPECTION • TRUSTED DEALERS • </span>
        <span>🚗 PREMIUM VEHICLES • BEST DEALS • CERTIFIED CARS • FLEXIBLE PAYMENT • FREE INSPECTION • TRUSTED DEALERS • </span>
    </div>
</div>

<div class="container py-5">

    <div class="row">

        <!-- LEFT: Image Gallery -->
        <div class="col-lg-7 mb-4 mb-lg-0">
            
            <!-- Main Image Display -->
            <div class="main-image-wrapper mb-3 position-relative">
                <div class="badge-overlay">
                    <span class="badge badge-danger px-3 py-2">HOT DEAL 🔥</span>
                </div>
                <img 
                    id="mainImage"
                    src="{{ $car->image_1 
                        ? asset('storage/' . $car->image_1) 
                        : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800' }}"
                    class="img-fluid rounded shadow-lg main-car-image"
                    alt="{{ $car->name }}"
                >
            </div>

            <!-- Scrollable Thumbnail Gallery -->
            <div class="thumbnail-scroll-wrapper">
                <button class="scroll-btn scroll-left" onclick="scrollThumbnails('left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <div class="thumbnail-container" id="thumbnailContainer">
                    @php
                        $images = ['image_1', 'image_2', 'image_3'];
                        $availableImages = [];
                        foreach($images as $img) {
                            if($car->$img) {
                                $availableImages[] = asset('storage/'.$car->$img);
                            }
                        }
                        if(empty($availableImages)) {
                            $availableImages[] = 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800';
                        }
                    @endphp

                    @foreach($availableImages as $index => $imgSrc)
                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                             onclick="changeMainImage('{{ $imgSrc }}', this)">
                            <img src="{{ $imgSrc }}" alt="Car view {{ $index + 1 }}">
                            <div class="thumbnail-overlay"></div>
                        </div>
                    @endforeach
                </div>

                <button class="scroll-btn scroll-right" onclick="scrollThumbnails('right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Features Marquee -->
            <div class="features-marquee mt-4">
                <div class="marquee-features">
                    <span>✓ Verified Dealer</span>
                    <span>✓ 30-Day Warranty</span>
                    <span>✓ Test Drive Available</span>
                    <span>✓ Financing Options</span>
                    <span>✓ Trade-In Accepted</span>
                    <span>✓ Verified Dealer</span>
                    <span>✓ 30-Day Warranty</span>
                    <span>✓ Test Drive Available</span>
                </div>
            </div>

        </div>

        <!-- RIGHT: Details -->
        <div class="col-lg-5">

            <div class="details-card p-4 shadow-lg rounded">
                
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h2 class="car-title mb-0">{{ $car->name }}</h2>
                    <button class="btn btn-link text-danger p-0" title="Add to favorites">
                        <i class="far fa-heart fa-2x"></i>
                    </button>
                </div>
                
                <div class="mb-3">
                    <span class="badge badge-gradient-blue mr-2 px-3 py-2">{{ $car->model }}</span>
                    <span class="badge badge-gradient-purple px-3 py-2">{{ $car->year }}</span>
                </div>

                <div class="price-section mb-4">
                    <h3 class="price-tag mb-0">
                        ₦{{ number_format($car->price) }}
                    </h3>
                    <small class="text-muted">Negotiable price</small>
                </div>

                <hr class="divider">

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="section-title">
                        <i class="fas fa-info-circle mr-2"></i>Description
                    </h5>
                    <p class="description-text">
                        {{ $car->description ?? 'This stunning vehicle offers exceptional performance, comfort, and style. Perfect for both city driving and long journeys.' }}
                    </p>
                </div>

                <!-- Specs Grid -->
                <div class="mb-4">
                    <h5 class="section-title">
                        <i class="fas fa-cog mr-2"></i>Specifications
                    </h5>
                    <div class="specs-grid">
                        <div class="spec-item">
                            <div class="spec-icon">🛣️</div>
                            <div class="spec-details">
                                <small>Mileage</small>
                                <strong>{{ $car->mileage ?? 'N/A' }}</strong>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">⚙️</div>
                            <div class="spec-details">
                                <small>Transmission</small>
                                <strong>{{ $car->transmission ?? 'N/A' }}</strong>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">⛽</div>
                            <div class="spec-details">
                                <small>Fuel Type</small>
                                <strong>{{ $car->fuel_type ?? 'N/A' }}</strong>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">🎨</div>
                            <div class="spec-details">
                                <small>Color</small>
                                <strong>{{ $car->color ?? 'N/A' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('cars.purchase', $car->id) }}"
                    class="btn btn-primary-gradient btn-lg btn-block mb-3 pulse-btn">
                        <i class="fas fa-calendar-check mr-2"></i>Purchase
                    </a>


                    <a href="#" class="btn btn-outline-dark btn-lg btn-block">
                        <i class="fas fa-phone mr-2"></i>Contact Seller
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="trust-section mt-4 pt-4 border-top">
                    <div class="d-flex justify-content-around text-center">
                        <div>
                            <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                            <small class="d-block">Verified</small>
                        </div>
                        <div>
                            <i class="fas fa-certificate fa-2x text-primary mb-2"></i>
                            <small class="d-block">Certified</small>
                        </div>
                        <div>
                            <i class="fas fa-star fa-2x text-warning mb-2"></i>
                            <small class="d-block">Top Rated</small>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<style>
/* Marquee Animation */
.marquee-container {
    overflow: hidden;
    white-space: nowrap;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.marquee {
    display: inline-block;
    animation: scroll 20s linear infinite;
    font-weight: 600;
    letter-spacing: 1px;
}

@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Main Image */
.main-image-wrapper {
    overflow: hidden;
    border-radius: 15px;
}

.badge-overlay {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 10;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.main-car-image {
    width: 100%;
    height: 450px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.main-car-image:hover {
    transform: scale(1.02);
}

/* Thumbnail Scroll Section */
.thumbnail-scroll-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
}

.thumbnail-container {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px 0;
    flex: 1;
    scrollbar-width: none;
}

.thumbnail-container::-webkit-scrollbar {
    display: none;
}

.thumbnail-item {
    position: relative;
    flex-shrink: 0;
    width: 120px;
    height: 90px;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.thumbnail-item:hover .thumbnail-overlay,
.thumbnail-item.active .thumbnail-overlay {
    background: rgba(0,0,0,0);
}

.thumbnail-item.active {
    border-color: #007bff;
    box-shadow: 0 5px 15px rgba(0,123,255,0.4);
}

.scroll-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.scroll-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
}

/* Features Marquee */
.features-marquee {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 12px 0;
    border-radius: 10px;
    overflow: hidden;
}

.marquee-features {
    display: flex;
    gap: 40px;
    color: white;
    font-weight: 600;
    animation: scroll 15s linear infinite;
    white-space: nowrap;
}

/* Details Card */
.details-card {
    background: white;
    border: 1px solid #e0e0e0;
    position: sticky;
    top: 20px;
}

.car-title {
    font-size: 1.8rem;
    font-weight: 800;
    color: #2d3748;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.badge-gradient-blue {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
}

.badge-gradient-purple {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
}

.price-section {
    background: linear-gradient(135deg, #f6f8fb 0%, #e9ecef 100%);
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.price-tag {
    font-size: 2.5rem;
    font-weight: 900;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.divider {
    border-top: 2px solid #e0e0e0;
    margin: 1.5rem 0;
}

.section-title {
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1rem;
}

.description-text {
    color: #4a5568;
    line-height: 1.7;
}

/* Specs Grid */
.specs-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f7fafc;
    padding: 15px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.spec-item:hover {
    background: #edf2f7;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.spec-icon {
    font-size: 1.8rem;
}

.spec-details small {
    display: block;
    color: #718096;
    font-size: 0.75rem;
    margin-bottom: 3px;
}

.spec-details strong {
    color: #2d3748;
    font-size: 0.95rem;
}

/* Action Buttons */
.btn-primary-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    font-weight: 700;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.pulse-btn {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
    100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
}

.btn-outline-dark {
    border: 2px solid #2d3748;
    color: #2d3748;
    font-weight: 700;
    transition: all 0.3s ease;
}

.btn-outline-dark:hover {
    background: #2d3748;
    color: white;
    transform: translateY(-2px);
}

/* Trust Section */
.trust-section i {
    transition: transform 0.3s ease;
}

.trust-section > div > div:hover i {
    transform: scale(1.2);
}

/* Responsive */
@media (max-width: 768px) {
    .car-title {
        font-size: 1.4rem;
    }
    
    .price-tag {
        font-size: 2rem;
    }
    
    .main-car-image {
        height: 300px;
    }
    
    .specs-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function changeMainImage(src, element) {
    document.getElementById('mainImage').src = src;
    
    // Remove active class from all thumbnails
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Add active class to clicked thumbnail
    element.classList.add('active');
}

function scrollThumbnails(direction) {
    const container = document.getElementById('thumbnailContainer');
    const scrollAmount = 150;
    
    if (direction === 'left') {
        container.scrollLeft -= scrollAmount;
    } else {
        container.scrollLeft += scrollAmount;
    }
}
</script>

@endsection