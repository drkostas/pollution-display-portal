//Javscript Code For the Site
function showmain()
{
	
    window.location="index.php";
}
function showstations()
{
	document.getElementById("optionsbutton").style.display = "none";
    document.getElementById("showoptions").style.display = "block";
    document.getElementById("reset").scrollIntoView({behavior: "smooth"});
}
function selectshow()
{ 
	var php = document.getElementById("dropdowninfo").value;
    if (php==1)
    {
        
        document.getElementById("showone").style.display = "block";
        document.getElementById("showall").style.display = "none";
    }
    else if(php == 2)
    {
        
        document.getElementById("showall").style.display = "block";
        document.getElementById("showone").style.display = "none";
    }
	else
	{
	document.getElementById("showone").style.display = "none";
	document.getElementById("showall").style.display = "none";
	}
    window.scrollTo(0,500);
}
function selectshowstation(php)
{
    if (php == 1)
    {
         document.getElementById("radioshow").style.display = "block";
        
    }
    window.scrollTo(0,500);
}

function dateselect(value)
{   
    if (value == 1)
    {
        document.getElementById("singledate").style.display = "block";
        document.getElementById("multipledates").style.display = "none";
    }
    else if (value == 2)
    {
        document.getElementById("singledate").style.display = "none";
        document.getElementById("multipledates").style.display = "block";
    }
    window.scrollTo(0, 500);
}
function alldateselect(value)
{
    if (value == 1)
    {
        document.getElementById("allsingledate").style.display = "block";
        document.getElementById("allmultipledates").style.display = "none";
    }
    else if (value == 2)
    {
        document.getElementById("allsingledate").style.display = "none";
        document.getElementById("allmultipledates").style.display = "block";
    }
    window.scrollTo(0, 500);
    
}

function stationshowaction()
 {
        var onoma1 = document.getElementById("dropdownstation");
        var onoma = onoma1.options[onoma1.selectedIndex].value;
        showstations();
        selectshow(1);
        selectshowstation(1);
        req4loadXMLDoc(onoma);
        changeurl(onoma);
        
    }
    
     function changeurl(onoma)
	 {
      window.history.pushState(null,"", "index.php?kodikos="+onoma);
 	}
function fromtodate1change()
 {
         var onoma1 = document.getElementById("dropdownstation");
        var onoma = onoma1.options[onoma1.selectedIndex].value;
		var fromdate = document.getElementById("fromdate1").value;
		var todate = document.getElementById("todate1").value;
        
		changeurlftd1(onoma,fromdate,todate);
        fromtoreq5loadXMLDoc(onoma,fromdate,todate);
        
        
    }
function fromtodate2change()
 {
         var fromdate = document.getElementById("fromdate2").value;
		var todate = document.getElementById("todate2").value;
        
		changeurlftd2(fromdate,todate);
        fromtoallreq5loadXMLDoc(fromdate,todate);
                
    }
	function date1change()
 {
         var onoma1 = document.getElementById("dropdownstation");
        var onoma = onoma1.options[onoma1.selectedIndex].value;
		var date = document.getElementById("date1").value;
        
		changeurlftd1(onoma,date,date);
        req5loadXMLDoc(onoma,date,date);
        
        
    }
	
	function date2change()
 {
         var date = document.getElementById("date2").value;
        
		changeurlftd2(date,date);
        allreq5loadXMLDoc(date,date); 
    }
	
	
	   function changeurlftd1(onoma,fromdate,todate)
	 {
      window.history.pushState(null,"", "index.php?kodikos="+onoma+"&fromdate="+fromdate+"&todate="+todate);
 	}
	
	function changeurlftd2(fromdate,todate)
	 {
      window.history.pushState(null,"", "index.php?fromdate="+fromdate+"&todate="+todate);
 	}
	
    function req1loadXMLDoc() 
	{
       var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() 
      {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
          req1func(xmlhttp);
        }
      };
      xmlhttp.open("GET", "webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=1", true);
      xmlhttp.send();
    }
    
    function req1func(xml) 
    {
      var i;
      var xmlDoc = xml.responseXML;
      var table="<tr><th>Code</th><th>Station Name</th><th>Location</th></tr>";
      var x = xmlDoc.getElementsByTagName("stathmos");
      for (i = 0; i <x.length; i++) 
      { 
        table += "<tr><td>" +
        x[i].getElementsByTagName("kodikos")[0].childNodes[0].nodeValue +
        "</td><td>" +
        x[i].getElementsByTagName("onoma")[0].childNodes[0].nodeValue +
        "</td><td>" +
        x[i].getElementsByTagName("geogr_mikos")[0].childNodes[0].nodeValue +
        ", " +
        x[i].getElementsByTagName("geogr_platos")[0].childNodes[0].nodeValue +
        "</td></tr>";
       }
        document.getElementById("basictable").innerHTML = table;
        var select="";
        x = xmlDoc.getElementsByTagName("stathmos");
        select += '<option value="">Choose One</option>' ;
        for (i = 0; i <x.length; i++) 
        { 
         select += '<option value="' +
        x[i].getElementsByTagName("kodikos")[0].childNodes[0].nodeValue +
        '">' +
        x[i].getElementsByTagName("onoma")[0].childNodes[0].nodeValue +
        '</option></select>';
        }
        document.getElementById("dropdownstation").innerHTML = select;
}

function req2loadXMLDoc() {
  var date1 = document.getElementById("date1");
  var date = date1.value;
  var time1 = document.getElementById("time");
  var time = time1.options[time1.selectedIndex].value;
  var ripos1 = document.getElementById("ripos1");
  var ripos = ripos1.options[ripos1.selectedIndex].value;
  var kodikos1 = document.getElementById("dropdownstation");
  var kodikos = kodikos1.options[kodikos1.selectedIndex].value;
  var xmlhttp = new XMLHttpRequest();
  var ttime = time;
  showmarkers("webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=2&kodikos="+kodikos+"&date="+date+"&time="+time+"&ripos="+ripos,1);

}
function allreq2loadXMLDoc() {
  var date1 = document.getElementById("date2");
  var date = date1.value;
  var time1 = document.getElementById("alltime");
  var time = time1.options[time1.selectedIndex].value;
  var ripos1 = document.getElementById("ripos3");
  var ripos = ripos1.options[ripos1.selectedIndex].value;
  var xmlhttp = new XMLHttpRequest();
  var ttime = time;
  showmarkers("webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=2&date="+date+"&time="+time+"&ripos="+ripos,1);
 }

function req3loadXMLDoc() {
      var fromdate1 = document.getElementById("fromdate1");
      var fromdate = fromdate1.value;
	  var todate1 = document.getElementById("todate1");
      var todate = todate1.value;
	  var ripos1 = document.getElementById("ripos2");
      var ripos = ripos1.options[ripos1.selectedIndex].value;
	  var kodikos1 = document.getElementById("dropdownstation");
      var kodikos = kodikos1.options[kodikos1.selectedIndex].value;
	  var xmlhttp = new XMLHttpRequest();
	  showmarkers("webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=3&kodikos="+kodikos+"&fromdate="+fromdate+"&todate="+todate+"&ripos="+ripos,2);
    }

function allreq3loadXMLDoc() {
  var fromdate1 = document.getElementById("fromdate2");
  var fromdate = fromdate1.value;
  var todate1 = document.getElementById("todate2");
  var todate = todate1.value;
  var ripos1 = document.getElementById("ripos4");
  var ripos = ripos1.options[ripos1.selectedIndex].value;
   showmarkers("webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=3&fromdate="+fromdate+"&todate="+todate+"&ripos="+ripos,2);

}
     
function req4loadXMLDoc(kodikos) {
  var xmlhttp = new XMLHttpRequest();
  var kkodikos = kodikos;
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
      req4func(xmlhttp);
    }
  };
  xmlhttp.open("GET", "webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=4&kodikos="+kkodikos, true);
  xmlhttp.send();
}

  function allreq4loadXMLDoc() {
   var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
      allreq4func(xmlhttp);
    }
  };
  xmlhttp.open("GET", "webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=4", true);
  xmlhttp.send();
}
    
function req4func(xml) 
{
     var i;
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName("stathmos");
    for (i = 0; i <x.length; i++) 
    { 
        document.getElementById("date1").min = x[i].getElementsByTagName("first")[0].childNodes[0].nodeValue;
        document.getElementById("date1").max =x[i].getElementsByTagName("last")[0].childNodes[0].nodeValue;
        document.getElementById("fromdate1").min = x[i].getElementsByTagName("first")[0].childNodes[0].nodeValue;
        document.getElementById("fromdate1").max = x[i].getElementsByTagName("last")[0].childNodes[0].nodeValue;
        document.getElementById("todate1").min = x[i].getElementsByTagName("first")[0].childNodes[0].nodeValue;
        document.getElementById("todate1").max = x[i].getElementsByTagName("last")[0].childNodes[0].nodeValue;
    }
}         
function allreq4func(xml) 
{
     var i;
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName("stathmos");
    for (i = 0; i <x.length; i++) 
    { 
        document.getElementById("date2").min = x[i].getElementsByTagName("first")[0].childNodes[0].nodeValue;
        document.getElementById("date2").max = x[i].getElementsByTagName("last")[0].childNodes[0].nodeValue;
        document.getElementById("fromdate2").min = x[i].getElementsByTagName("first")[0].childNodes[0].nodeValue;
        document.getElementById("fromdate2").max = x[i].getElementsByTagName("last")[0].childNodes[0].nodeValue;
        document.getElementById("todate2").min = x[i].getElementsByTagName("first")[0].childNodes[0].nodeValue;
        document.getElementById("todate2").max = x[i].getElementsByTagName("last")[0].childNodes[0].nodeValue;
    }
}                      

 function req5loadXMLDoc(kodikos,fromdate,todate) {
   var xmlhttp = new XMLHttpRequest();
  var kkodikos = kodikos;
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
      req5func2(xmlhttp,kkodikos);
    }
  };
  xmlhttp.open("GET", "webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=5&kodikos="+kkodikos+"&fromdate="+fromdate+"&todate="+todate, true);
  xmlhttp.send();
}
 function fromtoreq5loadXMLDoc(kodikos,fromdate,todate) {
   var xmlhttp = new XMLHttpRequest();
  var kkodikos = kodikos;
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
      req5func(xmlhttp,kkodikos);
    }
  };
  xmlhttp.open("GET", "webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=5&kodikos="+kkodikos+"&fromdate="+fromdate+"&todate="+todate, true);
  xmlhttp.send();
}
  function allreq5loadXMLDoc(fromdate,todate) {
   var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
      allreq5func2(xmlhttp);
    }
  };
  xmlhttp.open("GET", "webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=5&fromdate="+fromdate+"&todate="+todate, true);
  xmlhttp.send();
}
	
function fromtoallreq5loadXMLDoc(fromdate,todate) {
   var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
      allreq5func(xmlhttp);
    }
  };
  xmlhttp.open("GET", "webapi.php?apikey=b86ddef4e6f4347b2d7b343f22356ead&req=5&fromdate="+fromdate+"&todate="+todate, true);
  xmlhttp.send();
}
    
function req5func(xml,kodikos) 
{
 var i;
var xmlDoc = xml.responseXML;
var x = xmlDoc.getElementsByTagName('stathmos');
for (i = 0; i <x.length; i++) 
{ 
   switch(x[i].getElementsByTagName('eidos_ripou')[0].childNodes[0].nodeValue)
		{
        case "CO" :
        {
            document.getElementById("ripos2").options[1].disabled = false;
			break;
        }
        case "NO" :
        {
            document.getElementById("ripos2").options[2].disabled = false;
			break;
        }
        case "NO2" :
        {
            document.getElementById("ripos2").options[3].disabled = false;
			break;
        }
        case "SO2" :
        {
            document.getElementById("ripos2").options[4].disabled = false;
			break;
        }
         case "O3" :
        {
            document.getElementById("ripos2").options[5].disabled = false;
        }
		}
        
}
}         

 function req5func2(xml,kodikos) 
{
 var i;
var xmlDoc = xml.responseXML;
var x = xmlDoc.getElementsByTagName('stathmos');
for (i = 0; i <x.length; i++) 
{ 
   switch(x[i].getElementsByTagName('eidos_ripou')[0].childNodes[0].nodeValue)
		{
        case "CO" :
        {
            document.getElementById("ripos1").options[1].disabled = false;
			break;
        }
        case "NO" :
        {
            document.getElementById("ripos1").options[2].disabled = false;
			break;
        }
        case "NO2" :
        {
            document.getElementById("ripos1").options[3].disabled = false;
			break;
        }
        case "SO2" :
        {
            document.getElementById("ripos1").options[4].disabled = false;
			break;
        }
         case "O3" :
        {
            document.getElementById("ripos1").options[5].disabled = false;
        }
		}
        
}
}         
	
function allreq5func(xml) 
{
 var i;
var xmlDoc = xml.responseXML;
var x = xmlDoc.getElementsByTagName('stathmos');
for (i = 0; i <x.length; i++) 
{ 
		switch(x[i].getElementsByTagName('eidos_ripou')[0].childNodes[0].nodeValue)
		{
        case "CO" :
        {
            document.getElementById("ripos4").options[1].disabled = false;
			break;
        }
        case "NO" :
        {
            document.getElementById("ripos4").options[2].disabled = false;
			break;
        }
        case "NO2" :
        {
            document.getElementById("ripos4").options[3].disabled = false;
			break;
        }
        case "SO2" :
        {
            document.getElementById("ripos4").options[4].disabled = false;
			break;
        }
         case "O3" :
        {
            document.getElementById("ripos4").options[5].disabled = false;
        }
		}
}
        
}         
	
function allreq5func2(xml) 
{
 var i;
var xmlDoc = xml.responseXML;
var x = xmlDoc.getElementsByTagName('stathmos');
for (i = 0; i <x.length; i++) 
{ 
		switch(x[i].getElementsByTagName('eidos_ripou')[0].childNodes[0].nodeValue)
		{
        case "CO" :
        {
            document.getElementById("ripos3").options[1].disabled = false;
			break;
        }
        case "NO" :
        {
            document.getElementById("ripos3").options[2].disabled = false;
			break;
        }
        case "NO2" :
        {
            document.getElementById("ripos3").options[3].disabled = false;
			break;
        }
        case "SO2" :
        {
            document.getElementById("ripos3").options[4].disabled = false;
			break;
        }
         case "O3" :
        {
            document.getElementById("ripos3").options[5].disabled = false;
        }
		}
}
        
    
}                     
	             
    function signup()
{
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById("programmerdiv").innerHTML = xhttp.responseText;
        }
      };
      xhttp.open("GET", "script/signuptext.php", true);
      xhttp.send();
}
function showapi()
{
     var mail = document.getElementById("signupform").username.value;
     var password = document.getElementById("signupform").password.value;
     var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
        
        window.prompt("Message from server:",xhttp.responseText);
            
        }
      };
      xhttp.open("GET", "script/signup.php?mail="+mail+"&password="+password, true);
      xhttp.send();
      
}
function showlogin()
{
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById("programmerdiv").innerHTML = xhttp.responseText;
        }
      };
      xhttp.open("GET", "script/adminlogintext.php", true);
      xhttp.send();
      
}
 function proglogin()
{
     var mail = document.getElementById("prloginform").elements.username.value;
     var password = document.getElementById("prloginform").elements.password.value;
     var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
        if (xhttp.responseText!=="1")
        {
        alert(xhttp.responseText);
        }
        else
        {
         window.location.assign("admin/pages");
        }
            
        }
      };
      xhttp.open("GET", "script/adminlogin.php?mail="+mail+"&password="+password, true);
      xhttp.send();
      
}
  function adminlogin()
{
     var mail = document.getElementById("adminloginform").elements.username.value;
     var password = document.getElementById("adminloginform").elements.password.value;
     var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
        if (xhttp.responseText!=="1")
        {
        alert(xhttp.responseText);
        }
        else
        {
         window.location.assign("user/pages");
        }
            
        }
      };
      xhttp.open("GET", "script/userlogin.php?mail="+mail+"&password="+password, true);
      xhttp.send();
      
}
