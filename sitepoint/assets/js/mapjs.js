function showmarkers(url,choose)
{
  "use strict"; 
   var heatmapdata = [];
  
    var map = new google.maps.Map(document.getElementById("map"), 
    {
    center: new google.maps.LatLng(38.52641, 23.16314),
    zoom: 6,
    mapTypeId: 'hybrid'
    });    
    var infoWindow = new google.maps.InfoWindow;
    
  if (choose==1)
  {
     //Change this depending on the name of your PHP file
     downloadUrl(url, function(data) 
    {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("stathmos");
    for (var i = 0; i < markers.length; i++) 
    {
      var mesitimi = markers[i].getElementsByTagName("mesitimi")[0].childNodes[0].nodeValue;
      var name = markers[i].getElementsByTagName("onoma")[0].childNodes[0].nodeValue;
      var kodikos = markers[i].getElementsByTagName("kodikos")[0].childNodes[0].nodeValue;
      var imerominia = markers[i].getElementsByTagName("imerominia")[0].childNodes[0].nodeValue;
      var eidos = markers[i].getElementsByTagName("eidos_ripou")[0].childNodes[0].nodeValue;
      var point = new google.maps.LatLng(
        parseFloat(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue),
        parseFloat(markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue));
        
      var html = "<b>" + name + "</b> <br/>Code: "  + kodikos +"<br>" + " Mean: "  + mesitimi +"<br>" + " Imerominia: " + imerominia+ "<br>" +" Eidos ripou: " + eidos;
      switch(eidos) //proetoimasia heatmap
      {
      case 'CO':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi*10,  gradient: 'rgba(0, 255, 255, 0)'
        };
        break;
      case 'NO':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi/10,  gradient:  'rgba(0, 0, 255, 1)'
        };
        gradient= [ 'rgba(0, 255, 255, 1)',
        'rgba(0, 191, 255, 1)',
        'rgba(0, 127, 255, 1)',
        'rgba(0, 63, 255, 1)',
        'rgba(0, 0, 255, 1)',
        'rgba(0, 0, 223, 1)',
        'rgba(0, 0, 191, 1)',
        'rgba(0, 0, 159, 1)',
        'rgba(0, 0, 127, 1)',
        'rgba(63, 0, 91, 1)',
        'rgba(127, 0, 63, 1)',
        'rgba(191, 0, 31, 1)',
        'rgba(255, 0, 0, 1)'];

        break;
      case 'NO2':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi          };
        break;
      case 'SO2':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi
 
        };
         gradient = [ 'rgba(102,255,0,0)', 
         'rgba(147,255,0,1)', 
         'rgba(193,255,0,1)', 
         'rgba(238,255,0,1)', 
         'rgba(244,227,0,1)', 
         'rgba(244,227,0,1)', 
         'rgba(249,198,0,1)', 
         'rgba(255,170,0,1)', 
         'rgba(255,113,0,1)', 
         'rgba(255,57,0,1)', 
         'rgba(255,0,0,1)'
          ];
        break;
      case 'O3':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi/10
        };
         gradient = [ 'rgba(102,255,0,0)', 
         'rgba(147,255,0,1)', 
         'rgba(193,255,0,1)', 
         'rgba(238,255,0,1)', 
         'rgba(244,227,0,1)', 
         'rgba(244,227,0,1)', 
         'rgba(249,198,0,1)', 
         'rgba(255,170,0,1)', 
         'rgba(255,113,0,1)', 
         'rgba(255,57,0,1)', 
         'rgba(255,0,0,1)'
          ];

    }
      var marker = new google.maps.Marker(//dimiourgia heatmap
      {
      map: map,
      position: point
      });
      
      var loc = {
      location: latLng
    };
      bindInfoWindow(marker, map, infoWindow, html);
      heatmapdata.push(latLng);
      heatmapdata.push(gradient);
    }
    var heatmap = new google.maps.visualization.HeatmapLayer({
      map: map,
      data: heatmapdata
    });
    heatmap.set('radius', 20);
    });
  }
  else if(choose==2)
  {
     //Change this depending on the name of your PHP file
     downloadUrl(url, function(data) 
    {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("stathmos");
    for (var i = 0; i < markers.length; i++) 
    {
      var mesitimi = markers[i].getElementsByTagName("meshtimh")[0].childNodes[0].nodeValue;
      var name = markers[i].getElementsByTagName("onoma")[0].childNodes[0].nodeValue;
      var kodikos = markers[i].getElementsByTagName("kodikos")[0].childNodes[0].nodeValue;
      var first = markers[i].getElementsByTagName("first")[0].childNodes[0].nodeValue;
      var last = markers[i].getElementsByTagName("last")[0].childNodes[0].nodeValue;
      var eidos = markers[i].getElementsByTagName("eidos_ripou")[0].childNodes[0].nodeValue;
      var point = new google.maps.LatLng(
        parseFloat(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue),
        parseFloat(markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue));
        
      var html = "<b>" + name + "</b> <br/>Code: "  + kodikos +"<br>" + " Mean: "  + mesitimi +"<br>" + " Imerominies: Apo " + first+ " Mexri " + last + "<br>" +" Eidos ripou: " + eidos;
      switch(eidos) 
      {
      case 'CO':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi*10,  gradient: 'rgba(0, 255, 255, 0)'
        };
        break;
      case 'NO':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi/10,  gradient:  'rgba(0, 0, 255, 1)'
        };
        break;
      case 'NO2':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi,  gradient: 'rgba(0, 0, 127, 1)'
        };
        break;
      case 'SO2':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi,  gradient: 'rgba(191, 0, 31, 1)'
        };
        break;
      case 'O3':
        var latLng =
        { 
          location : new google.maps.LatLng(markers[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue, markers[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue), weight: mesitimi/10,  gradient: 'rgba(191, 0, 31, 1)'
        };
    }     
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
    heatmap.set('radius', 20);
  
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
}




//]]>