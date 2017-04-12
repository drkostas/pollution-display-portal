<script type="text/javascript">
    //<![CDATA[

    

    function load() 
    {
      var heatmapdata = [];
      
      var map = new google.maps.Map(document.getElementById("map"), 
      {
        center: new google.maps.LatLng(38.52641, 23.16314),
        zoom: 6,
        mapTypeId: 'hybrid'
      });
     
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("webapi.php?apikey=e33bbf304930e33fe5c9c61b67e7b7d8&req=1", function(data) 
      {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("stathmos");
        for (var i = 0; i < markers.length; i++) 
        {
          var mesitimi = markers[i].getElementsByTagName("mesitimi")[0].childNodes[0].nodeValue;
          var name = markers[i].getElementsByTagName("onoma")[0].childNodes[0].nodeValue;
          var kodikos = markers[i].getElementsByTagName("kodikos")[0].childNodes[0].nodeValue;
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue),
              parseFloat(markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue));
              
          var html = "<b>" + name + "</b> <br/>Kodikos: "  + kodikos +"<br>" + " Mesi Timi Ripou: "  + mesitimi;
          var latLng ={ location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: Math.max(0.0001,Math.round(mesitimi*10000))};
          var marker = new google.maps.Marker(
            {
            map: map,
            position: point
          });
          
          var loc = {
          location: latLng
        };
          bindInfoWindow(marker, map, infoWindow, html);
          heatmapdata.push(latLng);
        }
        var heatmap = new google.maps.visualization.HeatmapLayer({
          map: map,
          data: heatmapdata
        });
        heatmap.set('radius', 30);
      });
       
    }

    function bindInfoWindow(marker, map, infoWindow, html) 
    {
      google.maps.event.addListener(marker, 'click', function() 
      {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) 
    {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() 
      {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>