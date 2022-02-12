let map;
let maps;
let position2 = { lat: 13.84786, lng: 100.604274 };
var locations = [
    ["วัดเบญจามบพิตร", 13.846876, 100.604481],
    ["หมู่บ้านตั๊กแตน", 13.847766, 100.605768],
    ["มอเตอร์เวย์", 13.845235, 100.602711],
    ["ร้านน้องแจ๋ม", 13.86297, 100.613834],
];

var jsonObj = [
    { location: "วัดเบญจามบพิตร", lat: "13.846876", lng: "100.604481" },
    { location: "หมู่บ้านตั๊กแตน", lat: "13.847766", lng: "100.605768" },
    { location: "มอเตอร์เวย์", lat: "13.845235", lng: "100.602711" },
    { location: "ร้านน้องแจ๋ม", lat: "13.86297", lng: "100.613834" },
];



function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: position2,
        zoom: 15,
    });

    var geocoder = new google.maps.Geocoder();
    document.getElementById("submit").addEventListener("click", function() {
        geocodeAdress(geocoder, map);
    });

    let infoWindow = new google.maps.InfoWindow({
        content: "Click the map to get Lat/Lng!",
        position: map,
    });

    infoWindow.open(map);
    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {
        // Close the current InfoWindow.
        infoWindow.close();
        // Create a new InfoWindow.
        /* infoWindow = new google.maps.InfoWindow({
          position: mapsMouseEvent.latLng,
        });
        infoWindow.setContent(
          JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        ); */
        if (marker && marker.setMap) {
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: mapsMouseEvent.latLng,
            map: map,
            icon: "location.png",
        });

        var lnglat = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);

        console.log(lnglat);

        document.getElementById("lng").value = lnglat;

        infoWindow.open(map);
    });

    var marker3, info3;
    $.getJSON("json.php", function(jsonObj) {
        $.each(jsonObj, function(i, item) {
            marker3 = new google.maps.Marker({
                position: new google.maps.LatLng(item.lat, item.lng),
                map: map,
                icon: "location.png",
            });

            info3 = new google.maps.InfoWindow();
            google.maps.event.addListener(
                marker3,
                "click",
                (function(marker3, i) {
                    return function() {
                        info3.setContent(item.name);
                        info3.open(map, marker3);
                    };
                })(marker3, i)
            );
        });
    });
}

var marker;

function geocodeAdress(geocoder, resultsMap) {
    var address = document.getElementById("address").value;
    console.log(address);
    geocoder.geocode({ address: address }, function(results, status) {
        if (status === "OK") {
            resultsMap.setCenter(results[0].geometry.location);
            if (marker && marker.setMap) {
                marker.setMap(null);
            }
            marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location,
                icon: "location.png",
            });
        } else {
            alert("Geocode was not successful for the follwing reason: " + status);
        }
    });
}