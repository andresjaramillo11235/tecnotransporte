// Initialize and add the map
let map;

async function initMap() {
    // The location of Uluru
    const position = {lat: 4.64302, lng: -74.10294};

    // Request needed libraries.
    //@ts-ignore
    const {Map} = await google.maps.importLibrary("maps");
    const {AdvancedMarkerView} = await google.maps.importLibrary("marker");

    // The map, centered at Uluru
    map = new Map(document.getElementById("map"), {
        zoom: 10,
        center: position,
        mapId: "DEMO_MAP_ID",
    });

    // Array with marker positions
    const markerPositions = [
        {lat: 4.64302, lng: -74.10294}, // Marker 1: Uluru
        {lat: -33.86785, lng: 151.20732}, // Marker 2: Sydney
        {lat: 40.68925, lng: -74.04449}, // Marker 3: Statue of Liberty
                // Add more marker positions as needed
    ];

    markerPositions.forEach(function (position) {
        const marker = new AdvancedMarkerView({
            map: map,
            position: position,
            title: "Uluru"
        });
    });
}

  initMap();




