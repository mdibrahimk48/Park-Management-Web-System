<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "", "park_sept17");
$query= "SELECT * from customerreg";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows($ret);
$doc= new DOMDocument();
$doc->formatOutput=true;
$root = $doc->createElement("User_Details");
$doc->appendChild($root);
for($i = 0; $i<$num_results; $i++){
	$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
	$node = $doc->createElement("User");
	
	
	$name=$doc->createElement("name");
	$email=$doc->createElement("email");
	$address=$doc->createElement("address");
	$postcode=$doc->createElement("postcode");
	$contact_no=$doc->createElement("contact_no");
	$gender=$doc->createElement("gender");
	$uname=$doc->createElement("uname");
	$password=$doc->createElement("password");
	$attempt=$doc->createElement("attempt");
	$timestamp=$doc->createElement("timestamp");
	$usertype=$doc->createElement("usertype");
	
	
	$name->appendChild($doc->createTextNode($row["name"]));
	$email->appendChild($doc->createTextNode($row["email"]));
	$address->appendChild($doc->createTextNode($row["address"]));
	$postcode->appendChild($doc->createTextNode($row["postcode"]));
	$contact_no->appendChild($doc->createTextNode($row["contact_no"]));
	$gender->appendChild($doc->createTextNode($row["gender"]));
	$uname->appendChild($doc->createTextNode($row["uname"]));
	$password->appendChild($doc->createTextNode($row["password"]));
	$attempt->appendChild($doc->createTextNode($row["attempt"]));
	$timestamp->appendChild($doc->createTextNode($row["timestamp"]));
	$usertype->appendChild($doc->createTextNode($row["usertype"]));
	
	$node->appendChild($name);
	$node->appendChild($email);
	$node->appendChild($address);
	$node->appendChild($postcode);
	$node->appendChild($contact_no);
	$node->appendChild($gender);
	$node->appendChild($uname);
	$node->appendChild($password);
	$node->appendChild($attempt);
	$node->appendChild($timestamp);
	$node->appendChild($usertype);
	
	
	$root->appendChild($node);
}
echo $doc->saveXML();
?>