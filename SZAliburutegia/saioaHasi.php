
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
			<?php
				include 'nabigaziobarra.php';
			 ?>
			 


        
    </head>
	<div class="karratua">
    <body>

		<form action="saioaHasiPHP.php" enctype="multipart/form-data" method="post" id = "saioaHasi" >


			<label><b>Posta</b></label>
			<input type="text" placeholder="Posta" name="posta" id="posta" required>

			<label><b>Pasahitza</b></label>
			<input type="password" placeholder="Pasahitza" name="pasahitza" id="pasahitza" required>

			<button type="submit" class="submitbtn">Saioa hasi</button>

		</form>
    </div>   

    </body>
</html>
