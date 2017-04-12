<!DOCTYPE html>
<?php
  //logout user
    session_start();
    unset($_SESSION['userName']);
    session_destroy();
?>
<html lang="en">
    
    <head>
        <title>Greek Pollution</title>
        <meta name="viewport" charset="utf-8" content="initial-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="../assets/css/mainstyle.css">
        <script type="text/javascript" src="../assets/js/Script.js"></script>
        <script type="text/javascript" src="../assets/js/mapjs.js"></script>
   	    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVWuhEEScGPSrcnDu4DQp30OCAmJoyMsQ&libraries=geometry,visualization&callback=showmarkers" type="text/javascript"></script>
       
    </head>
    
    <!--fortwnei ta javascript functions-->
    <body onload="req1loadXMLDoc();allreq4loadXMLDoc();">
    <br><div id="title">Greek Pollution</div>
    	
    <div id="mainpage">
    <!--Xarths-->
        <div id = maparea ><div id="map"></div></div>
        <div id="maintable">
        <table id='basictable'></table>             
        </div> 
        <div id="showinfo">
          <div id="loginswrapper">
          
            <div class="admindiv" id="admindiv">
              <h4 class="login">User Login</h4>
              <form id="adminloginform" > 
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
              </form>
              <input  class="prbutton" id="button" type="submit" name="submit" value="Enter" onclick="adminlogin()">
            </div>
            
            <br>
            <br>
            
            <div id="programmerdiv">
              <h4 class="login">Admin Login</h4>
              <form class="prloginform" id="prloginform">
              	<input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
              </form>
              <input  class="prbutton" id="loginbutton" type="submit" name="submit" value="Enter" onclick="proglogin()">
              <input  class="prbutton" id="signupbutton" type="submit" name="submit" value="Signup" onclick="signup()">
            </div>
            
          </div>
            <button id="optionsbutton" onclick="showstations();" >Show Options</button>
            <div  class="dropit" id="showoptions"> 
                    <select id="dropdowninfo" onchange="selectshow();">
                        <option value="0" >Choose One</option>
                        <option value="1" >Show One</option>
                        <option value="2">Show All</option>
                    </select>                    
            </div>
                    
                    
                    <div id="showone" class="showone">
                        <form name="stationsshow">
                        <select name="dropdownstation" class="dropthebit" id="dropdownstation"></select>
                        
                        </form>
                        <button onclick="stationshowaction();" class="infobuttons" >Submit</button>
                        <div  id="radioshow">
                        <form>
                        Specific Date and Time&nbsp;
                        <input type="radio" name="date" onclick="dateselect(this.value)" value="1"><br>Date Range
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="date" onclick="dateselect(this.value)" value="2" >
                        </form>
                        </div>
                        <div id="singledate">
                            <form name="date" action="javascript:req2loadXMLDoc();"  method="post">
                                Date:<input id="date1" type="date" onChange="date1change();" ><br>
                                Time:<select class="dropthebit" id="time">
                                    <option value="">Choose One</option>
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select><br>
                                Select Pollutant Type:<br>
                                <select class="dropthebit" id="ripos1" name="ripos" >
                                    <option value="">Choose One</option>
                                    <option id="CO1" disabled value="CO">CO</option>
                                    <option id="NO1" disabled value="NO">NO</option>
                                    <option id="NO21" disabled value="NO2">NO2</option>
                                    <option id="SO21" disabled value="SO2">SO2</option>
                                    <option id="O31" disabled value="O3">O3</option>
                                </select><br>
                                <input type="submit" value="Show" class="infobuttons">
                            </form>
                       
                        
                        
                        
                        </div>
                        <div id="multipledates">
                             <form name="fromtodate" action="javascript:req3loadXMLDoc();" method="post">
                                From:<input type="date" id="fromdate1" onChange="fromtodate1change();" ><br>
                                To:<input type="date" id="todate1" onChange="fromtodate1change();"><br>
                                Select Pollutant Type:<br>
                                <select class="dropthebit" id="ripos2" name="ripos">
                                    <option value="">Choose One</option>
                                    <option id="CO2" disabled value="CO">CO</option>
                                    <option id="NO2" disabled value="NO">NO</option>
                                    <option id="NO22" disabled value="NO2">NO2</option>
                                    <option id="SO22" disabled value="SO2">SO2</option>
                                    <option id="O32" disabled value="O3">O3</option>
                                </select><br>
                                <input type="submit" value="Show" class="infobuttons">
                            </form>
                        </div>
                        
                       
                    </div>
                    
                    
                    
                     <div id="showall" class="showall">
                           
                        <div  id="allradioshow">
                        <form>
                        Specific Date and Time&nbsp;
                        <input type="radio" name="date" onclick="alldateselect(this.value)" value="1" ><br>Date Range&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="date" onclick="alldateselect(this.value)" value="2" >
                        </form>
                        </div>
                        <div id="allsingledate">
                            <form name="alldate" action="javascript:allreq2loadXMLDoc();"  method="post">
                                Date:<input type="date" id="date2" onChange="date2change();"><br>
                                Time:<select class="dropthebit" id="alltime">
                                    <option value="">Choose One</option>
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select><br>
                                Select Pollutant Type:<br>
                                <select class="dropthebit" id="ripos3" name="ripos" >
                                    <option value="">Choose One</option>
                                    <option disabled id="CO3" value="CO">CO</option>
                                    <option disabled id="NO3" value="NO">NO</option>
                                    <option disabled id="NO23" value="NO2">NO2</option>
                                    <option disabled id="SO23" value="SO2">SO2</option>
                                    <option disabled id="O33" value="O3">O3</option>
                                </select><br>
                                <input type="submit" value="Show" class="infobuttons">
                            </form>
                       
                        
                        
                        
                        </div>
                        <div id="allmultipledates">
                             <form name="allfromtodate" action="javascript:allreq3loadXMLDoc();" method="post">
                                From:<input type="date" id="fromdate2" onChange="fromtodate2change();" ><br>
                                To:<input type="date" id="todate2" onChange="fromtodate2change();" ><br>
                                Select Polluant Type:<br>
                                <select class="dropthebit" id="ripos4" name="ripos">
                                    <option value="">Choose One</option>
                                    <option id="CO4" disabled value="CO">CO</option>
                                    <option id="NO4" disabled value="NO">NO</option>
                                    <option id="NO24" disabled value="NO2">NO2</option>
                                    <option id="SO24" disabled value="SO2">SO2</option>
                                    <option id="O34" disabled value="O3">O3</option>
                                </select><br>
                                <input type="submit" value="show" class="infobuttons" >
                            </form>
                        </div>   
                       
                    </div>
                    
                    
            </div>
       <button id="reset" onclick="location.href = 'index.php';">RESET</button>
       <footer><b id="fl">Web Project 2015-2016</b>   <b id="fr">Created By Team Spaaaaace</b></footer>  
            
      </div>
   
    </body>
</html>
