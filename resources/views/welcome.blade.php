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

    <!-- Main title font type -->
    <style>
        .font-cinzel {
            font-family: 'Cinzel Decorative', serif;
            letter-spacing: 1px;
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
    <style>
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
    </style>

    <!-- Smooth Scroll CSS -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        .scrollable-background {
            background-image: url('{{ asset('storage/profile_pictures/bg (2).png') }}');
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
                    margin: 0 auto;
                    position: relative;
                    }
                    .slideshow {
                        position: relative;
                        width: 60%;
                        margin: auto;
                        &:after {
                            content: '';
                            display: block;
                            padding-bottom: calc((100% / 6) * 4);
                        }
                        &:hover a {
                            opacity: 1;
                        }
                        a {
                        opacity: 0;
                        position: relative;
                        text-decoration: none;
                        transition: opacity 0.5s;
                    
                        &:after {
                            border-color: #FFF #FFF transparent transparent; /* Default color */
                            border-style: solid;
                            border-width: 2px;
                            display: block;
                            height: 10px;
                            position: absolute;
                            top: calc(50% - 5px);
                            width: 10px;
                            content: ''; /* Ensure content is set */
                        }
                    
                        &:first-child:after {
                            border-color: orange orange transparent transparent; /* Change arrow to red */
                            left: 10px;
                            transform: rotate(-135deg);
                        }
                    
                        &:nth-child(2):after {
                            border-color: orange orange transparent transparent; /* Keep next arrow white */
                            right: 10px;
                            transform: rotate(45deg);
                        }
                    }
                    
                        .slide {
                            background-color: #FFF;
                            box-sizing: border-box;
                            display: none;
                            height: 100%;
                            position: absolute;
                            width: 100%;
                            &:first-child,
                            &:target {
                                display: block;
                            }
                            a {
                                display: block;
                                height: 100%;
                                position: absolute;
                                width: 50%;
                                &:nth-child(2) {
                                    left: 50%;
                                }
                            }
                            img {
                                border-radius: 5px;
                                width: 100%;
                            }
                        }
                    }
                    .pagination {
                    display: flex;
                    bottom: 10px;
                    justify-content: center;
                    position: absolute;
                    width: 100%;
                    a {
                        background: orange;
                        border-radius: 50%;
                        display: block;
                        height: 10px;
                        width: 10px;
                        &:not(:last-child) {
                        margin-right: 5px;
                        }
                        span {
                        display: none;
                        }
                    }
                    }
                    
                    a:target {
                        color: yellow;
                        background: orange;
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
        <a href="{{ url('/') }}" class="text-2xl font-bold text-black ml-2 font-cinzel">Childminder Booking Service</a>

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
    <header id="hero" class="relative w-full min-h-screen text-white overflow-y-auto">
        <div class="relative z-10 text-center px-6 py-24">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight" data-aos="fade-up">Find the Perfect Childminder</h1>
            <p class="text-lg mt-4 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">Book trusted and professional childminders for your little ones with ease.</p>
            <button class="mt-6 mb-8 px-10 py-4 text-lg bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 text-white font-semibold rounded-lg shadow-lg hover:from-orange-500 hover:via-orange-600 hover:to-orange-700 transition duration-300">
                <a href="{{ route('register') }}">Let's register an account!</a>
            </button>

            <!-- <div class="scroll-container">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
                <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted" class="mx-auto mb-8">
            </div> -->

            <br>

            <div class="container">
                <div class="slideshow">
                    <div id="slide-1" class="slide">
                        <a href="#slide-4"></a>
                        <a href="#slide-2"></a>
                        <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted">
                    </div>
                    <div id="slide-2" class="slide">
                        <a href="#slide-1"></a>
                        <a href="#slide-3"></a>
                        <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted">
                    </div>
                    <div id="slide-3" class="slide">
                        <a href="#slide-2"></a>
                        <a href="#slide-4"></a>
                        <img src="{{ asset('storage/profile_pictures/GSDQ5jkGJnxd0C4j1kifofOlwYdtmTOvZNKMmLBx.png') }}" alt="Safe & Trusted">
                    </div>
                    <div id="slide-4" class="slide">
                        <a href="#slide-3"></a>
                        <a href="#slide-1"></a>
                        <img src="{{ asset('storage/profile_pictures/img1.png') }}" alt="Safe & Trusted">
                    </div>
                </div>
            <div class="pagination">
                <a href="#slide-1"><span>1</span></a>
                <a href="#slide-2"><span>2</span></a>
                <a href="#slide-3"><span>3</span></a>
                <a href="#slide-4"><span>4</span></a>
            </div>
            </div>
    </header>

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
                    <img src="https://via.placeholder.com/100" alt="Childcare Services" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Childcare Services</h3>
                    <p class="text-gray-500 mt-2">Professional care and attention for your children while you're away.</p>
                </div>

                <!-- Special Care -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                    <img src="https://via.placeholder.com/100" alt="Special Care" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Special Care</h3>
                    <p class="text-gray-500 mt-2">Tailored care for children with special needs and requirements.</p>
                </div>

                <!-- Meal Preparation -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                    <img src="https://via.placeholder.com/100" alt="Meal Preparation" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Meal Preparation</h3>
                    <p class="text-gray-500 mt-2">Healthy and nutritious meals prepared for your children.</p>
                </div>

                <!-- Transportation (Pick-up and Drop-off Services) -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                    <img src="https://via.placeholder.com/100" alt="Transportation" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Transportation</h3>
                    <p class="text-gray-500 mt-2">Pick-up and drop-off services for school and extracurricular activities.</p>
                </div>

                <!-- Educational and Developmental Support -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                    <img src="https://via.placeholder.com/100" alt="Educational Support" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Educational and Developmental Support</h3>
                    <p class="text-gray-500 mt-2">Helping children grow academically and socially with personalized support.</p>
                </div>

                <!-- Sleep and Routine Support -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                    <img src="https://via.placeholder.com/100" alt="Sleep Support" class="mx-auto mb-4">
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
                <img src="{{ asset('storage/profile_pictures/trust.jpg') }}" alt="Safe & Trusted" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-700">Safe & Trusted</h3>
                <p class="text-gray-500 mt-2">All our childminders are verified and background checked.</p>
            </div>

            <!-- Flexible Booking Service -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                <img src="https://via.placeholder.com/100" alt="Flexible" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-700">Flexible Booking</h3>
                <p class="text-gray-500 mt-2">Book anytime that suits your schedule.</p>
            </div>

            <!-- 24/7 Support Service -->
            <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition duration-300">
                <img src="https://via.placeholder.com/100" alt="Support" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-700">24/7 Support</h3>
                <p class="text-gray-500 mt-2">Our team is available to assist you round the clock.</p>
            </div>
        </div>
    </section>
    </div>
    <!-- Footer -->
    <footer id="contact" class="bg-[#FF7F50] text-white py-6 relative z-20">
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

</body>

</html>
