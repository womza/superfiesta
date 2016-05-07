jQuery(function($) {
    // Asynchronously Load the map API
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map,
        bounds = new google.maps.LatLngBounds(),
        styleArray = JSON.parse(map_vars.map_style);
        mapOptions = {
            mapTypeId: 'roadmap',
            scrollwheel: false,
            styles: styleArray
        };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    var markers = map_vars.places;

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i].marker_latitude, markers[i].marker_longitude);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            visible: true,
            animation: google.maps.Animation.DROP,
            map: map,
            icon: map_vars.map_marker
        });

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    var mapZoom = parseInt(map_vars.zoom_lvl);

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(mapZoom);
        google.maps.event.removeListener(boundsListener);
    });

}