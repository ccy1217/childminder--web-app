<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Childminder Contact</title>

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
                position: relative;
                padding-top: 10px; /* Space for the top underline */
                padding-bottom: 10px; /* Space for the bottom underline */
                display: inline-block;
                
                /* Gradient Text */
                background: linear-gradient(90deg, blue, red);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
/* 
            .font-cinzel::before,
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

        <!-- Smooth Scroll CSS -->
        <style>
            html {
                scroll-behavior: smooth;
            }

            .scrollable-background {
                background-image: url("{{ asset('storage/profile_pictures/bg (2).png') }}");
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
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-black ml-2 font-cinzel">💫Childminder Service</a>

                        <div class="hidden md:flex space-x-6 pl-6">
                            <a href="{{ url('/') }}" class="hover:text-indigo-600 transition duration-300">Home</a>
                            <a href="{{ url('/search') }}" class="hover:text-indigo-600 transition duration-300">Search</a>
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

                <header id="hero" class="relative w-full min-h-[90vh] flex items-center text-white">
    <div class="container mx-auto px-4 py-8 pl-30">
        <div class="text-center pl-8">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight " data-aos="fade-up">
                Contact Us</h1>
            <p class="text-lg text-white mt-2 small-caps">We’d love to hear from you! Send us a message.</p>
        </div>
        
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <form id="contactForm">
                <label for="message" class="block text-white font-semibold mb-4">Your Message</label>
                <textarea id="message" class="w-full p-6 border rounded-lg focus:ring-2 focus:ring-blue-500 mb-6 text-black" rows="6" placeholder="Type your message here..."></textarea>
                
                <button type="button" onclick="sendEmail()" class="mt-4 w-full bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</header>



    </div>

        <!-- Footer -->
        <footer id="contact" class="bg-[#00CED1] text-white py-6 relative z-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2025 Childminder Booking Service. All Rights Reserved.</p>
            <p>This website is created by @JOANNE CHAN ╰(*°▽°*)╯</p>
        </div>
    </footer>

    <script>
        function sendEmail() {
            let message = document.getElementById('message').value;
            let email = '2260810@swansea.ac.uk'; // Replace with your actual email
            let subject = 'Inquiry from Childminder WebApp';
            
            let mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(message)}`;
            window.location.href = mailtoLink;
        }
    </script>

    </body>

    <style>
        .small-caps {
            font-variant: small-caps;
        }
    </style>
</html>