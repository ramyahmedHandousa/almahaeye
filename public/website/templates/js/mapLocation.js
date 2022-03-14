
function initAutocomplete() {

    map = new google.maps.Map(document.getElementById('googleMap'), {

        // center: {lat:  window.lat   , lng:  window.lng   },
        center: {lat: 24.774265, lng: 46.738586},
        zoom: 15,
        mapTypeId: 'roadmap'
    });


    var marker;
    google.maps.event.addListener(map, 'click', function (event) {

        map.setZoom();
        var mylocation = event.latLng;
        map.setCenter(mylocation);


        $('#lat').val(event.latLng.lat());
        $('#lng').val(event.latLng.lng());



        codeLatLng(event.latLng.lat(), event.latLng.lng());

        setTimeout(function () {
            if (!marker)
                marker = new google.maps.Marker({position: mylocation, map: map});
            else
                marker.setPosition(mylocation);
        }, 600);

    });


    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });


    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();
        // var location = place.geometry.location;
        // var lat = location.lat();
        // var lng = location.lng();
        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function (marker) {
            marker.setMap(null);
        });
        markers = [];


        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
            $('#lat').val(place.geometry.location.lat());
            $('#lng').val(place.geometry.location.lng());
            $('#address').val(place.formatted_address);


        });


        map.fitBounds(bounds);
    });


}


function showPosition(position) {

    map.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
    codeLatLng(position.coords.latitude, position.coords.longitude);


}


function codeLatLng(lat, lng) {

    var geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({
        'latLng': latlng
    }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                // console.log(results[1].formatted_address);
                $("#demo").html(results[1].formatted_address);

                $("#address").val(results[1].formatted_address);
                $("#map").val(results[1].formatted_address);
                $("#pac-input").val(results[1].formatted_address);

                $('.alert').addClass('fade');





            } else {
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
}
