<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title', 'Home')</title>
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}" />
    <link rel="shortcut icon" href="{{ asset('images/Reverse.png') }}" type="image/x-icon">
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }
        .preloader.fade-out {
            opacity: 0;
        }
        /* HTML: <div class="loader"></div> */
.loader {
  --s: 20px;

  --_d: calc(0.353*var(--s));
  width: calc(var(--s) + var(--_d));
  aspect-ratio: 1;
  display: grid;
}
.loader:before,
.loader:after {
  content: "";
  grid-area: 1/1;
  clip-path: polygon(var(--_d) 0,100% 0,100% calc(100% - var(--_d)),calc(100% - var(--_d)) 100%,0 100%,0 var(--_d));
  background:
    conic-gradient(from -90deg at calc(100% - var(--_d)) var(--_d),
     #fff 135deg,#666 0 270deg,#aaa 0);
  animation: l6 2s infinite;
}
.loader:after {
  animation-delay:-1s;
}
@keyframes l6{
  0%  {transform:translate(0,0)}
  25% {transform:translate(30px,0)}
  50% {transform:translate(30px,30px)}
  75% {transform:translate(0,30px)}
  100%{transform:translate(0,0)}
}

.ulasan-container {
    display: flex;
    overflow-x: auto; /* Allows horizontal scrolling */
    scroll-snap-type: x mandatory; /* For smooth scrolling */
}

.ulasan-item {
    scroll-snap-align: start; /* Aligns the card to the start */
    flex: 0 0 auto; /* Prevents flex-grow */
    width: 250px; /* Set a width for the cards */
    margin-right: 20px; /* Space between cards */
    background-color: white; /* Card background */
    border: 1px solid #ccc; /* Card border */
    border-radius: 8px; /* Rounded corners */
    padding: 16px; /* Padding inside the card */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow effect */
}

.star-rating {
    display: flex;
    justify-content: flex-start;
    margin: 8px 0; /* Space above and below the stars */
}

.star {
    color: lightgray; /* Default color for unfilled stars */
    font-size: 20px; /* Size of the stars */
}

.star.filled {
    color: gold; /* Color for filled stars */
}

    </style>
</head>
<body class="bg-gray-100">
    <div class="preloader">
        <div class="loader"></div>
        
    </div>

    @include('components.navbar')
    
    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div> 

    @include('home.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

    <script>
        $(window).on('load', function() {
            $('.preloader').addClass('fade-out');
            setTimeout(function() {
                $('.preloader').remove();
            }, 500);
        });

        $(document).ready(function() {
            AOS.init({
                duration: 1000,
                once: true,
            });

            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });

            // Back to top button
            var btn = $('<button class="back-to-top bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full fixed bottom-4 right-4 opacity-0 transition-opacity duration-300">↑</button>');
            $('body').append(btn);

            $(window).scroll(function() {
                if ($(window).scrollTop() > 300) {
                    btn.addClass('opacity-100');
                } else {
                    btn.removeClass('opacity-100');
                }
            });

            btn.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop:0}, '300');
            });
        });
    </script>
</body>
</html>