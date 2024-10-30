{{-- resources/views/components/news-slider.blade.php --}}

<div class="bg-pink-100 py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="inline-block bg-indigo-800 text-white px-8 py-3 rounded-full text-xl font-bold">
                TERBARU DI NEW PRIMAGAMA
            </h2>
        </div>

        <!-- Slider main container -->
        <div class="swiper-container relative">
            <!-- Additional required wrapper -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide p-2">
                        <img src="{{ asset('images/mega-tryout.jpg') }}" 
                             alt="Mega Try Out" 
                             class="w-full rounded-2xl shadow-lg">
                    </div>
                    <div class="swiper-slide p-2">
                        <img src="{{ asset('images/reservasi.jpg') }}" 
                             alt="Reservasi Kelas Baru" 
                             class="w-full rounded-2xl shadow-lg">
                    </div>
                    <div class="swiper-slide p-2">
                        <img src="{{ asset('images/oktober.jpg') }}" 
                             alt="Oktober Untung" 
                             class="w-full rounded-2xl shadow-lg">
                    </div>
                </div>
            </div>

            <!-- Navigation buttons -->
            <button class="swiper-button-prev !absolute !left-0 top-1/2 -translate-y-1/2 -translate-x-6 !w-10 !h-10 rounded-full bg-yellow-400 shadow-lg after:!text-lg after:!text-black">
            </button>
            <button class="swiper-button-next !absolute !right-0 top-1/2 -translate-y-1/2 translate-x-6 !w-10 !h-10 rounded-full bg-yellow-400 shadow-lg after:!text-lg after:!text-black">
            </button>
        </div>
    </div>
</div>

{{-- Add this in your layout file or view where you want to use the slider --}}
@push('styles')
<style>
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 1.2rem !important;
        font-weight: bold;
        color: #000;
    }
    
    .swiper-button-next.swiper-button-disabled,
    .swiper-button-prev.swiper-button-disabled {
        opacity: 0.35;
        pointer-events: none;
    }

    .swiper-container {
        padding: 0 50px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper', {
            // Enable loop
            loop: true,
            
            // Space between slides
            spaceBetween: 20,
            
            // Slides per view
            slidesPerView: 1,
            
            // Centered slides
            centeredSlides: true,
            
            // Auto play
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            
            // Breakpoints for responsive design
            breakpoints: {
                // when window width is >= 640px
                640: {
                    slidesPerView: 2,
                    centeredSlides: false,
                },
                // when window width is >= 1024px
                1024: {
                    slidesPerView: 3,
                    centeredSlides: false,
                }
            },
            
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endpush