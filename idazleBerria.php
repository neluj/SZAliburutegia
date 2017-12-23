<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			if($_SESSION['mota']=='LANGILEA'){
 ?>
<form action="idazleaEnroll.php" enctype="multipart/form-data" method="post" id = "saioaHasi" >
	<p>
	<label><b>IZENA</b></label>
	<input type="text" placeholder="Izena" name="izena" id="izena" required>
	<p>				
	<label><b>JAIOTERRIA</b></label>
	<input type="text" placeholder="Jaioterria" name="jaioterria" id="jaioterria" required>
	<p>					
	<label><b>BIOGRAFIA</b></label>			
	<textarea type="text" placeholder="Idatzi hemen idazlearen biografia..." name="biografia" id="biografia" rows="7"  ></textarea>
	<p>	
	<label><b>ARGAZKIA</b></label>				
	<input type="file" id="argazkia" name="argazkia" >
	<p>
	<p>
	<p>			

	<button type="submit" class="submitbtn">Gorde</button>
</form>  
	<?php
			}else{
					header("Location: erregistratu.php");
			}
		}else{
				header("Location: erregistratu.php");
		}


	?>
