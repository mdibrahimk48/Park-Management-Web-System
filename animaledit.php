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
				if($animal_name==null||$animal_image==null||$animal_description==null||$animal_quantity==null){
					echo "<center>Some of The Fields Are Blank. Please Insert Data.</center>";
				}else{
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
						$query="update animal set animal_name='$animal_name', animal_image='image/$animal_image', 
						animal_description='$animal_description',animal_quantity='$animal_quantity' where animal_id='$animal_id'";
						$result= mysqli_query($connect,$query);
						if(!$result){
							echo "Error: ".mysqli_error($connect);
						}else{
							echo "<center>Animal Data Edited.</center>";
						}
					}else{
						echo "<center>Invalid Image Type or Size(5 MB).</center>";}}}?>
							
<html><head>
		<title>Animal Information</title>
		<link rel='stylesheet' type='text/css' href='css/style.css'/>
	</head>
	<body>

			<form action="animaledit.php" method="post" enctype="multipart/form-data">
			<table cellpadding="10px" align="center" style="background:#AEA9A2; 
			font-family: Gill Sans Ultra Bold Condensed; font-size:20px">
			<caption style="font-size:30px">Animal Information</caption>

				<tr>
					<td><label>Animal Name:</label></td>
					<td><input type="text" name="animal_name" value="<?php echo $animal_name;?>"/></td>
				</tr>
				<tr>
					<td><label>Animal Image:<label></td>
					<td><input type="file" id="animal_image" name="animal_image" value="<?php echo $animal_image;?>"/></td>
				</tr>
				<tr>
					<td><label>Animal Description:</label></td>
					<td><input type="text" name="animal_description" value="<?php echo $animal_description;?>"></td>
				</tr>
				<tr>
					<td><label>Animal Quantity:</label></td>
					<td><input type="number" name="animal_quantity" value="<?php echo $animal_quantity;?>"/></td>
				</tr>
				<tr> 
					<td colspan="2" align="middle" >
					<input type="hidden" value="<?php echo $_GET["animal_id"]?>" name="animal_id"/>
					<input type="submit" value="Edit" name="edit" 
					style="background:#5EA5FD; font-family: Gill Sans Ultra Bold Condensed; font-size:20px" /></td>
				</tr>
			</table>
		</form>
		</body>
		
		</html>	
		
		
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
				echo "<th>Edit</th>";
				echo "<th>Delete</th>";
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
					echo "<td><a href='animaledit.php?event=edit&animal_id=$animal_id&animal_name=$animal_name&animal_image=$animal_image&animal_description=$animal_description&animal_quantity=$animal_quantity'>Edit</a></td>";
					echo "<td><a href='addanimal.php?event=delete&animal_id=$animal_id'>Delete</a></td>";
				echo "</tr>";
			}
		}echo "</table></center>";}?>	

<div class="bottom">
        <center><p>Copyright © All right reservse to Lindisfarne Safari Park</p><center>  
        </div>			