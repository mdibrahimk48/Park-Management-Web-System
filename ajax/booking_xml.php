<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "", "park_sept17");
$query= "SELECT * from booking";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows($ret);
$doc= new DOMDocument();
$doc->formatOutput=true;
$root = $doc->createElement("Booking_Details");
$doc->appendChild($root);
for($i = 0; $i<$num_results; $i++){
	$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
	$node = $doc->createElement("Booking");
	
	$booking_id=$doc->createElement("booking_id");
	$ticket_type=$doc->createElement("ticket_type");
	$booking_date=$doc->createElement("booking_date");
	$booking_time=$doc->createElement("booking_time");
	$number_of_attendee=$doc->createElement("number_of_attendee");
	$uname=$doc->createElement("uname");
	$total_cost=$doc->createElement("total_cost");
	
	$booking_id->appendChild($doc->createTextNode($row["booking_id"]));
	$ticket_type->appendChild($doc->createTextNode($row["ticket_type"]));
	$booking_date->appendChild($doc->createTextNode($row["booking_date"]));
	$booking_time->appendChild($doc->createTextNode($row["booking_time"]));
	$number_of_attendee->appendChild($doc->createTextNode($row["number_of_attendee"]));
	$uname->appendChild($doc->createTextNode($row["uname"]));
	$total_cost->appendChild($doc->createTextNode($row["total_cost"]));
	
	$node->appendChild($booking_id);
	$node->appendChild($ticket_type);
	$node->appendChild($booking_date);
	$node->appendChild($booking_time);
	$node->appendChild($number_of_attendee);
	$node->appendChild($uname);
	$node->appendChild($total_cost);

	$root->appendChild($node);
}
echo $doc->saveXML();
?>