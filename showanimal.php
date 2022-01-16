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
                <li><a class="active" href="showanimal.php">Show Animal</a></li>
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
				$animal_name=$_GET["animal_name"];
				$animal_image=$_GET["animal_image"];
				$animal_description=$_GET["animal_description"];
				$animal_quantity=$_GET["animal_quantity"];
			}
			if(@$_POST['edit']){
				$animal_id=$_POST["animal_id"];
				$animal_name=$_POST["animal_name"];
				$animal_image=$_FILES["animal_image"]["name"];
				$animal_description=$_POST["animal_description"];
				$animal_quantity=$_POST["animal_quantity"];
			}

						if(@$_FILES['animal_image']){
						//image upload
						$folder = "image/";
						
						if ((($_FILES["animal_image"]["type"] == "image/gif")
						 || ($_FILES["animal_image"]["type"] == "image/jpeg")
						 || ($_FILES["animal_image"]["type"] == "image/jpg")
						 || ($_FILES["animal_image"]["type"] == "image/pjpeg")
						 || ($_FILES["animal_image"]["type"] == "image/x-png")
						 || ($_FILES["animal_image"]["type"] == "image/png"))
						 && ($_FILES["animal_image"]["size"] < 50000000)){
						move_uploaded_file($_FILES["animal_image"]["tmp_name"] ,"$folder".$_FILES["animal_image"]["name"]);	
					}
			}?>
							
		
<?php
$query="select * from animal";
		$result= mysqli_query($connect,$query);
		echo "<center><table border=1 align:center>";
			echo "<tr>";
				echo "<th>Animal ID</th>";
				echo "<th>Animal Name</th>";
				echo "<th>Animal Image</th>";
				echo "<th>Animal Description</th>";
				echo "<th>Animal Quantity</th>";
			echo "</tr>";
		if($result){
			while($row= mysqli_fetch_array($result,MYSQL_ASSOC)){
				$animal_id=$row["animal_id"];
				$animal_name=$row["animal_name"];
				$animal_image=$row["animal_image"];
				$animal_description=$row["animal_description"];
				$animal_quantity=$row["animal_quantity"];
				echo "<tr>";
					echo "<td>$animal_id</td>";
					echo "<td>$animal_name</td>";
					echo "<td class='animal_image'><img src='$animal_image' style='height:100px; width:100px'/></td>";
					echo "<td>$animal_description</td>";
					echo "<td>$animal_quantity</td>";
				echo "</tr>";
			}
		}
		echo "</table></center>";
?>
<div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p><center>  
</div>					