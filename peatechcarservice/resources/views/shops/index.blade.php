@extends('layouts.app')

@section('title', 'Home | Peamech Car Service')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-white">Workshops Near You</h2>

    <div id="status" class="status">
        Detecting your location…
    </div>

    <div id="shops"></div>
</div>

<!-- Page-specific styles -->
<style>
    body {
        font-family: Inter, sans-serif;
        background: #0f2027;
        color: #fff;
    }

    .shop-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: rgba(30, 41, 59, 0.8);
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid rgba(255,255,255,0.1);
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .shop-card.show {
        opacity: 1;
        transform: translateY(0);
    }

    .shop-photo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #00fff7;
    }

    .shop-info {
        flex: 1;
    }

    .shop-name {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .shop-address {
        font-size: 0.9rem;
        opacity: 0.85;
        margin-top: 0.25rem;
    }

    .shop-distance {
        font-size: 0.8rem;
        color: #00fff7;
        margin-top: 0.5rem;
    }

    .status {
        text-align: center;
        opacity: 0.8;
        margin-top: 2rem;
    }
</style>

<!-- Page-specific JS -->
<script>
const statusEl = document.getElementById('status');
const shopsEl = document.getElementById('shops');

if (!navigator.geolocation) {
    statusEl.textContent = 'Geolocation is not supported by your browser.';
} else {
    navigator.geolocation.getCurrentPosition(
        position => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            statusEl.textContent = 'Finding workshops near you…';

            fetch(`/shops/nearby?latitude=${lat}&longitude=${lng}`)
                .then(res => res.json())
                .then(data => {
                    statusEl.remove();

                    if (data.count === 0) {
                        shopsEl.innerHTML = '<p>No workshops found near you.</p>';
                        return;
                    }

                    data.data.forEach((shop, index) => {
                        const card = document.createElement('div');
                        card.className = 'shop-card';

                        // Make card clickable
                        card.innerHTML = `
                            <a href="/shops/${shop.id}" style="display:flex; align-items:center; gap:1rem; text-decoration:none; color:inherit;">
                                <img src="${shop.profile_photo ? '/storage/' + shop.profile_photo : 'https://via.placeholder.com/60'}" 
                                     alt="Profile" class="shop-photo">
                                <div class="shop-info">
                                    <div class="shop-name">
                                        ${shop.first_name} ${shop.last_name}
                                    </div>
                                    <div class="shop-address">
                                        ${shop.address ?? 'Address not provided'}
                                    </div>
                                    <div class="shop-distance">
                                        ${shop.distance.toFixed(2)} km away
                                    </div>
                                </div>
                            </a>
                        `;

                        shopsEl.appendChild(card);

                        // Animate with stagger
                        setTimeout(() => {
                            card.classList.add('show');
                        }, index * 150); // 150ms delay per card
                    });
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    statusEl.textContent = 'Failed to load nearby workshops.';
                });
        },
        () => {
            statusEl.textContent = 'Location access denied. Please enable location.';
        }
    );
}
</script>

@endsection
