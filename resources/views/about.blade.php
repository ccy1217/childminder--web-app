<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="ngrok-skip-browser-warning" content="true">

    <title>Childminder About</title>

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
                <a href="{{ url('/#service') }}" class="hover:text-indigo-600 transition duration-300">Services</a>
                <a href="{{ url('/about') }}" class="hover:text-indigo-600 transition duration-300">About</a>
                <a href="{{ url('/contact') }}" class="hover:text-indigo-600 transition duration-300">Contact</a>
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

    <header id="hero" class="relative w-full min-h-[50vh] flex items-center text-white"> 
    <div class="container mx-auto px-4 py-8">
        <div class="text-center">
        <h1 class="text-5xl font-bold text-white">About Us</h1>
        <p class="text-lg text-white mt-2 small-caps">Caring for Your Little Ones Like Our Own</p>
    </div>
    </div>
    </header>

    <div class="grid md:grid-cols-2 gap-8 items-center mt-10">
    <div class="ml-10"> <!-- Added left margin here -->
        <img src="https://images.squarespace-cdn.com/content/v1/59b30dbcf14aa14c97a44114/5d843d20-dc73-4c2f-9785-bb77041aebe1/nanny+vs.+babysitter.jpg?format=2500w" alt="Nanny with children" class="rounded-lg shadow-lg">
    </div>
    <div class="text-center">
        <h1 class="text-5xl font-semibold text-white">Our Mission</h1>
        <p class="text-white mt-10 text-3xl">
            At <strong>Trusted Nanny Services</strong>, our mission is to provide a safe, nurturing, and enriching environment for children. We believe that every child deserves compassionate and professional care, helping them grow and thrive in a loving setting.
        </p>
    </div>
</div>

    <div class="mt-12 text-center text-white">
                <h2 class="text-2xl font-semibold">Get in Touch</h2>
                <p class="mt-4">Looking for a reliable nanny service? Contact us today to learn more about our services.</p>
                <a href="{{ url('contact') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 mb-8">Contact Us</a>
            </div>
        </div>

    </div>
    <!-- Footer -->
    <footer id="contact" class="bg-[#FF7F50] text-white py-6 relative z-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2025 Childminder Booking Service. All Rights Reserved.</p>
            <p>This website is created by @JOANNE CHAN ╰(*°▽°*)╯</p>
        </div>
    </footer>
</body>

<style>
    .small-caps {
        font-variant: small-caps;
    }
</style>

</html>
