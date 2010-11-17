var lastInfo;
var markers = new Array();
var markerHash = new Array();
function load() {

	var latlng = new google.maps.LatLng(40.76273, -73.985023);
	var myOptions = {
zoom: 12,
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	downloadAndLoad();
}

function downloadAndLoad(params){
	if(params != ""){
		$xmlLoc = "dblib/genxml.php";
	} else {
		$xmlLoc = "dblib/genxml.php?" + params;
	}
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

function updateMap(){

	$startDate = document.getElementById("stardate");
	$startTime = document.getElementById("starttimehour");
	$startTime= $startTime + ":" + document.getElementById("starttimeminute").value;
	$endDate = document.getElementById("enddate");

	$endTime= document.getElementById("endtimehour");

	$endTime= $endTime + ":" + document.getElementById("endtimeminute").value;
	$endTime = document.getElementById("enddate");
	$query = "startDate=" + $startDate + "&" +
			"startTime=" + $startTime + "&" +
			"endDate=" + $endDate + "&" +
			"endTime=" + $endTime;
	removeMarkers();	
	alert($query);
//	downloadAndLoad(query);

}

function removeMarkers(){
	for(marker in markers){
		alert(typeof markers.getPosition);
		if(typeof marker.setVisible == 'function')
			marker.setVisible(false);
	}
	markers = new Array();
}

function createMarker(point, map, rate, address, type, bserial) {
	if(marker = markerHash[bserial]){
		marker.setVisible(true);
		markers.push(marker);
	} else {
		var marker = new google.maps.Marker({
position: point,
map: map,
title: type});
		markers.push(marker);
		markerHash[bserial] = marker;
		var html = "<b>" + address + ":</b> <br/> Type: " + type + "<br/> Rate: " + rate + "<br> <a href='reservation.php?bikeId=" + bserial + "'>Reserve this Bike!</a>";
		google.maps.event.addListener(marker, 'click', function() {
			if(lastInfo){
			lastInfo.close();
			}
			lastInfo = new google.maps.InfoWindow({content: html});
			lastInfo.open(map,marker);
			});
	}
}

