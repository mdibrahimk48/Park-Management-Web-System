<?php
	if($_POST){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$postcode=$_POST['postcode'];
	$contact_no=$_POST['contact_no'];
	$gender =$_POST['gender'];
	$uname = $_POST['uname'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];

		
		if($password != $cpassword){
			echo "Please Enter Same Password. <br />";
		}else{
			$con=mysqli_connect("localhost", "root", "","park_sept17");
			
			$query="insert into customerreg values('$name', '$email', '$address', 
			'$postcode', '$contact_no', '$gender', '$uname', '$password', 0, 0, 'user')";
			$result=mysqli_query($con,$query);
			if(!$result) 
			{

				if(mysqli_error($con)=="Duplicate entry '$uname' for key 'PRIMARY'"){
				echo "Username Already Exists. Please Try Another.</br>";
				 echo " Back to the Registration <a href='reg.html'>Page.</a>";
					}
				else echo mysqli_error($con);
			} else{
			echo "Successfully Added.</br>";
			echo " Go to Login <a href='login.html'>Page.</a>";}
		}
	}
?>