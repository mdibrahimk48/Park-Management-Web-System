<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "", "park_sept17");
$query= "SELECT * from vip_ticket";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows($ret);
$doc= new DOMDocument();
$doc->formatOutput=true;
$root = $doc->createElement("VIP_Ticket_Details");
$doc->appendChild($root);
for($i = 0; $i<$num_results; $i++){
	$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
	$node = $doc->createElement("VIP_Ticket");
	
	$vip_ticket_no=$doc->createElement("vip_ticket_no");
	$vip_ticket_image=$doc->createElement("vip_ticket_image");
	$vip_ticket_description=$doc->createElement("vip_ticket_description");
	$vip_ticket_price=$doc->createElement("vip_ticket_price");
	$vip_ticket_quantity=$doc->createElement("vip_ticket_quantity");
	
	$vip_ticket_no->appendChild($doc->createTextNode($row["vip_ticket_no"]));
	$vip_ticket_image->appendChild($doc->createTextNode($row["vip_ticket_image"]));
	$vip_ticket_description->appendChild($doc->createTextNode($row["vip_ticket_description"]));
	$vip_ticket_price->appendChild($doc->createTextNode($row["vip_ticket_price"]));
	$vip_ticket_quantity->appendChild($doc->createTextNode($row["vip_ticket_quantity"]));
	
	$node->appendChild($vip_ticket_no);
	$node->appendChild($vip_ticket_image);
	$node->appendChild($vip_ticket_description);
	$node->appendChild($vip_ticket_price);
	$node->appendChild($vip_ticket_quantity);

	$root->appendChild($node);
}
echo $doc->saveXML();
?>