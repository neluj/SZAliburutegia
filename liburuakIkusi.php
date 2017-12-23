<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<title>Liburu Lista</title>

	<?php
		include 'nabigaziobarra.php';
	 ?>
	</head>

    <body>

		<div class="karratua">
            <?php
				ob_start();
				include 'liburuakXSL.php';
				$emaitza = ob_get_clean();

            	$xslDoc = new DOMDocument();
            	$xslDoc->loadXml($emaitza);
            	$xmlDoc = new DOMDocument();
            	$xmlDoc->load('liburuak.xml');
            	$proc = new XSLTProcessor();
            	$proc->importStylesheet($xslDoc);
            	echo $proc->transformToXML($xmlDoc);
            ?>

		</div>
    </body>
</html>
