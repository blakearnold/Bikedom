var lastInfo;
var markerHash = new Array();
var dateset = false;
function load() {

	newMap();
	downloadAndLoad();
}

function newMap(){
	
	var latlng = new google.maps.LatLng(40.76273, -73.985023);
	var myOptions = {
zoom: 12,
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
}


function downloadAndLoad(params){
	if(!params){
		$xmlLoc = "dblib/genxml.php";
	} else {
		$xmlLoc = "dblib/genxml.php?" + params;
	}
	alert( $xmlLoc);
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
			createMarker(point, map, rate, address, type, bserial, params);

		}
	}

}

function updateMap(){
	$startDate = document.getElementById("startdate").value;
	$startTime = document.getElementById("starttimehour").value;
	$startTime= $startTime + ":" + document.getElementById("starttimeminute").value;
	$endDate = document.getElementById("enddate").value;

	$endTime= document.getElementById("endtimehour").value;

	$endTime= $endTime + ":" + document.getElementById("endtimeminute").value;
	$query = "startDate=" + $startDate + "&" +
			"startTime=" + $startTime + "&" +
			"endDate=" + $endDate + "&" +
			"endTime=" + $endTime;
	newMap();
	if($startDate == "" || $endDate == ""){
		dateset=false;
		downloadAndLoad();
	}else{
		dateset=true;
		downloadAndLoad($query);
	}
}

function createMarker(point, map, rate, address, type, bserial, params) {
		if(!params){
			params = "bikeId=" + bserial;
		} else {
			params = params + "&bikeId=" + bserial;
		}
		var marker = new google.maps.Marker({
position: point,
map: map,
title: type});
		markerHash[bserial] = marker;
		var html = "<b>" + address + ":</b> <br/> Type: " + type + "<br/> Rate: " + rate;
		if(dateset){
			html = html + "<br> <a href='reservation.php?" + params + "'>Reserve this Bike!</a>";
		} else {
			html = html + "<br> Choose rental time"
		}
		google.maps.event.addListener(marker, 'click', function() {
			if(lastInfo){
			lastInfo.close();
			}
			lastInfo = new google.maps.InfoWindow({content: html});
			lastInfo.open(map,marker);
			});
}

