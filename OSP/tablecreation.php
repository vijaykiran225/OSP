<?php
//after registration comes here..
$con=mysql_connect("localhost","root","");
$id=1;//$_POST["id"];
$sql="select username from musicmanager.login where id=1";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$TableName=$row['username'];

$sql1="create table $TableName (id int(11)  primary key auto_increment,title varchar(30) not null unique ,	artist  varchar(20) not null ,	album varchar(20) not null, genre varchar(20) not null, 	releasedate int(10) not null,	duration int(20) not null,	author varchar(20) not null, playdate timestamp not null default CURRENT_TIMESTAMP 	, count int(6) not null)";
mysql_select_db("musicmanager",$con);
echo $sql1;
mysql_query($sql1) or die(mysql_error());
?>