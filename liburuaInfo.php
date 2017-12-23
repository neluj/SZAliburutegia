
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<?php
	include 'nabigaziobarra.php';
	echo'</head>';
	//ISBN GET eskaerarik dagoen ikusi
	if (isset($_GET['isbn'])){
		$aurkitua=false;
		$isbn = $_GET['isbn'];
		$xml=simplexml_load_file("liburuak.xml") or die("Error: Cannot create object");

		//XML fitxategiko liburuak irakurri, bakoitzaren isbn atributua ikusi eta GET isbn-ren berdina bada,
		//bilatzen ari garen liburua aurkitu dugu. Datuak aldagaietan gordeko ditugu.
		//Zuzenean datu basetik bilatu dezakegu, argazkia bertan bakarrik bait dago, baina
		//ariketa XML fitxategian bilatzea da.
		foreach($xml->children() as $liburuak) {

			if(($liburuak['isbn'])==$isbn){
				$hizkuntza=$liburuak['hizkuntza'];
				$izenburua=$liburuak->izenburua;
				$idazleIzena=$liburuak->idazleIzena;
				$argitaletxea=$liburuak->argitaletxea;
				$sinopsia=$liburuak->sinopsia;
				$urtea=$liburuak->urtea;
				$stock=$liburuak->stock;
				$sinopsia=$liburuak->sinopsia;
				//liburua existitzen dela dakigu
				$aurkitua=true;
			}
		}
		//liburua aurkitu bada, hemenbere datuak erakutsiko ditugu
		if($aurkitua==true){
		/**********************************************************************/
		//Liburuaren azaleko argazkia lortu
		include 'konexioa.php';

		$sqlargazkia = "SELECT argazkia FROM liburua WHERE isbn='$isbn' ";
		$argazkiaerantzuna= $esteka->query($sqlargazkia);
		if (!$argazkiaerantzuna) {
			echo 'ezin izan da argazkia kargatu: ' . $esteka->error;
		}
		$argazkiaLISTA =  mysqli_fetch_array($argazkiaerantzuna,MYSQLI_ASSOC);
		$argazkia = base64_encode($argazkiaLISTA['argazkia']);

		//liburuaren datuak erakutsik

		echo '<div class="karratua">';
		echo '<div class="textua">';
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<img height="200px" src="data:image/jpg;base64,'.$argazkia.'"/>';
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>ISBN</b></label>';
			echo $isbn;
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>IZENBURUA</b></label>';
			echo $izenburua;
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>IDAZLEA</b></label>';
			echo $idazleIzena;
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>HIZKUNTZA</b></label>';
			echo $hizkuntza;
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>ARGITALETXEA</b></label>';
			echo $argitaletxea;
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>SINOPSIA</b></label>';
			echo $sinopsia;
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>URTEA</b></label>';
			echo $urtea;
			echo'<p>';
			echo'<p>';
			echo'<p>';
			echo '<label><b>LIBURUTEGIAN GERATZEN DIREN ALEAK</b></label>';
			echo $stock;
		echo '</div>';
		echo '</div>';


		/**********************************************************************/
		}else{
			header("Location: liburuakIkusi.php");
		}


	}else{
		header("Location: liburuakIkusi.php");
	}

	?>
    </body>
</html>
