<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		if($_SESSION['mota']=='BAZKIDEA'){
			$isbn = $_GET['isbn'];
			$posta = $_SESSION['posta'];
			$itzulia = 'EZ';

			include 'konexioa.php';
			if (!$esteka)
			{ 	
				echo "Hutsegitea MySQLra konetatzerakoan". PHP_EOL;
				echo "depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
				exit;
			}
			//Lehenik eta behin, liburua alokatuta dagoen ikusi
			$sql = "SELECT * FROM liburulista WHERE isbn = '$isbn' AND itzulia='$itzulia ' ";
			$erantzuna = mysqli_query($esteka,$sql);			  
			$count = mysqli_num_rows($erantzuna);

			if($count>0){
				echo "Alokatuta daukazu iadanik";
			}else{
			
			
				//Gero, alokatuko den liburua, stock-a geratzen den ikusi:
				$xml=simplexml_load_file("liburuak.xml") or die("Error: Cannot create object");
			
				foreach($xml->children() as $liburuak) { 
					
					if(($liburuak['isbn'])==$isbn){
						$stock=$liburuak->stock;
						//behin stock-a daukagula, aleak gelditzen diren ikusi
						if($stock>0){
							//geratzen badira, -1 egin, XML fitxategian eta datu basean
							$stock=$stock-1;
							$liburuak->stock=$stock;
							
							$sqlekintza="UPDATE liburua SET 
							stock='$stock'
							WHERE isbn='$isbn'";
							$emaitza=$esteka->query($sqlekintza);
							//azkenik, eragiketa erregistratu
							$sql = "INSERT INTO liburulista
								(isbn, posta, itzulia) VALUES
								
								('$isbn' ,
								'$posta',
								'$itzulia')";
							$ema=mysqli_query($esteka,$sql);
							if (!$ema){
								die('Errorea query-a gauzatzerakoan: '.mysqli_error($esteka));
							}
							echo "OK";

							
						}else{
							echo "Ez dago alerik";
						}
					}
				}
				file_put_contents('liburuak.xml', $xml->asXML());				
				mysqli_close($esteka);
			}
	}else{
		header("Location: liburuakIkusi.php");
	}
}else{
		header("Location: erregistratu.php");
}	
?>