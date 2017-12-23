<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$soapclient = new nusoap_client("http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl",true);
	$emaitza = $soapclient->call('egiaztatuE',array( 'x'=>$_POST['email']));

	if ($emaitza == "BAI"){echo "Posta onartua";}
	if($emaitza == "EZ"){echo "*Posta hori ez dago matrikulatuta Web Sistemetan";}
?>
