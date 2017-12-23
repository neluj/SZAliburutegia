
<?php

	include 'konexioa.php';

	$posta = mysqli_real_escape_string($esteka,$_POST['posta']);
	$sql = "SELECT * FROM erabiltzailea WHERE Posta = '$posta'";

	$erantzuna = mysqli_query($esteka,$sql);     
    $count = mysqli_num_rows($erantzuna);
	if($count!=0){
		die("Posta hori iadanik erregistratuta dago");
	}
if (!filter_var($posta, FILTER_VALIDATE_EMAIL) === false) {

	if (!$esteka)
	{ 	
		echo "Hutsegitea MySQLra konetatzerakoan". PHP_EOL;
		echo "depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
		exit;
	}

    $pass=mysqli_real_escape_string($esteka,$_POST['passwd']);
	$passkript = sha1($pass);
	$mota = 'BAZKIDEA';
	$argazkia = addslashes(file_get_contents($_FILES['argazkia']['tmp_name']));
	$sql = "INSERT INTO erabiltzailea 
		(erabiltzaileizena, posta, pasahitza, mota,argazkia) VALUES
		
		('$_POST[erabizena]' ,
		'$_POST[posta]'	,
		'$passkript',
		'$mota',
		'$argazkia')";

	$ema=mysqli_query($esteka,$sql);

	if (!$ema){
		die('Errorea query-a gauzatzerakoan: '.mysqli_error($esteka));
	}

	header("Location: index.php");
    die();


} else {
  echo("$posta ez da zuzena");
}
mysqli_close($esteka);

?>
