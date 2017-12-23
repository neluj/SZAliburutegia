
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<?php
	include 'nabigaziobarra.php';
	echo'</head>';
	//KODEA GET eskaerarik dagoen ikusi
	if (isset($_GET['kod'])){
		$kodea = $_GET['kod'];

		/**********************************************************************/
		include 'konexioa.php';

		$sqlidazlea = "SELECT * FROM idazlea WHERE kodea='$kodea' ";
		$idazleaerantzuna= $esteka->query($sqlidazlea);
		if (!$idazleaerantzuna) {
			echo 'ezin izan da erantzuna kargatu: ' . $esteka->error;
		}
		$count = mysqli_num_rows($idazleaerantzuna);
		if($count!=1){
			die ("idazle hori ez da existitzen");
		}
		else{

			$idazlea =  mysqli_fetch_array($idazleaerantzuna,MYSQLI_ASSOC);
			$argazkia = base64_encode($idazlea['argazkia']);

			//idazlearen datuak erakutsik

			echo '<div class="karratua">';
			echo '<div class="textua">';
				echo'<p>';
				echo'<p>';
				echo'<p>';
				echo '<img height="200px" src="data:image/jpg;base64,'.$argazkia.'"/>';
				echo'<p>';
				echo'<p>';
				echo'<p>';
				echo '<label><b>IZENA</b></label>';
				echo $idazlea['izena'];
				echo'<p>';
				echo'<p>';
				echo'<p>';
				echo '<label><b>JAIOTERRIA</b></label>';
				echo $idazlea['jaioterria'];
				echo'<p>';
				echo'<p>';
				echo'<p>';
				echo '<label><b>BIOGRAFIA</b></label>';
				echo $idazlea['biografia'];

			echo '</div>';
			echo '</div>';


			/**********************************************************************/
		}
	}else{
		header("Location: liburuakIkusi.php");
	}

	?>
</html>
