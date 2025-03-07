<!DOCTYPE html>
<html>
<head>
    <title>Postcode Route Finder</title>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        #controls {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 140px;
            text-align: center;
        }

        .arrow {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }

        button {
            padding: 6px 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }

        button:hover {
            background: #0056b3;
        }

        #map {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>

    <!-- Input fields for postcodes with a direction arrow -->


    <div id="controls">
        <input type="text" id="startPostcode" placeholder="Enter start postcode" value= <?php echo str_replace(' ','', $clientPostcode) ?> >
        <span class="arrow">→</span>
        <input type="text" id="endPostcode" placeholder="Enter destination postcode" value= <?php echo str_replace(' ','', $childminderPostcode)?> >
        <button onclick="updateRoute()">Find Route</button>
    </div>

    <!-- Map container -->
    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script>
        
        // Initialize the map centered in the UK
        var map = L.map('map').setView([51.5, -0.12], 7); // Default UK center

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: "© OpenStreetMap contributors"
        }).addTo(map);

        let routingControl; // Store routing control instance

        // Function to get Lat/Lng from postcode using Nominatim API
        async function getCoordinates(postcode) {
            let url = `https://nominatim.openstreetmap.org/search?format=json&q=${postcode},UK`;

            try {
                let response = await fetch(url);
                let data = await response.json();

                if (data.length > 0) {
                    return { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) };
                } else {
                    alert(`Invalid postcode: ${postcode}`);
                    return null;
                }
            } catch (error) {
                console.error("Error fetching coordinates:", error);
                return null;
            }
        }

        // Function to update route based on input postcodes
        async function updateRoute() {

             
            // ~console.log( <?php echo $clientPostcode ?> );

            let startPostcode = document.getElementById("startPostcode").value.trim();
            let endPostcode = document.getElementById("endPostcode").value.trim();

            let startCoords = await getCoordinates(startPostcode);
            let endCoords = await getCoordinates(endPostcode);

            if (startCoords && endCoords) {
                // Remove existing route if any
                if (routingControl) {
                    map.removeControl(routingControl);
                }

                // Add new route
                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(startCoords.lat, startCoords.lng),
                        L.latLng(endCoords.lat, endCoords.lng)
                    ],
                    routeWhileDragging: true
                }).addTo(map);

                // Center map on new route
                map.setView([startCoords.lat, startCoords.lng], 7);
            }
        }

        // Load default route on page load
        updateRoute();
    </script>

</body>
</html>
