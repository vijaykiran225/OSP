<?php
	  include("connection.php");	
	  
	  $username=$_POST["username"];
	  $password=$_POST["password"];
	  $cpassword=$_POST["cpassword"];
	  $email=$_POST["email"];
	 $location=$_POST["location"];
	 $age=$_POST["age"];
	 
 $count= mysql_query("SELECT * FROM login where username='$username'");
	  
	  if(mysql_num_rows($count)==0){
		if($password==$cpassword){
		 session_start();
           $q="INSERT INTO  login VALUES (NULL,'$username', '$password', '$email','$age','$location')";
		 $res=mysql_query($q);
		$_SESSION['views']=$_SESSION['views']+1;
		$_SESSION['IsValid']= true;
		$_SESSION['name']= $username;
		$_SESSION['email']=$email;
  //if((int)$res==1)		


mysql_select_db("userdata",$con);

$sql1="create table ".$username."log (id int(11)  primary key auto_increment,title varchar(60)  null  ,	artist  varchar(60) null ,	album varchar(60)  null, genre varchar(60)  null, 	releasedate varchar(10)  null,	duration int(20)  null,	author varchar(60)  null, playdate timestamp not null default CURRENT_TIMESTAMP ,rating int(11) not null default '3' )";
echo $sql1;
mysql_query($sql1) or die(mysql_error());
		header("Location:index.php");
	  }
	  else{
		header("Location:passwordnotmatch.html");
	  }
	 }else{
	 header("Location:username.html");

		}
	  mysql_close($con);
	  //include("dbclose.php");
?>
