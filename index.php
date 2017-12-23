<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

			<?php
				include 'nabigaziobarra.php';
			 ?>
         <title>Liburutegia</title>
    </head>

    <body>
	<div class="karratua" margin="60%">
    <label><h1>Liburutegia</h1></label>
    <p>
      <div class="textua">
    Ikastetxe Nagusian bi ikasketa gela daude.
   Horietan liburuak daude ikasle guztien eskura, entziklopediak (Espasa Calpe, Británica,
    Larousse), atlasak, arte liburuak, laburpenak eta beste izanik.
<p>
<b><h3>Lana banakaz  egiteko liburutegia</h3></b>
<p>
Isiltasuna funtsezkoa eta derrigorrezkoa da. Eskuko telefonoak itzali edo deskonektatu egin behar dira.

Gela hau klimatizatua dago; neguan berogailu dago eta udan aire girotua. 56 leku ditu
<p>
<b><h3>Lana taldekaz egiteko liburutegia</h3></b>
<p>
Talde lanak egiteko prestatuta dago. Lagunei ez molestatzeko ahalik eta isilik egotea eta
 egoki portatzea eskatzen da. 32 plaza daude.

   Liburutegi honetan 7 ordenagailu daude.

   Ikasleek eta egoiliarrek modu librean erabili ahal dituztenak.

   Ordenagailuak interneti konektatuta daude EHUren sarearen bitartez.

   Dokumentoak inprimatzeko atezaintzako fotokopiagailuaren bidez egin dezakete.
  <p>
  <p>

    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 43.307203, lng: -2.010842000000025};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABAyeZlkgtf10hIbDZUncmfUPcjpVWYWI&callback=initMap">
    </script>
  </div>
     </div>
    </body>
</html>
