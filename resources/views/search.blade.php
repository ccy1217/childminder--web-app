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
        
        <style>
        .small-caps {
            font-variant: small-caps;
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

        <!-- Include Axios CDN for the advirtisement-->
        <style>
            /* Main Layout */
            .main-container {
                display: flex;
                justify-content: space-between;
                gap: 30px; /* More spacing */
                padding: 20px;
            }

            /* Main Content (Livewire Container) - Bigger Size */
            .content {
                flex: 3; /* Takes more space */
                display: flex;
                flex-direction: column;
            }

            /* Ads Section (Right Side) */
            .ad-container {
                flex: 1; /* Smaller than content */
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            /* Individual Ad Box */
            .ad {
                width: 220px; /* Slightly bigger */
                border: 1px solid #ccc;
                padding: 8px;
                text-align: center;
                background: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 6px;
                font-size: 12px;
            }

            /* Center the Image */
            .ad img {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 0 auto;
                border-radius: 4px;
            }

            /* Ad Title - Bold & Blue */
            .ad h2 {
                font-size: 14px;
                font-weight: bold;
                color: #007bff;
                margin-bottom: 4px;
            }

            /* Sponsor Text - Grey */
            .ad p {
                font-size: 12px;
                color: #6c757d;
                margin-bottom: 6px;
            }

            /* Button */
            .ad a {
                display: inline-block;
                padding: 6px 10px;
                background: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                font-size: 11px;
            }

            .ad a:hover {
                background: #0056b3;
            }
        </style>
    </head>
    <body>
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
    <header id="hero" class="relative w-full min-h-[50vh] flex items-center text-white"> 
    <div class="container mx-auto px-4 py-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight " data-aos="fade-up">
                Search a Childminder
            </h1>
            <p class="text-lg text-white mt-2 small-caps">Find experienced and loving childminders around you.</p>
        </div>
    </div>
</header>

    <main>
        <div class="main-container">
            <div class="content">
                @livewire('childminder-profile-show')
            </div>

                <!-- Ads Section on the Right (Smaller) -->
            <div class="ad-container" id="ad-container"></div>
        </div>
    </main>
    </div>

    <!-- Footer -->
    <footer id="contact" class="bg-[#00CED1] text-white py-6 relative z-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2025 Childminder Booking Service. All Rights Reserved.</p>
            <p>This website is created by @JOANNE CHAN ╰(*°▽°*)╯</p>
        </div>
    </footer>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetch("https://raw.githubusercontent.com/ccy1217/adsads/refs/heads/main/ads%20(1).json") // Fetch JSON from GitHub
                .then(response => response.json())
                .then(data => {
                    displayRandomAds(data, 3); // Show 3 random ads
                })
                .catch(error => console.error("Error fetching ads:", error));
        });

        function displayRandomAds(ads, count) {
            const adContainer = document.getElementById("ad-container");
            adContainer.innerHTML = "";

            // Shuffle ads and select random ones
            const shuffledAds = ads.sort(() => 0.5 - Math.random()).slice(0, count);

            shuffledAds.forEach(ad => {
                const adElement = document.createElement("div");
                adElement.classList.add("ad");
                adElement.innerHTML = `
                    <h2>${ad.title}</h2>
                    <p>${ad.sponsor || "Sponsored Ad"}</p>
                    <img src="${ad.image}" alt="${ad.title}">
                    <br>
                    <a href="${ad.url}" target="_blank">Learn More</a>
                `;
                adContainer.appendChild(adElement);
            });
        }
    </script>

    </body>

    <style>
        .small-caps {
            font-variant: small-caps;
        }
    </style>
</html>