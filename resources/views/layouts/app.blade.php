<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- <title>{{ config('app.name', 'Childminder booking Service') }}</title> -->
        <title>Childminder Booking Service</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css'])
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js'])  -->


        <script type="module" src="{{ asset('js/googleMap.js') }}"></script>

        <!-- Livewire Styles -->
        @livewireStyles

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
    <body class="font-sans antialiased">

        <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
                key: 'AIzaSyCVNvfgvK59rfEKplAJKVB9VJ-yLgrjkvE', v: "weekly", });</script>

        <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"> </script> -->
        

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content with Flexbox Layout -->
            <main>
                <div class="main-container">
                    <div class="content">
                        <!-- Main Content (Larger Livewire Section) -->
                        {{ $slot }}
                        
                    </div>

                    <!-- Ads Section on the Right (Smaller) -->
                    <div class="ad-container" id="ad-container"></div>
                </div>
                <footer class="py-12 text-center text-sm text-blue-500 dark:text-white/70">
                This website is created by @JOANNE CHAN ╰(*°▽°*)╯
            </footer>
            </main>
        </div> 

        <!-- Livewire Scripts -->
        @livewireScripts

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
   
</html>
