<?php
session_start();

	if($_SESSION['login'] != true){

		header("location: login.html");
	}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <style>
        .image{
            width: 30%;
            float: left;
        }
		
        .image image{
            height: 10px;  
        }
		
		
        .button:hover{
            background-color: darkolivegreen;
            color: aliceblue
        }
		
        .heading{
            width: 30%;
            float: left;
            margin-left: 15%;
            
        }
        
        .top,.bottom{
            height: 200px;
            width: 100%;
            background-color: #569FF3;
            height: 35px;
            overflow: hidden
        }
        
    </style>
</head>
<body>
    <div class="main">
       
        <div class="mainmenu">

           <div class="right">
              
              <ul>
                <li><a href="index.html">Home</a></li>
                <li><a class="active"  href="showticket.php">Show Ticket</a></li>
                <li><a href="showanimal.php">Show Animal</a></li>
                <li><a href="showvipticket.php">Show VIP Ticket</a></li>
                <li><a href="booking_details/times.php">Ticket Schedule</a></li>
                <li><a href="booking_details/bookingUI.php">Booking</a></li>
                <li><a href="about.html">About</a></li>
				<li><a href="logout.php">Logout</a></li>
            </ul>
           </div>
            
        </div>



<?php
$connect=mysqli_connect("localhost","root","","park_sept17");

			if(@$_GET){
				$ticket_type=$_GET["ticket_type"];
				$ticket_price=$_GET["ticket_price"];
				$ticket_image=$_GET["ticket_image"];
				$ticket_description=$_GET["ticket_description"];
				$quantity=$_GET["quantity"];
			}
			if(@$_POST['edit']){
				$ticket_no=$_POST["ticket_no"];
				$ticket_type=$_POST["ticket_type"];
				$ticket_price=$_POST["ticket_price"];
				$ticket_image=$_FILES["ticket_image"]["name"];
				$ticket_description=$_POST["ticket_description"];
				$quantity=$_POST["quantity"];
			}

						if(@$_FILES['ticket_image']){
						//image upload
						$folder = "image/";
						
						if ((($_FILES["ticket_image"]["type"] == "image/gif")
						 || ($_FILES["ticket_image"]["type"] == "image/jpeg")
						 || ($_FILES["ticket_image"]["type"] == "image/jpg")
						 || ($_FILES["ticket_image"]["type"] == "image/pjpeg")
						 || ($_FILES["ticket_image"]["type"] == "image/x-png")
						 || ($_FILES["ticket_image"]["type"] == "image/png"))
						 && ($_FILES["ticket_image"]["size"] < 50000000)){
						move_uploaded_file($_FILES["ticket_image"]["tmp_name"] ,"$folder".$_FILES["ticket_image"]["name"]);
					}
			}?>
							
		
<?php
$query="select * from ticket";
		$result= mysqli_query($connect,$query);
		echo "<center><table border=1 align:center>";
			echo "<tr>";
				echo "<th>Ticket No</th>";
				echo "<th>Ticket Type</th>";
				echo "<th>Ticket Price</th>";
				echo "<th>Ticket Image</th>";
				echo "<th>Ticket Description</th>";
				echo "<th>Quantity</th>";
			echo "</tr>";
		if($result){
			while($row= mysqli_fetch_array($result,MYSQL_ASSOC)){
				$ticket_no=$row["ticket_no"];
				$ticket_type=$row["ticket_type"];
				$ticket_price=$row["ticket_price"];
				$ticket_image=$row["ticket_image"];
				$ticket_description=$row["ticket_description"];
				$quantity=$row["quantity"];
				echo "<tr>";
					echo "<td>$ticket_no</td>";
					echo "<td>$ticket_type</td>";
					echo "<td>$ticket_price</td>";
					echo "<td class='ticket_image'><img src='$ticket_image' style='height:100px; width:100px'/></td>";
					echo "<td>$ticket_description</td>";
					echo "<td>$quantity</td>";
				echo "</tr>";
			}
		}
		echo "</table></center>";
?>
<div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p><center>  
</div>					