
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<?php
			include 'nabigaziobarra.php';

		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				//saioa hasita dagoen erabiltzailearen posta (kodea) eta mota, bakoitza
				//aldagai batean gordeko dugu, errezago egiteko
				$posta= $_SESSION['posta'];
				$mota=$_SESSION['mota'];
				 ?>
				<script src="https://code.jquery.com/jquery-2.2.4.js">	</script>
				<script>

				function editatuErabiltzailea(){
						window.location.href= ("erregistratu.php");
				}

				$(document).ready(function(){
					$("#itzulitakoakIkusi").on("click", function(e){
						e.preventDefault();
						$("#liburuLista").load("liburuLista.php?itzulia=BAI");
					});
				});
				$(document).ready(function(){
					$("#itzuligabeakIkusi").on("click", function(e){
						e.preventDefault();
						$("#liburuLista").load("liburuLista.php?itzulia=EZ");
					});
				});
				</script>

				</head>
				<body>
				<div class="karratua">
				<?php
					echo '<div class="textua">';

					$posta= $_SESSION['posta'];
					$erabiltzaileizena= $_SESSION['erabiltzaileizena'];
					$mota= $_SESSION['mota'];
					$argazkia= $_SESSION['argazkia'];

					echo'<p>';
					echo'<p>';
					echo'<p>';
					echo '<img height="200px" src="data:image/jpg;base64,'.$argazkia.'"/>';
					echo'<p>';
					echo'<p>';
					echo'<p>';
					echo '<label><b>ERABILTZAILE IZENA</b></label>';
					echo $erabiltzaileizena;
					echo'<p>';
					echo'<p>';
					echo'<p>';
					echo '<label><b>POSTA</b></label>';
					echo $posta;
					echo'<p>';
					echo'<p>';
					echo'<p>';
					echo '<label><b>ERABILTZAILE MOTA</b></label>';
					echo $mota;

					echo '</div>';
				?>
						<!--Botoia klikatzerakoan, javascript funtzioari deia egingo dio eta bertatik erregistratzeko panelera bidaliko da(gehiagorako, ikusi erregistratu.php-ko komentarioak)-->
						<input type="button" id="erabiltzaileaEditatu"  class="actionbtn" onclick="editatuErabiltzailea();" value="Datuak editatu"/>
						<!--Botoia klikatzerakoan, JQUERY bidez dagokion taula itzultzen duen fitxategiari deia egingo dio eta emaitza liburuLista div-ean kargatuko du-->
						<?php
						if($mota=="BAZKIDEA"){
							echo'<input type="button" id="itzulitakoakIkusi" class="actionbtn"  href="#" value="Itzulitako liburuak ikusi"/>';
							echo'<input type="button" id="itzuligabeakIkusi" class="actionbtn"  href="#" value="Itzulitako gabeko ikusi"/>';
						}
						?>
						<div id="liburuLista">
						</div>
				</div>
				<?php

		}else{
				header("Location: erregistratu.php");
		}


	?>
    </body>
</html>
