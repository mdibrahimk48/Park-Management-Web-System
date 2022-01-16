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
                <li><a href="addticket.php">Add Ticket</a></li>
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
			if(@$_GET){
				$vip_ticket_image=$_GET["vip_ticket_image"];
				$vip_ticket_description=$_GET["vip_ticket_description"];
				$vip_ticket_price=$_GET["vip_ticket_price"];
				$vip_ticket_quantity=$_GET["vip_ticket_quantity"];
			}
			if(@$_POST['edit']){
				$vip_ticket_no=$_POST["vip_ticket_no"];
				$vip_ticket_image=$_FILES["vip_ticket_image"]["name"];
				$vip_ticket_description=$_POST["vip_ticket_description"];
				$vip_ticket_price=$_POST["vip_ticket_price"];
				$vip_ticket_quantity=$_POST["vip_ticket_quantity"];
			}
				if($vip_ticket_image==null||$vip_ticket_description==null||$vip_ticket_price==null||$vip_ticket_quantity==null){
					echo "<center>Some of The Fields Are Blank. Please Insert Data.</center>";
				}else{
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
							
						$query="update vip_ticket set vip_ticket_image='image/$vip_ticket_image', 
						vip_ticket_description='$vip_ticket_description',vip_ticket_price='$vip_ticket_price',vip_ticket_quantity='$vip_ticket_quantity' where vip_ticket_no='$vip_ticket_no'";
						$result= mysqli_query($connect,$query);
						if(!$result){
							echo "Error: ".mysqli_error($connect);
						}else{
							echo "<center>VIP Ticket Data Edited.</center>";
						}
					}else{
						echo "<center>Invalid Image Type or Size(5 MB).</center>";}}}?>
							
<html><head>
		<title>VIP Ticket Information</title>
		<link rel='stylesheet' type='text/css' href='css/style.css'/>
	</head>
	<body>

			<form action="vipticketedit.php" method="post" enctype="multipart/form-data">
			<table cellpadding="10px" align="center" style="background:#AEA9A2; 
			font-family: Gill Sans Ultra Bold Condensed; font-size:20px">
			<caption style="font-size:30px">VIP Ticket Information</caption>

					<td><label>VIP Ticket Image:<label></td>
					<td><input type="file" id="vip_ticket_image" name="vip_ticket_image" value="<?php echo $vip_ticket_image;?>"/></td>
				</tr>
				<tr>
					<td><label>VIP Ticket Description:</label></td>
					<td><input type="text" name="vip_ticket_description" value="<?php echo $vip_ticket_description;?>"></td>
				</tr>
				<tr>
					<td><label>VIP Ticket Price:</label></td>
					<td><input type="text" name="vip_ticket_price" value="<?php echo $vip_ticket_price;?>"/></td>
				</tr>
				<tr>
					<td><label>VIP Ticket Quantity:</label></td>
					<td><input type="number" name="vip_ticket_quantity" value="<?php echo $vip_ticket_quantity;?>"/></td>
				</tr>
				<tr> 
					<td colspan="2" align="middle" >
					<input type="hidden" value="<?php echo $_GET["vip_ticket_no"]?>" name="vip_ticket_no"/>
					<input type="submit" value="Edit" name="edit" 
					style="background:#5EA5FD; font-family: Gill Sans Ultra Bold Condensed; font-size:20px" /></td>
				</tr>
			</table>
		</form>
		</body>
		
		</html>	
		
		
<?php
$query="select * from vip_ticket";
		$result= mysqli_query($connect,$query);
		echo "<center><table border=1 align:center>";
			echo "<tr>";
				echo "<th>VIP Ticket No</th>";
				echo "<th>VIP Ticket Image</th>";
				echo "<th>VIP Ticket Description</th>";
				echo "<th>VIP Ticket Price</th>";
				echo "<th>VIP Ticket Quantity</th>";
				echo "<th>Edit</th>";
				echo "<th>Delete</th>";
			echo "</tr>";
		if($result){
			while($row= mysqli_fetch_array($result,MYSQL_ASSOC)){
				$vip_ticket_no=$row["vip_ticket_no"];
				$vip_ticket_image=$row["vip_ticket_image"];
				$vip_ticket_description=$row["vip_ticket_description"];
				$vip_ticket_price=$row["vip_ticket_price"];
				$vip_ticket_quantity=$row["vip_ticket_quantity"];
				echo "<tr>";
					echo "<td>$vip_ticket_no</td>";
					echo "<td class='vip_ticket_image'><img src='$vip_ticket_image' style='height:100px; width:100px'/></td>";
					echo "<td>$vip_ticket_description</td>";
					echo "<td>$vip_ticket_price</td>";
					echo "<td>$vip_ticket_quantity</td>";
					echo "<td><a href='vipticketedit.php?event=edit&vip_ticket_no=$vip_ticket_no&vip_ticket_image=$vip_ticket_image&vip_ticket_description=$vip_ticket_description&vip_ticket_price=$vip_ticket_price&vip_ticket_quantity=$vip_ticket_quantity'>Edit</a></td>";
					echo "<td><a href='addvipticket.php?event=delete&vip_ticket_no=$vip_ticket_no'>Delete</a></td>";
				echo "</tr>";
			}
		}
		echo "</table></center>";}?>

<div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p><center>  
        </div>					