<?php
	$link=mysql_connect("localhost","root","");
	$sql="create database musicmanager";
	mysql_query($sql) or die("DB creation error".mysql_error());
	$sql1="create table login(id int(11)  primary key auto_increment,username varchar(30) unique , password varchar(20) not null,email varchar(25) not null,age int (3) not null,location varchar(20) null)";
	mysql_select_db("musicmanager",$link);

	mysql_query($sql1) or die("table creation error".mysql_error());
	$sql1="create table audio(id int(11)  primary key auto_increment,title varchar(60) not null,	artist  varchar(60) not null,	album varchar(60) not null, genre varchar(60) not null, 	releasedate int(10) not null,	duration int(10) not null,	author varchar(60) not null)";
	mysql_select_db("MusicManager",$link);

	mysql_query($sql1) or die("table creation error".mysql_error());

	$sql="create database userdata";
	mysql_query($sql) or die("DB creation error".mysql_error());

header("location:index.php");
?>
