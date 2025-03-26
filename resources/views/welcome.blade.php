<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="ngrok-skip-browser-warning" content="true">

    <title>Childminder Booking Service</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- wayv line to separate the content and footer-->
    <style>
        .wavy-line {
                position: relative;
                width: 100%;
                height: 5px; /* Thickness of the wavy line */
                background: repeating-linear-gradient(
                        -45deg,
                        orange 0px, orangered 3px,
                        transparent 3px, transparent 6px
                    ); /* Creates a wavy effect */
                    z-index: 1; /* Ensure the wave is below the dropdown */
            }
    </style>

    <!-- Main title font type -->
    <style>
        .font-cinzel {
            font-family: 'Cinzel Decorative', serif;
            letter-spacing: 1px;
            position: relative;
            padding-top: 10px; /* Space for the top underline */
            padding-bottom: 10px; /* Space for the bottom underline */
            display: inline-block;
            
            /* Gradient Text */
            background: linear-gradient(90deg, blue, red);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* .font-cinzel::before,
        .font-cinzel::after {
            content: "";
            position: absolute;
            left: 0;
            width: 100%;
            height: 5px; 
            background: repeating-linear-gradient(
                -45deg,
                orange 0px, orangered 3px,
                transparent 3px, transparent 6px
            ); 
        } */

        .font-cinzel::before {
            top: 0; /* Position at the top */
        }

        .font-cinzel::after {
            bottom: 0; /* Position at the bottom */
        }



    </style>


    <!-- Gradient Text Style -->
    <style>
        .gradient-text {
            font-size: 3.8rem;
            font-weight: 800;
            text-align: left;
            background: linear-gradient(to right,rgb(237, 205, 193),rgb(252, 158, 18));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>


    <!-- Scrollable Image Gallery -->
    <!-- <style>
        .scroll-container {
            background-color: rgba(51, 51, 51, 0.5);
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
            max-width: 100%;
            display: flex;
            gap: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .scroll-container img {
            max-width: 55%;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .scroll-container img:hover {
            transform: scale(1.1);
            opacity: 0.9;
        }

        .scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background-color: #FF7A00;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .scroll-container::-webkit-scrollbar-thumb:hover {
            background-color: #FF4D00;
        }

        .scroll-container::-webkit-scrollbar-track {
            background-color: #222;
            border-radius: 10px;
        }

        .scroll-container {
            scroll-behavior: smooth;
        }
    </style> -->

    <!-- Smooth Scroll CSS -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Set up the background with proper image */
    .scrollable-background {
        background-image: url("{{ asset('storage/profile_pictures/bg (2).png') }}");
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>

    <!--image scoller (i use this one )-->
    <style>
    .container {
        border-radius: 5px;
        margin: 10px auto;
        position: relative;
        background-color: transparent;
        height: 450px; /* Set a smaller height for the container */
    }

    .slideshow {
        position: relative;
        width: 60%;
        margin: auto;
    }

    .slideshow:after {
        content: '';
        display: block;
        padding-bottom: calc((100% / 6) * 4);
    }

    .slideshow:hover a {
        opacity: 1;
    }

    .slideshow a {
        opacity: 0;
        position: relative;
        text-decoration: none;
        transition: opacity 0.5s;
        font-weight: bolder; /* Increase the boldness */
    }

    .slideshow a:after {
        border-color: #FFF #FFF transparent transparent;
        border-style: solid;
        border-width: 4px; /* Increase border width to make the arrow bigger */
        display: block;
        height: 20px; /* Make the arrow taller */
        position: absolute;
        top: calc(50% - 10px);
        width: 20px; /* Make the arrow wider */
        content: '';
    }

    .slideshow a:first-child:after {
        border-color: white white transparent transparent;
        left: 10px;
        transform: rotate(-135deg);
    }

    .slideshow a:nth-child(2):after {
        border-color: white white transparent transparent;
        right: 10px;
        transform: rotate(45deg);
    }

    .slide {
        background-color: transparent;
        box-sizing: border-box;
        display: none;
        height: 100%;
        position: absolute;
        width: 100%;
    }

    .slide:first-child,
    .slide:target {
        display: block;
    }

    .slide a {
        display: block;
        height: 55%;
        position: absolute;
        width: 50%;
    }

    .slide a:nth-child(2) {
        left: 50%;
    }

    .slide img {
        border-radius: 5px;
        width: 100%;
        padding-left: 50px; /* Increased left padding */
        padding-right: 50px; /* Increased right padding */
        background-color: transparent; /* Ensure the image has a transparent background */
        padding-top:0px;
        padding-bottom: 0px;/*Removed any bottom padding */
    }

    .pagination {
        display: flex;
        bottom: 6px;
        justify-content: center;
        position: absolute;
        width: 100%;
    }

    .pagination a {
        background: white;
        border-radius: 50%;
        display: block;
        height: 10px;
        width: 10px;
    }

    .pagination a:not(:last-child) {
        margin-right: 5px;
    }

    .pagination a span {
        display: none;
    }

    a:target {
        color: yellow;
        background: white;
    }
</style>


</head>

<body class="bg-gray-100 text-gray-900 font-sans scrollable-background relative">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black opacity-40 z-10"></div>

    <!-- Page Content -->
    <div class="relative z-20">
    <!-- Navbar -->
    <nav class="bg-[rgba(245,245,220,0.6)] rounded-full shadow-md fixed top-0 left-0 z-50 backdrop-blur-md mt-4 ml-4 mr-24 w-[98%]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-black ml-2 font-cinzel">💫Childminder Service</a>

            <div class="hidden md:flex space-x-6 pl-6">
                <a href="{{ url('/') }}" class="hover:text-indigo-600 transition duration-300">Home</a>
                <a href="{{ url('/search') }}" class="hover:text-indigo-600 transition duration-300">Search</a>
                <a href="{{ url('/about') }}" class="hover:text-indigo-600 transition duration-300">About</a>
                <a href="{{ url(path: '/contact') }}" class="hover:text-indigo-600 transition duration-300">Contact</a>
            </div>

            @if (Route::has('login'))
                <div class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>



    <!-- Hero Section -->
    <header id="hero" class="relative w-full "></header>
    <section>
        <div class="relative z-10 text-center px-6 py-24">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight pt-10" data-aos="fade-up">
             Find the Perfect Childminder
        </h1>

            <p class="text-lg mt-4 max-w-2xl mx-auto text-white
            " data-aos="fade-up" data-aos-delay="300">Book trusted and professional childminders for your little ones with ease.</p>
            <button class="mt-6 mb-8 px-10 py-4 text-lg bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 text-white font-semibold rounded-lg shadow-lg hover:from-orange-500 hover:via-orange-600 hover:to-orange-700 transition duration-300">
                <a href="{{ route('register') }}">Let's register an account!</a>
            </button>
        </div>
    </section>
            <!-- <div class="scroll-container">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
            </div> -->

            <section>
            <div class="container">
                <div class="slideshow">
                    <div id="slide-1" class="slide">
                        <a href="#slide-4"></a>
                        <a href="#slide-2"></a>
                        <img src="{{ asset('storage/showing/img-register.png') }}" alt="Safe & Trusted">
                    </div>
                    <div id="slide-2" class="slide">
                        <a href="#slide-1"></a>
                        <a href="#slide-3"></a>
                        <img src="{{ asset('storage/showing/img-dashboard.png') }}" alt="Dashboard">
                    </div>
                    <div id="slide-3" class="slide">
                        <a href="#slide-2"></a>
                        <a href="#slide-4"></a>
                        <img src="{{ asset('storage/showing/img-filter.png') }}" alt="Filter">
                    </div>
                    <div id="slide-4" class="slide">
                        <a href="#slide-3"></a>
                        <a href="#slide-1"></a>
                        <img src="{{ asset('storage/showing/img-map.png') }}" alt="Safe & Trusted">
                    </div>
                </div>
                <div class="pagination">
                <a href="#slide-1"><span>1</span></a>
                <a href="#slide-2"><span>2</span></a>
                <a href="#slide-3"><span>3</span></a>
                <a href="#slide-4"><span>4</span></a>
            </div>

            </div>
            </section>

            <!-- Services Section -->
            <section id="services" class="max-w-7xl mx-auto px-6 py-16" data-aos="fade-up">
                <div class="flex items-center justify-between">
                    <!-- Left Side: "Our Services" Text -->
                    <div class="w-full md:w-1/2 text-center">
                        <h2 class="gradient-text text-center">Our Services</h2>
                    </div>

                    <!-- Right Side: Service Cards -->
                    <div class="w-full md:w-1/2 grid md:grid-cols-3 gap-8 mt-10">
                        <!-- Childcare Services -->
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/showing/img-general-service.png') }}" alt="General CHildminder Service" class="mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">General Childcare Services</h3>
                            <p class="text-gray-500 mt-2">Professional care and attention for your children while you're away.</p>
                        </div>

                        <!-- Special Care -->
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/showing/img-special-care.png') }}" alt="Special Care" class="mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Special Care</h3>
                            <p class="text-gray-500 mt-2">Tailored care for children with special needs and requirements.</p>
                        </div>

                        <!-- Meal Preparation -->
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/showing/img-food.png') }}" alt="Meal Preparation" class="mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Meal Preparation</h3>
                            <p class="text-gray-500 mt-2">Healthy and nutritious meals prepared for your children.</p>
                        </div>

                        <!-- Transportation (Pick-up and Drop-off Services) -->
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/showing/img-transportation.png') }}" alt="Pick-up and Drop-off Services" class="mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Transportation</h3>
                            <p class="text-gray-500 mt-2">Pick-up and drop-off services for school and extracurricular activities.</p>
                        </div>

                        <!-- Educational and Developmental Support -->
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/showing/img-education.png') }}" alt="Education and development support" class="mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Educational and Developmental Support</h3>
                            <p class="text-gray-500 mt-2">Helping children grow academically and socially with personalized support.</p>
                        </div>

                        <!-- Sleep and Routine Support -->
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/showing/img-sleep.png') }}" alt="Sleep and Routine Support" class="mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-gray-700">Sleep and Routine Support</h3>
                            <p class="text-gray-500 mt-2">Assisting children in developing healthy sleep and daily routines.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Why Us Section -->
            <section id="why-us" class="max-w-7xl mx-auto px-6 py-16" data-aos="fade-up">
                <h2 class="gradient-text text-center">Why choose us?</h2>
                <div class="grid md:grid-cols-3 gap-8 mt-10">
                    <!-- Safe & Trusted Service -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                        <img src="{{ asset('storage/showing/img-safe-and-trust.png') }}" alt="Safe & Trusted" class="mx-auto mb-4 w-48 h-auto">
                        <h3 class="text-xl font-semibold text-gray-700">Safe & Trusted</h3>
                        <p class="text-gray-500 mt-2">All our childminders are verified and background checked.</p>
                    </div>

                    <!-- Flexible Booking Service -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                        <img src="{{ asset('storage/showing/img-flexible-booking.png') }}" alt="Flexible Booking Service" class="mx-auto mb-4 w-48 h-auto">
                        <h3 class="text-xl font-semibold text-gray-700">Flexible Booking</h3>
                        <p class="text-gray-500 mt-2">Book anytime that suits your schedule.</p>
                    </div>

                    <!-- Mapping function -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                        <img src="{{ asset('storage/showing/img-mapping.png') }}" alt="Mapping Function" class="mx-auto mb-4 w-48 h-auto">
                        <h3 class="text-xl font-semibold text-gray-700">Map Your Route & Travel Time</h3>
                        <p class="text-gray-500 mt-2">Get real-time distances, travel time, and optimized routes to your destination.</p>
                    </div>

                </div>
            </section>
        <div class="wavy-line"></div>
    </div>
    
    <!-- Footer -->
    <footer id="contact" class="bg-[#00CED1] text-white py-6 relative z-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2025 Childminder Booking Service. All Rights Reserved.</p>
            <p>This website is created by @JOANNE CHAN ╰(*°▽°*)╯</p>
        </div>
    </footer>



    <!-- AOS Animation JS -->
        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                once: true
            });
        </script>
    <!--fix the page goes up when i click the arrow button, and fix the pagination clicking -->
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const slides = document.querySelectorAll(".slide");
            const paginationLinks = document.querySelectorAll(".pagination a");

            function resetSlides() {
                slides.forEach(slide => slide.style.display = "none");
            }

            function showSlide(targetId) {
                resetSlides();
                document.querySelector(targetId).style.display = "block";
            }

            // Handle pagination button clicks
            paginationLinks.forEach(link => {
                link.addEventListener("click", function (event) {
                    event.preventDefault();
                    const targetId = this.getAttribute("href");
                    showSlide(targetId);
                });
            });

            // Handle arrow clicks
            document.querySelectorAll(".slideshow a").forEach(arrow => {
                arrow.addEventListener("click", function (event) {
                    event.preventDefault();
                    const targetId = this.getAttribute("href");
                    showSlide(targetId);
                });
            });

            // Initialize first slide as visible
            showSlide("#slide-1");
            });
        </script>


        

</body>

</html>