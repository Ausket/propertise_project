let map;
let maps;
let position2 = { lat: 13.84786, lng: 100.604274 };
var locations = [
    ["วัดเบญจามบพิตร", 13.846876, 100.604481],
    ["หมู่บ้านตั๊กแตน", 13.847766, 100.605768],
    ["มอเตอร์เวย์", 13.845235, 100.602711],
    ["ร้านน้องแจ๋ม", 13.86297, 100.613834],
];


/* function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: position2,
    zoom: 15,
  }); */

/*   var marker2 = new google.maps.Marker({
    position: position,
    map,
    title: "Hello World!",
    icon :"location.png"
  });

  const contentString =
    '<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h5 id="firstHeading" class="firstHeading">TEERAPAT </h5>' +
    '<div id="bodyContent">' +
    "</div>" +
    "</div>";

  const infowindow = new google.maps.InfoWindow({
    content: contentString,
  });

  marker2.addListener("click", () => {
    infowindow.open({
      anchor: marker2,
      map,
      shouldFocus: false,

    });
  }); */

/*   var marker, i, info;
  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map,
      title: locations[i][0],
      icon :"location.png"
    });

     info = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click',(function(marker,i){

      return function(){
        info.setContent(locations[i][0]);
        info.open(map,marker);
      }
    })(marker,i)); 
 
  } */

/*   var marker, info;
  var i;

  $.each(jsonObj,function(i,item){
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(item.lat,item.lng),
      map:map,
      icon :"location.png"
    });

    info = new google.maps.InfoWindow();

    google.maps.event.addListener(marker,'click',(function(marker,i){

      return function(){
        info.setContent(item.location);
        info.open(map,marker);
      }
    })(marker,i));
  }); */



function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: position2,
        zoom: 15,
    });

    /* var geocoder = new google.maps.Geocoder();
    document.getElementById("submit").addEventListener("click", function() {
        geocodeAdress(geocoder, map);
    }); */

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
            icon: "../image/location.png",
        });

        var lng = mapsMouseEvent.latLng.toJSON()

        console.log(lng);
        document.getElementById("lng").value = lng.lng;
        document.getElementById("lat").value = lng.lat;

        infoWindow.open(map);
    });


    var marker3, info3;
    $.getJSON("../backend/map.php", function(jsonObj) {

        $.each(jsonObj, function(i, item) {
            marker3 = new google.maps.Marker({
                position: new google.maps.LatLng(item.lat, item.lng),
                map: map,
                icon: "../image/location.png"
            });

            info3 = new google.maps.InfoWindow();
            google.maps.event.addListener(marker3, 'click', (function(marker3, i) {

                return function() {
                    info3.setContent(item.name);
                    info3.open(map, marker3);
                }
            })(marker3, i));


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