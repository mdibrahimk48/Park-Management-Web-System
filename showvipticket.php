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
                <li><a href="showticket.php">Show Ticket</a></li>
                <li><a href="showanimal.php">Show Animal</a></li>
                <li><a class="active" href="showvipticket.php">Show VIP Ticket</a></li>
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
				$vip_ticket_image=$_GET["vip_ticket_image"];
				$ticket_description=$_GET["ticket_description"];
				$quantity=$_GET["quantity"];
			}
			if(@$_POST['edit']){
				$vip_ticket_no=$_POST["vip_ticket_no"];
				$ticket_type=$_POST["ticket_type"];
				$ticket_price=$_POST["ticket_price"];
				$vip_ticket_image=$_FILES["vip_ticket_image"]["name"];
				$ticket_description=$_POST["ticket_description"];
				$quantity=$_POST["quantity"];
			}

						if(@$_FILES['vip_ticket_image']){
						//image upload
						$folder = "image/";
						
						if ((($_FILES["vip_ticket_image"]["type"] == "image/gif")
						 || ($_FILES["vip_ticket_image"]["type"] == "image/jpeg")
						 || ($_FILES["vip_ticket_image"]["type"] == "image/jpg")
						 || ($_FILES["vip_ticket_image"]["type"] == "image/pjpeg")
						 || ($_FILES["vip_ticket_image"]["type"] == "image/x-png")
						 || ($_FILES["vip_ticket_image"]["type"] == "image/png"))
						 && ($_FILES["vip_ticket_image"]["size"] < 50000000)){
						move_uploaded_file($_FILES["vip_ticket_image"]["tmp_name"] ,"$folder".$_FILES["vip_ticket_image"]["name"]);
					}
			}?>
							
		
<?php
$query="select * from vip_ticket";
		$result= mysqli_query($connect,$query);
		echo "<center><table border=1 align:center>";
			echo "<tr>";
				echo "<th>VIP Ticket No</th>";
				echo "<th>VIP Ticket Image</th>";
				echo "<th>VIP Ticket Description</th>";
				echo "<th>VIP Ticket Quantity</th>";
			echo "</tr>";
		if($result){
			while($row= mysqli_fetch_array($result,MYSQL_ASSOC)){
				$vip_ticket_no=$row["vip_ticket_no"];
				$vip_ticket_image=$row["vip_ticket_image"];
				$vip_ticket_description=$row["vip_ticket_description"];
				$vip_ticket_quantity=$row["vip_ticket_quantity"];
				echo "<tr>";
					echo "<td>$vip_ticket_no</td>";
					echo "<td class='vip_ticket_image'><img src='$vip_ticket_image' style='height:100px; width:150px'/></td>";
					echo "<td>$vip_ticket_description</td>";
					echo "<td>$vip_ticket_quantity</td>";
				echo "</tr>";
			}
		}
		echo "</table></center>";
?>
<div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p><center>  
</div>					