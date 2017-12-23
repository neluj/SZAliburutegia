<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<title>Erregistratu</title>
		<script type="text/javascript">


      xhro = new XMLHttpRequest();
  		xhro.onreadystatechange = function(){
  			if ((xhro.readyState==4)){
          if(xhro.responseText=="Posta onartua"){
            document.getElementById("onartuaPosta").innerHTML=xhro.responseText;
            document.getElementById("ezeztatuaPosta").innerHTML="";
          }else if(xhro.responseText=="*Posta hori ez dago matrikulatuta Web Sistemetan"){
            document.getElementById("ezeztatuaPosta").innerHTML=xhro.responseText;
            document.getElementById("onartuaPosta").innerHTML="";
          }
          botoia();
  			}
  		}

  		function postaEgiaztatu(email){
        //document.getElementById("ezeztatuaPosta").innerHTML= xhro2.responseText;
  			var posta = document.getElementById("posta").value;
  			emaila="email="+posta;

  			xhro.open("POST","nusoapPosta.php", true);
  			xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  			xhro.send(emaila);
  		}

			function botoia(){
						var izena,pos,pasahitz = false;
						var nam = document.getElementById("erabizena").value;
						if (!(nam == null|| nam == "")) {
							izena=true;
						}

						var posta = document.getElementById("posta").value;
						if (!(posta == null || posta == "")) {
							//var ok = new RegExp (/^[a-z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/);
							if (document.getElementById("onartuaPosta").innerHTML =="Posta onartua") {
                  pos=true;
							}
						}

          var pass = document.getElementById("passwd").value;
          if(pass.length >= 6){
            var passR = document.getElementById("passwdR").value;
            if(pass == passR){
               pasahitz = true;
               document.getElementById("ezeztatuaPass").innerHTML="";
               document.getElementById("onartuaPass").innerHTML="Pasahitz egokia";
            }
            else if((passR == null || passR == "") || (pass == null || pass == "")){
              document.getElementById("onartuaPass").innerHTML="";
              document.getElementById("ezeztatuaPass").innerHTML="";

            }else{
              document.getElementById("ezeztatuaPass").innerHTML="Pasahitzak ez datoz bat";
              document.getElementById("onartuaPass").innerHTML="";

            }
          }
          else if(!(pass == null || pass == "")){
            document.getElementById("ezeztatuaPass").innerHTML="Pasahitza luzeago izan behar da";
            document.getElementById("onartuaPass").innerHTML="";
          }

          if((izena && pos && pasahitz)==true){
            document.getElementById("erregBotoia").disabled=false;
          }
          else{
             document.getElementById("erregBotoia").disabled=true;

          }
			}


		</script>


		<?php
		//Saioa hasita baldinbadagoen ikusi, eta hola bada, erabiltzailearen datuak editatu egingo dira
		//Posta era erabiltzaile izena ezingo dira editatu, beraz, jquery bitartez datuak inputetan kargatu
		//eta ezgaitu egingo dira.
			include 'nabigaziobarra.php';
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				$editatu=true;
				$posta= $_SESSION['posta'];
				$erabiltzaileizena= $_SESSION['erabiltzaileizena'];
				?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
				<script>
				$(function() {
					$("#erabizena").val("<?php echo $erabiltzaileizena; ?>");
					$("#erabizena").prop('disabled', true);
					$("#posta").val("<?php echo $posta; ?>");
					$("#posta").prop('disabled', true);
				})
				</script>
			<?php
			}else{
				$editatu=false;
			}
			?>

				</head>

				<body>
				<div class="karratua">
					<!--Saioa hasita badago, datuakin UPDATE egingo da. Bestela, erabiltzaile berria sortuko da -->
					<form <?php if($editatu==false){ echo 'action="erabiltzaileaEnroll.php"';} else{echo 'action="erabiltzaileaEditatu.php"';} ?> enctype="multipart/form-data" method="post" id = "erregistro" name = "erregistro" >
						<p>
						<label><b>Erabiltzaile izena</b></label>
						<input type="text" placeholder="Sartu erabiltzaile izena" id="erabizena"  name="erabizena"  oninput="botoia();" >
						<p>
						<label><b>Posta</b></label>
						<input type="text" placeholder="Sartu Posta" id="posta" name="posta"  oninput="postaEgiaztatu(this.value);" >
						<p>
						<label><b>Pasahitza</b></label>
						<input type="password" placeholder="Sartu pasahitza"  id="passwd" name="pasahitz"  oninput="botoia();" >
						<p>
						<label><b>Errepikatu pasahitza</b></label>
						<input type="password" placeholder="Sartu pasahitza"  id="passwdR" name="passwdR"  oninput="botoia();" >
						<p>
						<label><b>Argazkia</b></label>
						<p>
						<input type="file" id="argazkia" name="argazkia" >
						<p>
						<p>
						<p>
						<input type="submit"  class="submitbtn" id="erregBotoia" disabled="false" value="Erregistratu">

					  <div style="background-color:#f1f1f1">
							<div id="onartuaPosta" class="onartuaMezua"></div>
							<div id="ezeztatuaPosta" class="erroreMezua"></div>
							<div id="onartuaPass" class="onartuaMezua"></div>
							<div id="ezeztatuaPass" class="erroreMezua"></div>
					  </div>
					</form>

				</div>
				</body>
</html>
