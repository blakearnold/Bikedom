
function load() {
    
	var latlng = new google.maps.LatLng(40.76273, -73.985023);
	var myOptions = {
	    zoom: 8,
	    center: latlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	 };
	 var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

 
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
		var markers = xmlDoc.documentElement.getElementsByTagName("bike");
		for (var i = 0; i < markers.length; i++) {
		    var rate = markers[i].getAttribute("rate");
		    var address = markers[i].getAttribute("address");
		    var type = markers[i].getAttribute("type");
		    var point = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
			parseFloat(markers[i].getAttribute("lng")));
		    createMarker(point, map, rate, address, type);
		
	    }
    
}

function createMarker(point, map, rate, address, type) {
    var marker = new google.maps.Marker({
		position: point,
		map: map,
	    title:"Whats the title?"});
    var html = "<b>" + type + ":</b> <br/>" + address + "<br/> Rate: " + rate;
    google.maps.event.addListener(marker, 'click', function() {
		info = new google.maps.InfoWindow({content: html});
		info.open(map,marker);
	});
}
