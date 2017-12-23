
<?php

	include 'konexioa.php';

	$izena = $_POST['izena'];
	$jaioterria = $_POST['jaioterria'];
	$biografia = $_POST['biografia'];
	$argazkia = addslashes(file_get_contents($_FILES['argazkia']['tmp_name']));
	
	if (!$esteka)
	{ 	
		echo "Hutsegitea MySQLra konetatzerakoan". PHP_EOL;
		echo "depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
		exit;
	}

	$sql = "INSERT INTO idazlea 
		(izena, jaioterria, biografia, argazkia) VALUES
		
		('$izena' ,
		'$jaioterria'	,
		'$biografia',
		'$argazkia')";

	$ema=mysqli_query($esteka,$sql);

	if (!$ema){
		die('Errorea query-a gauzatzerakoan: '.mysqli_error($esteka));
	}

	header("Location: liburuKudeaketa.php");
    die();



mysqli_close($esteka);

?>
