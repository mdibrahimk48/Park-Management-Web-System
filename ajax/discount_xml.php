<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "", "park_sept17");
$query= "SELECT * from discount";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows($ret);
$doc= new DOMDocument();
$doc->formatOutput=true;
$root = $doc->createElement("Discount_Details");
$doc->appendChild($root);
for($i = 0; $i<$num_results; $i++){
	$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
	$node = $doc->createElement("Discount");
	
	$discount_no=$doc->createElement("discount_no");
	$discount_date=$doc->createElement("discount_date");
	$discount_rate=$doc->createElement("discount_rate");
	
	$discount_no->appendChild($doc->createTextNode($row["discount_no"]));
	$discount_date->appendChild($doc->createTextNode($row["discount_date"]));
	$discount_rate->appendChild($doc->createTextNode($row["discount_rate"]));
	
	$node->appendChild($discount_no);
	$node->appendChild($discount_date);
	$node->appendChild($discount_rate);

	$root->appendChild($node);
}
echo $doc->saveXML();
?>