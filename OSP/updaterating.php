<?php

	    session_start();
	    if(!isset($_SESSION['name'])){header("location:index.php");}


	$con=@mysql_connect("localhost","root","");

mysql_select_db('userdata',$con) or die("error 1");

$s=$_SESSION['name']."log";
foreach($_POST as $k=>$v)
{
	if($v!="Submit Query"){
	echo "<br> $k is $v";
	$r=explode("_",$k);
	echo "<br><br>".$r[1] ."is r[1]";
	$a=$r[1];
	mysql_query("update $s set rating=$v where id=$a")or die(mysql_error());
	}
}

echo "<script>window.alert(\"rating updated\"); </script>";
header("location:homepage.php");

?>
