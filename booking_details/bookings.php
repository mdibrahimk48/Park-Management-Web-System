<?php
session_start();

	if($_SESSION['login'] != true){

		header("location: ../login.html");
	}else if(@$_SESSION['usertype']=="admin"){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css"/>
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
			<li><a href="../index.html">Home</a></li>
			<li><a href="../addticket.php">Add Ticket</a></li>
            <li><a href="../addanimal.php">Add Animal</a></li>
            <li><a href="../addvipticket.php">VIP Ticket</a></li>
            <li><a class="active" href="booking_details/bookings.php">Edit Bookings</a></li>
            <li><a href="../about.html">About</a></li>
			<li><a href="../logout.php">Logout</a></li>
      </ul>
  </div>
            
</div>




<?php 
	$connect=mysqli_connect("localhost","root","","park_sept17");

		if($_POST)
			{
				$booking_id =$_POST['booking_id'];

				$booking_date = $_POST['booking_date'];


					$updateQuery="update booking set booking_date='$booking_date' where booking_id=$booking_id";

					$result = mysqli_query($connect, $updateQuery);

					if(!$result) echo mysqli_error($con);
					else{
						echo "Information successfully updated";
					} 
				}	

	if ($_GET) {
		$booking_id = $_GET['booking_id'];
		?>
			
	
	<form action='bookings.php' method='post' >
					<table align='center' cellpadding='10px' style='background: gray; font-family: Arial; font-size: 25px; font-style: italic;'>
						<caption></caption>
						<tr>
							<td><label for='booking_date'>Booking Date : </label></td>
							<td><input type="date" id="booking_date" name="booking_date" value="<?php echo $_GET['booking_date']; ?>" />
                                   
							</td>
						</tr>
						
						<tr>  
							<td colspan="2" align="center">
							<input type="hidden" value="<?php echo $_GET['booking_id']; ?>" name="booking_id" />
							<input type="submit" value="Update Booking" />
							</td>
						</tr>

					</table>
				</form>



<?php 
	}
	$query="select * from booking";
		$result= mysqli_query($connect,$query);
		echo "<center><table border=1 align:center>";
			echo "<tr>";
				echo "<th>Booking ID</th>";
				echo "<th>Ticket Type</th>";
				echo "<th>Booking Date</th>";
				echo "<th>Booking Time</th>";
				echo "<th>Number Of Attendee</th>";
				echo "<th>User Name</th>";
				echo "<th>Total Cost</th>";
				echo "<th>Edit</th>";
			echo "</tr>";
		if($result){
			while($row= mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$booking_id=$row["booking_id"];
				$ticket_type=$row["ticket_type"];
				$booking_date=$row["booking_date"];
				$booking_time=$row["booking_time"];
				$number_of_attendee=$row["number_of_attendee"];
				$uname=$row["uname"];
				$total_cost=$row["total_cost"];
				echo "<tr>";
					echo "<td>$booking_id</td>";
					echo "<td>$ticket_type</td>";
					echo "<td>$booking_date</td>";
					echo "<td>$booking_time</td>";
					echo "<td>$number_of_attendee</td>";
					echo "<td>$uname</td>";
					echo "<td>$total_cost</td>";
					echo "<td><a href='bookings.php?event=edit&booking_id=$booking_id&booking_date=$booking_date'>Edit</a></td>";
				echo "</tr>";
			}
		}
		echo "</table></center>";
	}
 ?>
 
 <div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p><center>  
        </div>	
	</body>
</html>