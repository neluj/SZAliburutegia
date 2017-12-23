<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$ns="http://most.hol.es/egiaztatuPasahitza.php?wsdl";
	$server = new soap_server;
	$server->configureWSDL('egiaztatuP',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;

	$server->register('egiaztatuP',array('x'=>'xsd:int'),array('z'=>'xsd:string'),$ns);

	function egiaztatuP($pasahitz){
		$fitxategia = fopen("toppasswords.txt", "r");
		$berdinak = false;

		while (($fitxHitza = fgets($fitxategia)) && $berdinak == false){
			$fitxHitza = rtrim($fitxHitza, "\r\n");
			if(strcmp($fitxHitza,$pasahitz)===0){$berdinak = true;}
		}

		fclose($fitxategia);
		if ($berdinak == true){return "BALIOGABEA";}
		if ($berdinak== false){return "BALIOZKOA";}
	}

	if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
	$server->service($HTTP_RAW_POST_DATA);
?>
