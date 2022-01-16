<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "", "park_sept17");
$query= "SELECT * from animal";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows($ret);
$doc= new DOMDocument();
$doc->formatOutput=true;
$root = $doc->createElement("Animal_Details");
$doc->appendChild($root);
for($i = 0; $i<$num_results; $i++){
	$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
	$node = $doc->createElement("Animal");
	
	$animal_id=$doc->createElement("animal_id");
	$animal_name=$doc->createElement("animal_name");
	$animal_image=$doc->createElement("animal_image");
	$animal_description=$doc->createElement("animal_description");
	$animal_quantity=$doc->createElement("animal_quantity");
	
	$animal_id->appendChild($doc->createTextNode($row["animal_id"]));
	$animal_name->appendChild($doc->createTextNode($row["animal_name"]));
	$animal_image->appendChild($doc->createTextNode($row["animal_image"]));
	$animal_description->appendChild($doc->createTextNode($row["animal_description"]));
	$animal_quantity->appendChild($doc->createTextNode($row["animal_quantity"]));
	
	$node->appendChild($animal_id);
	$node->appendChild($animal_name);
	$node->appendChild($animal_image);
	$node->appendChild($animal_description);
	$node->appendChild($animal_quantity);

	$root->appendChild($node);
}
echo $doc->saveXML();
?>