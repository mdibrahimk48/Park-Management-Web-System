<?php
session_start();

	if($_SESSION['login'] != true){

		header("location: ../login.html");
	}else if(@$_SESSION['usertype']=="user"){
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
                <li><a href="../showticket.php">Show Ticket</a></li>
                <li><a href="../showanimal.php">Show Animal</a></li>
                <li><a href="../showvipticket.php">Show VIP Ticket</a></li>
                <li><a href="times.php">Ticket Schedule</a></li>
                <li><a class="active"  href="bookingUI.php">Booking</a></li>
                <li><a href="../about.html">About</a></li>
				<li><a href="../logout.php">Logout</a></li>
            </ul>
           </div>
            
        </div>
 
 
 
 

<!DOCTYPE html>
<html>
    <head>
        
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css"/>
        <link href="css/datepicker2.css" rel="stylesheet" type="text/css"/>
        <link href="css/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/fullcalendar.print.min.css" rel="stylesheet" type="text/css" media="print"/>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/moment.min.js" type="text/javascript"></script>
        <script src="js/fullcalendar.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/moment-datepicker.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
       <style type="text/css">
           table{
            width:100%;
            border-spacing: 10px; 
            border-collapse: separate;
           }
           caption{
            font-weight: bold;
            font-size: 30px;
           }
           thead{
            font-weight: bold; font-size: 20px;
           }
           tbody{
             font-size: 15px;
           }
           p{
             font-size: 20px;
           }
           #check{
            font-weight: bold; font-size: 25px;
           }
       </style>
    </head>
    <body>
       
    <div class="booking-panel">
        <div class="panel panel-deafult">
            <div class="panel-body">
                <div class="booking">
                    <div class="booking-left">
                       <div id="calendar"></div>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "park_sept17");
                    $query = "SELECT sum(number_of_attendee) as 'total_attend', booking_date as 'Booking Date' FROM ticket, booking group by booking_date";
                    $result = mysqli_query($con, $query);
                    $qty=0;$quantity=0;
                    ?>
                    <script type="text/javascript">
                        $(document).ready(function(){
                    
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        	
							$query1 = "select sum(quantity) as 'quantity' from ticket";
							$result1 = mysqli_query($con, $query1);
							$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
							$qty=$row1['quantity']-$row['total_attend'];
								$quantity=$row1['quantity'];
                    
                    ?>        
                        var events = new Array();
                        event = new Object();
                        event.title = "<?php echo 'Available '.$qty ?>";
                        event.start = "<?php echo $row['Booking Date'] ?>";
                        event.color = "green";
                        event.allDay = true;
                        events.push(event);
                        $('#calendar').fullCalendar('addEventSource', events);
                    <?php } ?>
                        });
                    </script>
                         </div>
                    
                        <div class="booking-right">

<?php	

			$connect=mysqli_connect("localhost","root","","park_sept17");

			if(@$_POST['insert']){
				$ticket_type=$_POST["ticket_type"];
				$booking_date=$_POST["booking_date"];
				$booking_time=$_POST["booking_time"];
				$number_of_attendee=$_POST["number_of_attendee"];
				$uname=$_SESSION['uname'];
				$query = "select discount_rate from discount where discount_date='$booking_date'";
				$discount_rate=0;
				$result =mysqli_query($connect, $query);
				$numofrow = mysqli_num_rows($result);
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				if($numofrow>0){
					$discount_rate = $row['discount_rate'];
				}
				$query= "select ticket_price from ticket where ticket_type='$ticket_type'";
				$result =mysqli_query($connect, $query);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$subtotal_cost= ($number_of_attendee * $row['ticket_price']);
				$discount = ($subtotal_cost*$discount_rate)/100;
				$total_cost = $subtotal_cost-$discount;
				
				if($ticket_type==null||$booking_date==null||$booking_time==null||$number_of_attendee==null){
					echo "<center>Some of The Fields Are Blank. Please Insert Data.</center>";
				}else{
							$query="insert into booking
							values('','$ticket_type','$booking_date','$booking_time',$number_of_attendee,'$uname',$total_cost)";
							$result= mysqli_query($connect,$query);
							if(!$result){
								echo "<center>Error: </center>".mysqli_error($connect);
							}
							else{
								echo "<center>Ticket Data Inserted.</center>";
							}
						}
			}
?>



<html><head>
		<title>Booking Information</title>
		<link rel='stylesheet' type='text/css' href='css/style.css'/>
	</head>
	<body>

			<form action="bookingUI.php" method="post" enctype="multipart/form-data">
			<table cellpadding="10px" align="center" style="background:#AEA9A2; 
			font-family: Gill Sans Ultra Bold Condensed; font-size:20px">
			<caption style="font-size:30px">Booking Information</caption>
				<tr> 
					<td><label>Ticket Type:</label></td><td>
					<select id="ticket_type" name="ticket_type" value="<?php echo $ticket_type;?>"/>
						<option value="Adults"> Adults </option>
						<option value="Children"> Children </option>
						<option value="Old Age Pensioners"> Old Age Pensioners(OAPs) </option>
						<option value="Families"> Families(2 adults + 2 Children) </option>
						<option value="VIP Ticket"> VIP Tickets </option>
					</select>
					</td>
				</tr>
				<tr>
					<td><label>Booking Date: </label></td>
					<td><input type="date" name="booking_date" id="booking_date"/></td>
				</tr>
				<tr>
					<td><label>Booking Time:<label></td>
					<td><input type="time" id="booking_time" name="booking_time" /></td>
				</tr>
				<tr>
					<td><label>Number of Attendee:</label></td>
					<td><input type="text" name="number_of_attendee" id="number_of_attendee"></td>
				</tr>
				<tr> 
					<td colspan="2" align="middle"><input type="submit" value="Add Ticket" name="insert" 
					style="background:#5EA5FD; font-family: Gill Sans Ultra Bold Condensed; font-size:20px" /></td>
				</tr>
			</table>
		</form>
		
		</body>
		
		</html>
		

<?php
$query="select * from booking";
		$result= mysqli_query($connect,$query);
		echo "<center><table border=2 align:center>";
			echo "<tr>";
				echo "<th>Booking ID</th>";
				echo "<th>Ticket Type</th>";
				echo "<th>Booking Date</th>";
				echo "<th>Booking Time</th>";
				echo "<th>Number of Attendee</th>";
				echo "<th>User name</th>";
				echo "<th>Total Cost</th>";
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
					
					
				echo "</tr>";
			}
		}
		echo "</table></center>";
	}	
?>

<div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p></center>
</div>