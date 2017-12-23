<?php

	$isbn = $_POST['isbn'];
	$izenburua = $_POST['izenburua'];
	$idazleKodea = $_POST['idazlea'];
	$hizkuntza = $_POST['hizkuntza'];
	$argitaletxea = $_POST['argitaletxea'];
	$sinopsia = $_POST['sinopsia'];
	$urtea = $_POST['urtea'];
	$stock = $_POST['stock'];
	
	//Idazle kodetik idazle izena lortu
	include 'konexioa.php';
				
	$sqlidazlea = "SELECT izena FROM idazlea where kodea='$idazleKodea'";
	$idazleaerantzuna= $esteka->query($sqlidazlea);
	if (!$idazleaerantzuna) {
		echo 'ezin izan dira idazleak kargatu: ' . $esteka->error;
		exit;
	}

	$idalea =  mysqli_fetch_array($idazleaerantzuna,MYSQLI_ASSOC);
	
	//XML fitxategian gorde liburuaren datuak
	$xml = simplexml_load_file('liburuak.xml'); 
		foreach($xml->children() as $liburuak) { 
			
			if(($liburuak['isbn'])==$isbn){
				die("isbn hori existitzen da");				
			}
		}
		$liburua = $xml->addChild('liburua');
		$liburua->addAttribute('isbn', $isbn);
		$liburua->addAttribute('hizkuntza', $hizkuntza);
		$liburua->addAttribute('idazleKodea', $idazleKodea);		
		$liburua->addChild('izenburua', $izenburua);
		$liburua->addChild('idazleIzena', $idalea['izena']);
		$liburua->addChild('argitaletxea', $argitaletxea);
		$liburua->addChild('sinopsia', $sinopsia);
		$liburua->addChild('urtea', $urtea);
		$liburua->addChild('stock', $stock);
	
	file_put_contents('liburuak.xml', $xml->asXML());

	include 'konexioa.php';
	$argazkia = addslashes(file_get_contents($_FILES['argazkia']['tmp_name']));
	if (!$esteka)
	{ 	
		echo "Hutsegitea MySQLra konetatzerakoan". PHP_EOL;
		echo "depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
		exit;
	}
	//Datu basean gorde liburua
	$sql = "INSERT INTO liburua 
		(isbn, izenburua, idazlea, hizkuntza,argitaletxea, sinopsia, urtea, stock,argazkia) VALUES
		
		('$isbn' ,
		'$izenburua'	,
		'$idazleKodea',
		'$hizkuntza'	,
		'$argitaletxea',
		'$sinopsia'	,
		'$urtea',
		'$stock',
		'$argazkia')";

	$ema=mysqli_query($esteka,$sql);

	if (!$ema){
		die('Errorea query-a gauzatzerakoan: '.mysqli_error($esteka));
	}

	header("Location: liburuakIkusi.php");
    die();



mysqli_close($esteka);

?>