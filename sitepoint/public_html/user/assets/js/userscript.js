window.onload = function () {
    var markersArray = [];
    var mapOptions = {
        center: new google.maps.LatLng(38.52641, 23.16314),
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    function clearOverlays() {
      for (var i = 0; i < markersArray.length; i++ ) {
       markersArray[i].setMap(null);
      }
    }
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
    var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
    
    google.maps.event.addListener(map, 'click', function (e) {
    clearOverlays();
    placeMarker(e.latLng);
    document.getElementById("csvposx").value = e.latLng.lat();
    document.getElementById("csvposy").value = e.latLng.lng();
    });
    function placeMarker(location) {
    var marker = new google.maps.Marker({
    position: location, 
    map: map
    });
    markersArray.push(marker);
    }
}
function showindex()
{
    
    window.location="../../";
}
$(document).ready(function(){
    refreshTable();
    });

    function refreshTable(){
        $('#adstations').load('../script/usertable.php', function(){
            setTimeout(refreshTable, 5000);
        });
}
