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
                <li><a class="active"  href="times.php">Ticket Schedule</a></li>
				<li><a href="bookingUI.php">Booking</a></li>
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
                    $query = "select discount_rate as 'Discount Rate', discount_date as 'Discount Start Date' from discount" ;
                    $result = mysqli_query($con, $query);
                    ?>
                    <script type="text/javascript">
                        $(document).ready(function(){
                    <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>        
                        var events = new Array();
                        event = new Object();
                        event.title = "<?php echo 'Offer '.$row['Discount Rate'].'%' ?>";
                        event.start = "<?php echo $row['Discount Start Date'] ?>";
                        event.color = "green";
                        event.allDay = true;
                        events.push(event);
                        $('#calendar').fullCalendar('addEventSource', events);
                    <?php }?>
                        });
                    </script>
                        
                         </div>
                    
                        <div class="booking-right" style="padding: 10px;">

                        <table border="3" cellpadding="12px" align="center" style="background:Yellow; 
						font-family: Arial Rounded MT Bold; font-size:25px">
						<caption style="font-size:30px"> Ticket Schedule</caption>
                        <table border="2">
                           <thead>
                            <th>Season</th>
                            <th>Opening Time</th>
                            <th>Closing Time</th>
                            <th> Off Day </th>
                           <thead>
                           <tbody>
                           <tr>
                           <td>Mar-June</td>
                            <td>11:00 AM</td>
                            <td>05:00 PM</td>
                            <td>Friday</td>
                           </tr>
                            <tr>
                           <td>July-Oct</td>
                            <td>10:00 AM</td>
                            <td>05:00 PM</td>
                            <td> Sunday</td>
                           </tr>
                              <tr>
                           <td>Nov-Feb</td>
                            <td>9:00 AM</td>
                            <td>04:00 PM</td>
                            <td> Monday </td>
                           </tr>
                           </tbody>
                           </table> 
                   
				   
					<table border="3" cellpadding="12px" align="center" style="background:Yellow; 
						font-family: Arial Rounded MT Bold; font-size:25px">
						<caption style="font-size:30px"> Discount Schedule</caption>
                        <table border="2">
                           <thead>
                            <th>Discount Date</th>
                            <th>Discount Rate</th>
                           <thead>
                           <tbody>
                           <tr>
                           <td>05-May-2017</td>
                            <td>30%</td>
                           </tr>
                            <tr>
                           <td>20-May-2017</td>
                            <td>20%</td>
                           </tr>
						   <tr>
                           <td>25-May-2017</td>
                            <td>20%</td>
                           </tr>
						   <tr>
                           <td>20-June-2017</td>
                            <td>10%</td>
                           </tr>
						   <tr>
                           <td>03-July-2017</td>
                            <td>10%</td>
                           </tr>
						   <tr>
                           <td>10-July-2017</td>
                            <td>10%</td>
                           </tr>
						   <tr>
                           <td>20-July-2017</td>
                            <td>20%</td>
                           </tr>
						   <tr>
                           <td>03-August-2017</td>
                            <td>12%</td>
                           </tr>
						   <tr>
                           <td>15-August-2017</td>
                            <td>15%</td>
                           </tr>
						   <tr>
                           <td>25-August-2017</td>
                            <td>17%</td>
                           </tr>
						   <tr>
                           <td>29-August-2017</td>
                            <td>20%</td>
                           </tr>
                           </tbody>
                           </table>
				   
                </div>
            </div>
        </div>
        
    </div>
   <div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p></center></div>
</body>
</html>