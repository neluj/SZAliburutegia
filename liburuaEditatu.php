<?php



		$isbn = $_POST['isbn'];
		$izenburua = $_POST['izenburua'];
		$idazleKodea = $_POST['idazlea'];
		$hizkuntza = $_POST['hizkuntza'];
		$argitaletxea = $_POST['argitaletxea'];
		$sinopsia = $_POST['sinopsia'];
		$urtea = $_POST['urtea'];
		$stock = $_POST['stock'];
		
		include 'konexioa.php';
		if (!$esteka)
		{ 	
			echo "Hutsegitea MySQLra konetatzerakoan". PHP_EOL;
			echo "depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
			exit;
		}	
		$sqlidazlea = "SELECT izena FROM idazlea where kodea='$idazleKodea'";
		$idazleaerantzuna= $esteka->query($sqlidazlea);
		if (!$idazleaerantzuna) {
			echo 'ezin izan dira idazleak kargatu: ' . $esteka->error;
			exit;
		}

	$idalea =  mysqli_fetch_array($idazleaerantzuna,MYSQLI_ASSOC);
		
		//Lelen, XML fitxategian isbn-a aurkituko dugu
		$xml=simplexml_load_file("liburuak.xml") or die("Error: Cannot create object");
	
		foreach($xml->children() as $liburuak) { 
			
			if(($liburuak['isbn'])==$isbn){
				//behin liburua aurkituta, balio berriak sartuko ditugu
				$liburuak['hizkuntza']=$hizkuntza;				
				$liburuak['idazleKodea']=$idazleKodea;	
				$liburuak->izenburua=$izenburua;
				$liburuak->idazleIzena=$idalea['izena'];
				$liburuak->argitaletxea=$argitaletxea;				
				$liburuak->sinopsia=$sinopsia;	
				$liburuak->urtea=$urtea;
				$liburuak->stock=$stock;				
								
				$sqlekintza="UPDATE liburua SET 
				izenburua='$izenburua',
				idazlea='$idazleKodea',
				hizkuntza='$hizkuntza',
				argitaletxea='$argitaletxea',
				sinopsia='$sinopsia',
				urtea='$urtea',
				stock='$stock'
				WHERE isbn='$isbn'";
				$emaitza=$esteka->query($sqlekintza);

				if (!$emaitza){
					die('Errorea query-a gauzatzerakoan: '.mysqli_error($esteka));
				}

					
			}
		}
		file_put_contents('liburuak.xml', $xml->asXML());				
		mysqli_close($esteka);
	    header("Location: liburuaInfo.php?isbn=".$isbn);


?>