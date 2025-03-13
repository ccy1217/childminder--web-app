<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Smooth Scroll CSS -->
        <style>
            html {
                scroll-behavior: smooth;
            }

            /* Background Image */
            .scrollable-background {
                position: relative;
                background-image: url("{{ asset('storage/profile_pictures/bg-kid-playing.png') }}"); 
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            /* Dark Overlay */
            .dark-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.4); /* Adjust opacity here */
                z-index: 0; /* Keep it behind content */
            }
        </style>
    </head>

    <body class="text-gray-900 font-sans scrollable-background relative"> 

        <!-- Dark Overlay (Moved inside the scrollable-background div) -->
        <div class="dark-overlay"></div>

        <!-- Page Content -->
        <div class="relative z-10"> <!-- Higher z-index than overlay -->
            <header class="relative w-full min-h-screen text-white overflow-y-auto">
                <div class="font-sans text-gray-900 antialiased">
                    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-opacity-80"> 

                        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg ">
                        <div class="mt-4 flex justify-center items-center ">
                            <a href="/">
                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </div>

                            {{ $slot }}
                        </div>
                    </div>
                </header>

            </div>
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
    </body>
</html>
