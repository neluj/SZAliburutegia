<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	include 'konexioa.php';
	//posta ezindenez aldatu, sessiotik hartuko dugu balioa
	$posta= $_SESSION['posta'];
	$mota=$_SESSION['mota'];
	$pass=mysqli_real_escape_string($esteka,$_POST['passwd']);
	$passkript = sha1($pass);
	$argazkia = addslashes(file_get_contents($_FILES['argazkia']['tmp_name']));

	
	$sqlekintza="UPDATE erabiltzailea SET 
	pasahitza='$passkript', 
	mota='$mota', 
	argazkia='$argazkia'
	WHERE posta='$posta'";
	
	$emaitza=$esteka->query($sqlekintza);
	if(!$emaitza) {
		echo("Ezin izan da erabiltzailea eguneratu: ".$esteka->error);
	} else {
		//ondo burutu bada eragiketa, sesioko datuak ere berriztu beharko ditugu.Kasu honetan, soilik argazkia 
		//aldatu beharko da, pasahitza ez bait da gordetzen $_SESSION arrayan eta posta eta erabiltzaile izena ezin direlako aldatu
		//zuzenean $argazkia aldagaitik ez dut lortu egitea, bera, datubasetik berreskuratu behar izan dut balioa (blob motatik itzuli)
		$sqlerabmota = "SELECT argazkia FROM erabiltzailea WHERE posta='$posta'";
		$erabiltzaileaerantzuna= $esteka->query($sqlerabmota);
		if (!$erabiltzaileaerantzuna) {
			echo 'ezin izan da kontsulta egin: ' . $esteka->error;
			exit;
		}
		$erabiltzailea =  mysqli_fetch_array($erabiltzaileaerantzuna,MYSQLI_ASSOC);
		
		$_SESSION['argazkia'] = base64_encode($erabiltzailea['argazkia']);		

		header("Location:erabiltzailePanela.php");
	}

	mysqli_close($esteka);
	}else{
				header("Location: erregistratu.php");
		}
?>