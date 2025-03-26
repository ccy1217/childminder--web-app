// document.addEventListener('DOMContentLoaded', function(){

//     window.initMap = function() {

//         const location = { lat: -34.397, lng: 150.644 };
        
//         new google.maps.Map( document.getElementById("map"), {
//             zoom: 8,
//             center: location,
//         });
//     }
// })

document.addEventListener('DOMContentLoaded', function(){

    // window.onload = function () {

        // Initialize and add the map
        let map;

        async function initMap() {
            
            const position = { lat: -25.344, lng: 131.031 };
            
            const { Map } = await google.maps.importLibrary("maps");

            // console.log('Map Obj: ', Map)
            console.log(document.getElementById("mapContainer"))
            map = new Map(document.getElementById("mapContainer"), {
                zoom: 4,
                center: position,
                // mapId: "DEMO_MAP_ID",
            });

        }

        initMap();
    // }

    

})