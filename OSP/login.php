<?php
	session_start();
	include("connection.php");
	
	
	$u1=$_POST['username'];

	$p1=$_POST['password'];
	//echo $p1;
	$getLogin= mysql_query("SELECT * FROM login where username='$u1'  AND password='$p1'");
	
	$row= mysql_fetch_array($getLogin);
	
	//echo $status;
	if(mysql_num_rows($getLogin)==1){
			$_SESSION['views']=$_SESSION['views']+1;
			$_SESSION['IsValid']= true;
			$_SESSION['name']= $row['username'];
		//	$_SESSION['password']= $row['password'];
			$_SESSION['emailid']= $row['emailid'];
				
			
					echo "<script>window.alert('successful login , sessions started !! ');</script>";
				
			header("Location:homepage.php");
	}
	else{
		header("Location:incorrectlogin.html");
	}
	
?>
