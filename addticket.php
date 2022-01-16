<?php
session_start();

	if($_SESSION['login'] != true){

		header("location: login.html");
	}else if(@$_SESSION['usertype']=="admin"){
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
            height: 210px;
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
			<li><a class="active" href="addticket.php">Add Ticket</a></li>
            <li><a href="addanimal.php">Add Animal</a></li>
            <li><a href="addvipticket.php">VIP Ticket</a></li>
            <li><a href="booking_details/bookings.php">Edit Bookings</a></li>
            <li><a href="about.html">About</a></li>
			<li><a href="logout.php">Logout</a></li>
      </ul>
  </div>
            
</div>
	
		
	
		
<?php	
$connect=mysqli_connect("localhost","root","","park_sept17");

			if(@$_POST['insert']){
				$ticket_type=$_POST["ticket_type"];
				$ticket_price=$_POST["ticket_price"];
				$ticket_image=$_FILES["ticket_image"]["name"];
				$ticket_description=$_POST["ticket_description"];
				$quantity=$_POST["quantity"];
				if($ticket_type==null||$ticket_price==null||$ticket_image==null||$ticket_description==null||$quantity==null){
					echo "<center>Some of The Fields Are Blank. Please Insert Data.</center>";
				}else{
					if($_FILES['ticket_image']){
						//image upload
						$folder = "image/";
						
						if ((($_FILES["ticket_image"]["type"] == "image/gif")
						 || ($_FILES["ticket_image"]["type"] == "image/jpeg")
						 || ($_FILES["ticket_image"]["type"] == "image/jpg")
						 || ($_FILES["ticket_image"]["type"] == "image/pjpeg")
						 || ($_FILES["ticket_image"]["type"] == "image/x-png")
						 || ($_FILES["ticket_image"]["type"] == "image/png"))
						 && ($_FILES["ticket_image"]["size"] < 50000000)){
							move_uploaded_file($_FILES["ticket_image"]["tmp_name"] , "$folder".$_FILES["ticket_image"]["name"]);
							
							$query="insert into ticket
							values('','$ticket_type','$ticket_price','image/$ticket_image','$ticket_description','$quantity')";
							$result= mysqli_query($connect,$query);
							if(!$result){
								echo "<center>Error: </center>".mysqli_error($connect);
							}
							else{
								echo "<center>Ticket Data Inserted.</center>";
							}

						}else{
							echo "<center>Something Wrong With Image Type or Size(5 MB).</center>";
						}
					}
				}
			}
					
				if($_GET){
					if($_GET["event"]=="delete"){
					$ticket_no=$_GET["ticket_no"];
					$query="delete from ticket where ticket_no=$ticket_no";
					$result= mysqli_query($connect,$query);
				if(!$result){
					echo "<center>Error: </center>".mysql_error();
				}
				else{
					echo "<center>Ticket Data Deleted. </center>";	
				}
			}
		}

?>

<html><head>
		<title>Ticket Information</title>
		<link rel='stylesheet' type='text/css' href='css/style.css'/>
	</head>
	<body>

			<form action="addticket.php" method="post" enctype="multipart/form-data">
			<table cellpadding="10px" align="center" style="background:#AEA9A2; 
			font-family: Gill Sans Ultra Bold Condensed; font-size:20px">
			<caption style="font-size:30px">Ticket Information</caption>
				<tr> 
					<td><label>Ticket Type :</label></td><td>
					<select id="ticket_type" name="ticket_type" value="<?php echo $ticket_type;?>"/>
						<option value="Adults"> Adults </option>
						<option value="Children"> Children </option>
						<option value="Old Age Pensioners"> Old Age Pensioners(OAPs) </option>
						<option value="Families"> Families(2 adults + 2 Children) </option>
					</select>
					</td>
				</tr>
				<tr>
					<td><label>Product Price:</label></td>
					<td><input type="text" name="ticket_price" /></td>
				</tr>
				<tr>
					<td><label>Ticket Image:<label></td>
					<td><input type="file" id="ticket_image" name="ticket_image" /></td>
				</tr>
				<tr>
					<td><label>Ticket Description:</label></td>
					<td><input type="text" name="ticket_description"></td>
				</tr>
				<tr>
					<td><label>Quantity:</label></td>
					<td><input type="number" name="quantity" /></td>
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
				echo "<th>Edit</th>";
				echo "<th>Delete</th>";
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
					echo "<td><a href='ticketedit.php?event=edit&ticket_no=$ticket_no&ticket_type=$ticket_type&ticket_price=$ticket_price&ticket_image=$ticket_image&ticket_description=$ticket_description&quantity=$quantity'>Edit</a></td>";
					echo "<td><a href='addticket.php?event=delete&ticket_no=$ticket_no'>Delete</a></td>";
				echo "</tr>";
			}
		}
		echo "</table></center>";
	}
?>

<div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p><center>  
        </div>	