var end_;
var start_;
var zoom=12;
var directionsDisplay;
var directionsService;
function update_map(point1_lat,point1_long,point2_lat,point2_long){
	var polylineOptionsActual = new google.maps.Polyline({
		strokeColor: '#122033',
		strokeOpacity: 0.8,
		strokeWeight: 5
	});
	directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions: polylineOptionsActual,suppressMarkers: true}); 
	directionsService = new google.maps.DirectionsService();
	// var map;
	end_ = new google.maps.LatLng(point2_lat,point2_long);
	start_ = new google.maps.LatLng(point1_lat,point1_long);
	initialize();
	calcRoute();
}
function initialize() {
	//general options
	var mapOptions = {
		zoom: zoom,
		center: start_,
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	directionsDisplay.setMap(map);
	//marker options
	var marker = new google.maps.Marker({
		position: start_,
		map:map,
		icon: '../wp-content/themes/williams-garage/images/icon-4.png',
	});
	var marker2 = new google.maps.Marker({
		position: end_,
		map:map,
		icon: '../wp-content/themes/williams-garage/images/icon-4.png',
	});
}
function calcRoute() {
	var selectedMode = 'DRIVING';
	var request = {
		origin: start_,
		destination: end_,
		travelMode: google.maps.TravelMode[selectedMode]
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
		}
	});
}
function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
setTimeout(function() {
	$('.spinner').fadeOut(500,function(){
		$("#providers_container").slideDown('fast');
	})
}, getRandom(100,500));