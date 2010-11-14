var marker;
function load() {
	var latlng = new google.maps.LatLng(40.76273, -73.985023);
	var myOptions = {
	    zoom: 14,
	    center: latlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	 };
	 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
     geocoder = new google.maps.Geocoder();
	 marker = new google.maps.Marker({
		map: map, 
		position: latlng
	});
	marker.setDraggable(true);
	google.maps.event.addListener(marker, 'dragend', function(x){
	document.getElementById("lat").value=x.latLng.lat();
	document.getElementById("lng").value=x.latLng.lng();
	});
	updateLoc();

}

function codeAddress() {
    var address = document.getElementById("address").value + " New York, NY";
    geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
		map.setCenter(results[0].geometry.location);
    	marker.setPosition(results[0].geometry.location);
		updateLoc();
	   	} else {
		alert("Geocode was not successful for the following reason: " + status);
	    }
	});
}
function updateLoc(){
	document.getElementById("lat").value=marker.getPosition().lat();
	document.getElementById("lng").value=marker.getPosition().lng();
}
function putMarkers(){
 
$xmlLoc = "dblib/genxml.php";
if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
			  }
else
  {// code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }

xmlhttp.open("GET",$xmlLoc,false);
xmlhttp.send();
xmlDoc=xmlhttp.responseXML;
	if(xmlDoc){
		var markers = xmlDoc.documentElement.getElementsByTagName("bike");
		for (var i = 0; i < markers.length; i++) {
		    var rate = markers[i].getAttribute("rate");
		    var address = markers[i].getAttribute("address");
		    var bserial = markers[i].getAttribute("bserial");
		    var type = markers[i].getAttribute("type");
		    var point = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
			parseFloat(markers[i].getAttribute("lng")));
			createMarker(point, map, rate, address, type, bserial);
		
	    }
	}
    
}

function createMarker(point, map, rate, address, type, bserial) {
    var marker = new google.maps.Marker({
		position: point,
		map: map,
	    title:"Whats the title?"});
    var html = "<b>" + address + ":</b> <br/> Type: " + type + "<br/> Rate: " + rate + "<br> <a href='reservation.php?bikeId=" + bserial + "'>Reserve this Bike!</a>";
    google.maps.event.addListener(marker, 'click', function() {
		info = new google.maps.InfoWindow({content: html});
		info.open(map,marker);
	});
}
