<?php
//  code to list the contacts
$xml = new DOMDocument();
$xml->load('https://weather-broker-cdn.api.bbci.co.uk/en/forecast/rss/3day/2643743');
echo "<br/><br/>" ;

$xsl = new DOMDocument;
$xsl->load('../view/weather.xsl');

$proc = new XSLTProcessor() ;
$proc->importStyleSheet($xsl);
$result = $proc->transformtoXML($xml) ;

echo $result;
?>
