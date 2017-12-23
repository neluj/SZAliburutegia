<?php
include 'nabigaziobarra.php';	
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	if($_SESSION['mota']=='LANGILEA'){
		if(isset($_GET['isbn'])){
			
			$isbn=$_GET['isbn'];
					
			//Lelen, XML fitxategian isbn-a aurkituko dugu
			$xml=simplexml_load_file("liburuak.xml") or die("Error: Cannot create object");
		
			foreach($xml->children() as $liburua) { 
				
				if(($liburua['isbn'])==$isbn){
					//behin liburua aurkitutaborratu egingo dugu fitxategitik eta datu basetik					
					$dom=dom_import_simplexml($liburua);
					$dom->parentNode->removeChild($dom);
					
					include 'konexioa.php';					
					$sqlekintza="DELETE FROM liburua WHERE isbn='$isbn'";
					$emaitza=$esteka->query($sqlekintza);

					if (!$emaitza){
						die('Errorea query-a gauzatzerakoan: '.mysqli_error($esteka));
					}

						
				}
			}
			file_put_contents('liburuak.xml', $xml->asXML());				
			mysqli_close($esteka);
			header("Location: liburuakIkusi.php");
				
			
			
			
			
		}else{
			header("Location: erregistratu.php");
		}			
	}else{
		header("Location: erregistratu.php");
	}
}else{
header("Location: erregistratu.php");
}


?>