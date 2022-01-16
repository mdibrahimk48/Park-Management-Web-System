<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "", "park_sept17");
$query= "SELECT * from ticket";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows($ret);
$doc= new DOMDocument();
$doc->formatOutput=true;
$root = $doc->createElement("Ticket_Details");
$doc->appendChild($root);
for($i = 0; $i<$num_results; $i++){
	$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
	$node = $doc->createElement("Ticket");
	
	$ticket_no=$doc->createElement("ticket_no");
	$ticket_type=$doc->createElement("ticket_type");
	$ticket_price=$doc->createElement("ticket_price");
	$ticket_image=$doc->createElement("ticket_image");
	$ticket_description=$doc->createElement("ticket_description");
	$quantity=$doc->createElement("quantity");
	
	$ticket_no->appendChild($doc->createTextNode($row["ticket_no"]));
	$ticket_type->appendChild($doc->createTextNode($row["ticket_type"]));
	$ticket_price->appendChild($doc->createTextNode($row["ticket_price"]));
	$ticket_image->appendChild($doc->createTextNode($row["ticket_image"]));
	$ticket_description->appendChild($doc->createTextNode($row["ticket_description"]));
	$quantity->appendChild($doc->createTextNode($row["quantity"]));
	
	$node->appendChild($ticket_no);
	$node->appendChild($ticket_type);
	$node->appendChild($ticket_price);
	$node->appendChild($ticket_image);
	$node->appendChild($ticket_description);
	$node->appendChild($quantity);

	$root->appendChild($node);
}
echo $doc->saveXML();
?>