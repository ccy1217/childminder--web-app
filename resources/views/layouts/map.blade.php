<!DOCTYPE html>
<html>
    <!-- leaflet css cdn -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"/>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        body{
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="map" style="width:100%; height:100vh"></div>

</body>
</html>

<!-- leaflet js cdn -->
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

<!-- leaflet routing machine js -->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<script>
    // Initialize the map and center it over London
    var map = L.map('map').setView([51.5154, -0.1754], 7); // Center around London with zoom 7

    // Add OpenStreetMap tile layer
    var tileLayer = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', { 
        attribution: "© OpenStreetMap contributors" 
    }).addTo(map);

    // Add markers for London Paddington and Cardiff Central
    var marker1 = L.marker([51.5154, -0.1754]).addTo(map).bindPopup("London Paddington");
    var marker2 = L.marker([51.4781, -3.1778]).addTo(map).bindPopup("Cardiff Central");

    // Add route from London Paddington to Cardiff Central
    L.Routing.control({
        waypoints: [
            L.latLng(51.5154, -0.1754), // London Paddington
            L.latLng(51.4781, -3.1778)  // Cardiff Central
        ],
        routeWhileDragging: true
    }).addTo(map);

</script>
