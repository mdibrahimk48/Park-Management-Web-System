<?php
	$con=mysqli_connect("localhost","root","");
	$query="drop database if exists park_sept17";
	if(mysqli_query($con,$query)){
		echo "Database Dropped.</br></br>";
	} 
	
	$query="create database park_sept17";
	mysqli_query($con,$query);
	$con=mysqli_connect("localhost","root","","park_sept17");

	
	$table1="CREATE TABLE customerreg (
      name varchar(30) NOT NULL,
      email varchar(30) NOT NULL,
      address varchar(150) NOT NULL,
      postcode varchar(30) NOT NULL,
      contact_no varchar(15) NOT NULL,
	  gender varchar(10) NOT NULL,
	  uname varchar(30) NOT NULL,
      password varchar(30) NOT NULL,
	  attempt int(15) NOT NULL,
	  timestamp int(15) NOT NULL,
      usertype varchar(30) NOT NULL,
      PRIMARY KEY (uname))";
    if(mysqli_query($con,$table1)) 
		echo "Customer Registration Table is Created. </br></br>";
    else echo mysqli_error($con);
	
	$table2="CREATE TABLE ticket (
	ticket_no int(5) NOT NULL AUTO_INCREMENT,
	ticket_type varchar(30) NOT NULL,
	ticket_price float(10,2) NOT NULL,
	ticket_image varchar(400), 
	ticket_description varchar(500),
	quantity int(5),
	PRIMARY KEY (ticket_no))";
  
	if(mysqli_query($con,$table2)) 
		echo "Ticket Table is Created. </br></br>";
	else echo mysqli_error($con);
	
	$table3="CREATE TABLE animal (
	animal_id int(5) NOT NULL AUTO_INCREMENT,
	animal_name varchar(30) NOT NULL,
	animal_image varchar(400),
	animal_description varchar(500),
	animal_quantity int(5),
	PRIMARY KEY (animal_id))";

   if(mysqli_query($con,$table3)) 
	   echo "Animal Table is Created. </br></br>";
	else echo mysqli_error($con);
	
	
	$table4="CREATE TABLE vip_ticket (
	vip_ticket_no int(5) NOT NULL AUTO_INCREMENT,
	vip_ticket_image varchar(400),
	vip_ticket_description varchar(500),
	vip_ticket_price float(10,2) NOT NULL,
	vip_ticket_quantity int(5),
	PRIMARY KEY (vip_ticket_no))";

   if(mysqli_query($con,$table4)) 
	   echo "VIP Ticket Table is Created. </br></br>";
	else echo mysqli_error($con);

	
	$table5="CREATE TABLE discount (
	discount_no int(5) NOT NULL AUTO_INCREMENT,
	discount_date date,
	discount_rate float,
	PRIMARY KEY (discount_no))";

   if(mysqli_query($con,$table5)) 
	   echo "Discount Table is Created. </br></br>";
	else echo mysqli_error($con);
	
	$table6="CREATE TABLE booking (
	booking_id int(5) NOT NULL AUTO_INCREMENT,
	ticket_type varchar(30) NOT NULL,
	booking_date date NOT NULL,
	booking_time time NOT NULL,
	number_of_attendee int(5) NOT NULL,
	uname varchar(50) NOT NULL,
	total_cost float NOT NULL,
	PRIMARY KEY (booking_id))";

 if(mysqli_query($con,$table6)) echo "Booking Table is Created.</br></br>";
	else echo mysqli_error($con);


$query="insert into customerreg values ('Ibrahim','miki@gmail.com','65,C','567',
'01737328916','Male','admin',123456,0,0,'admin')";
$result=mysqli_query($con,$query);
if(!$result) echo mysqli_error($con);
else echo "<p>Data Inserted Successfully into Customer Registration Table.</p></br>;

$query="insert into discount values
('','2017-05-05','30.00'),
('','2017-05-20','20.00'),
('','2017-05-25','20.00'),
('','2017-06-20','10.00'),
('','2017-07-03','10.00'),
('','2017-07-10','10.00'),
('','2017-07-20','20.00'),
('','2017-08-03','12.00'),
('','2017-08-15','15.00'),
('','2017-08-25','17.00'),
('','2017-08-29','20.00')";
$result=mysqli_query($con,$query);
if(!$result) echo mysqli_error($con);
else echo "<p>Data Inserted Successfully in to Discount Table.</p></br>";

echo "Go to main <a href='index.html'>Page.</a>";
?>