<?php
session_start();  
	$uname =$_POST["uname"];
	$password = $_POST["password"];
	$con = mysqli_connect("localhost","root","","park_sept17");
	$query = "select * from customerreg where  uname='$uname'";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);
	if($num==0)
		echo "User doesn't exist, please enter a valid username in <a href='login.html'> Login</a> Page";
	else{
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$time = $row['timestamp'];
		if ($time<time()) {
			$dbpassword=$row['password'];
			if($password != $dbpassword){
				echo "Wrong password, please enter right password in <a href='login.html'> Login</a> Page";
				$attempt = $row['attempt']+1;
				$query="update customerreg set attempt=$attempt where uname='$uname'";
				mysqli_query($con, $query);

				if ($attempt==3) {
					$time = time()+10000;
					$query = "update customerreg set timestamp=$time where uname='$uname'";	
					mysqli_query($con, $query);
				}
			}
			else{
				$query="update customerreg set attempt=0, timestamp=0 where uname='$uname'";
				$result=mysqli_query($con,$query);
				$usertype = $row['usertype'];
				$_SESSION['uname'] = $uname;
				$_SESSION['usertype'] = $usertype;
				$_SESSION['login'] = true;
					if($usertype == "admin")
						header('location: addticket.php');
					else
						header('location: showticket.php');
			}
		}else 
	echo "Time Out";
	}?>