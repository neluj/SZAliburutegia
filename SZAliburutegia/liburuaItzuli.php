<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		if($_SESSION['mota']=='BAZKIDEA'){
			$kodea = $_GET['kod'];	
			$posta = $_SESSION['posta'];

			include 'konexioa.php';
			if (!$esteka)
			{ 	
				echo "Hutsegitea MySQLra konetatzerakoan". PHP_EOL;
				echo "depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
				exit;
			}
			
			//lehenik, saioa hasitako erabiltzailea eta eragiketarena berdina den ikusi behar da,
			//beste bazkide batek bestela GET parametro baten bitartez beste erabiltzaile baten 
			//liburua itzuli ahal izango bait du. ISBN ere hartuko dugu, aurrerago liburu horren stock-ean
			//+1 egin ahal izateko (datu basean eta XML fitxategian) 

			$sqlIsbn = "SELECT isbn FROM liburulista WHERE kod = '$kodea' AND posta ='$posta'";
			$isbnErantzuna= $esteka->query($sqlIsbn);
			if (!$isbnErantzuna) {
				echo 'ezin izan da kontsulta egin: ' . $esteka->error;
				exit;
			}
			$isbn=  mysqli_fetch_array($isbnErantzuna,MYSQLI_ASSOC);
			$count = mysqli_num_rows($isbnErantzuna);
			if($count!=1){
				header("Location: erregistratu.php");
			}else{		
				//kodea get parametrobidez pasatuko denez, liburulistako elementua billatu eta itzuliari "BAI"
				//balioa jarriko diogu
				$isbn = $isbn['isbn'];
				$sqlekintza="UPDATE liburulista SET 
				itzulia='BAI'
				WHERE kod='$kodea'";
				$emaitza=$esteka->query($sqlekintza);

				
				//Gero, alokatuko den liburuan, stock-a +1 egin datu basean eta XML fitxategian
				$xml=simplexml_load_file("liburuak.xml") or die("Error: Cannot create object");
			
				foreach($xml->children() as $liburuak) { 
					
					if(($liburuak['isbn'])==$isbn){
						$stock=$liburuak->stock;
						//behin stock-a daukagula, aleak gelditzen diren ikusi
						//+1 egin, XML fitxategian eta datu basean
						$stock=$stock+1;
						$liburuak->stock=$stock;
						
						$sqlekintza="UPDATE liburua SET 
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
				header("Location: liburuakIkusi.php");
				
			}
	}else{
		header("Location: liburuakIkusi.php");
	}
}else{
		header("Location: erregistratu.php");
}	
?>