<?php

	    session_start();
	    if(!isset($_SESSION['name'])){header("location:index.php");}
	$con=@mysql_connect("localhost","root","");
$_SESSION['views']=$_SESSION['views']+1;
mysql_select_db('userdata',$con) or die("error 1");
$col="";
$col2="";
$count=0;

$s=$_SESSION['name']."log";
$res=mysql_query("select title,artist,count(*),rating from $s where title is not null group by title,artist order by count(*) desc") or die ("error 3");
$stringr="<center><table cellspacing='30' cellpadding='20' align=center><tr style='background-color:#6633ff'><th>Song</th><th>By</th><th>Your Count</th><th>Your Rating</th></tr>";
while($n=mysql_fetch_array($res))
{
$count++;
	if($count%2==0){$col="#c511d3";$col2="white";}
	else {$col="#a76549";$col2="white";}
$stringr.="<tr style='color:white'><td style='background-color:$col;color:$col2'>".$n['title']."</td><td style='background-color:$col;color:$col2'>".$n['artist']."</td><td style='background-color:$col;color:$col2'>".$n['count(*)']."</td><td style='background-color:$col;color:$col2'>".$n['rating']."</td></tr>";
}
$stringr.="</table></center>";

$res=mysql_query("select * from $s where title is not null order by playdate desc") or die ("error 3");
$log="<br><br><table cellspcaing=10 cellpadding=10><div id='nope'>";

while($n=mysql_fetch_array($res))
{
	$count++;
	if($count%2==0){$col="#2259db";$col2="white";}
	else {$col="#f5335a";$col2="black";}
		$log.="<tr ><td style='background-color:$col;color:$col2'>"
		.$n['id']."</td><td style='background-color:$col;color:$col2'>".$n['title']."</td><td style='background-color:$col;color:$col2'> by ".$n['artist']."</td><td style='background-color:$col;color:$col2'>from ".$n['album']."</td><td style='background-color:$col;color:$col2'> with genre ".$n['genre']."</td><td style='background-color:$col;color:$col2'>released on ".$n['releasedate']."</td><td style='background-color:$col;color:$col2'>played on ".$n['playdate']."</td><td style='background-color:$col;color:$col2'>with rating ".$n['rating']."</td></tr>";
}
$log.="</div></table>";

//$count=0;
$res=mysql_query("select title,artist,count(*),rating from $s where title is not null group by title,artist order by rating desc") or die ("error 3");
$ratings="<center><table cellspacing='30' cellpadding='20' border='2' align='center'><tr style='border:none;'><th>Song</th><th>By</th><th>Your Count</th><th>Your Rating</th></tr>";
while($n=mysql_fetch_array($res))
{
$count++;
	if($count%2==0){$col="#8753db";$col2="white";}
	else {$col="#4f5959";$col2="white";}
$ratings.="<tr ><td style='background-color:$col;color:$col2'>".$n['title']."</td><td style='background-color:$col;color:$col2'>".$n['artist']."</td><td style='background-color:$col;color:$col2'>".$n['count(*)']."</td><td style='background-color:$col;color:$col2'>".$n['rating']."</td></tr>";
}
$ratings.="</table></center>";

//echo $stringr;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> Home </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
<script type="text/javascript" href="js/bootstrap.js">
</script>
<script type="text/javascript" href="js/bootstrap.min.js">
</script>
<script type="text/javascript" href="js/jquery-1.11.0.js">
</script>
        <link rel="shortcut icon" href="./images/favicon.ico"> 
       <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
		  <style type="text/css">
	.banner{position:static;top:0%;width:100%;border:none;border-color:#3300ff;
	color:black;border-radius:14pt 15pt 1em 1em;}
	.list{list-style:square}
	input {border:none;height:18pt;background-color:#988f94;border-radius:2pt;}

	.leftmove{position:relative;top:20%;right:10pt;bottom:4pt;text-align:right;}
	.image{position:relative;left:0px;}
	.buttonGMI{background-color:#0033ff;color:white;border-radius:5pt;font-size:1em; padding-bottom: 15px;}
	.buttonGMI:hover{background-color:red;color:white;box-shadow:0px 10px 2px green;}
	td {border:none;border-radius:10pt;}
	 #nope{border:none;border-radius:0pt;}
	#shh{border:none;border-color:blue;border-width:10px;clear:left;}
	#shh:hover{border-bottom:solid black ;border-radius:20px;}

	.transit{bottom:0%;
width:100px;
height:100px;
text-align:center;

transition-property:width , height;
transition-duration:1s;
transition-timing-function:linear;
transition-delay:0s;

-moz-transition-property:all;
-moz-transition-duration:1s;
-moz-transition-timing-function:ease;
-moz-transition-delay:0s;
}
.outputcc{
}

.transit:hover
{
margin-right:200px;
/*opacity:0.3;*/
color:red;
width:200px; 
font-size:20pt;
}
	.movedown{border:solid;border-color:black;border-radius:12px;}
	
  </style>
  <script type="text/javascript">
  function call(a)
  {
a.setAttribute("style","color:red;");
  document.getElementById("output").innerHTML=" <br><br><br><center><ul><li>Our website helps the registered Users to manage their songs played from our media player , in their homepage </li><br><li> we provide Analysis report of whats their \" Music \" Ststus with charts , progress bars , pie charts etc. </li></ul><br>So Please Select a Menu  Option to start Managing Music !! </center>";
  //log();

  }
  function topr(a){
  a.setAttribute("style","color:red;");
  document.getElementById("output").innerHTML="<br><br><br><center>Details based on Songs played more no of times . (Play count)</center><?php echo $stringr;?>";
//document.getElementById("output22").setAttribute("style","bgcolor:blue");
  }
function	charts(a){
	a.setAttribute("style","color:red;");
//	document.getElementById("output").setAttribute("style","visibility:visible");

document.getElementById("output").innerHTML="<br><br><br><center>Charts are on the way<br><ul><li> <a href='progress.php'>Check in  Progress Bar</a></li><li><a href='Pie.php'>Check in Pies</a></li><li><a href='modchart.php'>Check in Graphs</a></li><ul></center>";
}
function rating(a){
a.setAttribute("style","color:red;");
document.getElementById("output").innerHTML="<br><br><br><center>Ratings aren't proper ,<br> then <a href='rating.php'>Modify Rating</a></center><?php echo $ratings; ?>";
}

function aboutus(a){
a.setAttribute("style","color:red;");
document.getElementById("output").innerHTML="<br><br><br><center>Designed by <font size=7><br>&copy;Kalyan Singh <br> &copy;Siva Sai Reddy  <br> &copy;Vijay Kiran</font></center>";
}
function gone(a)
{
document.getElementById("output").innerHTML="<br><br><br><center>Please Select a Menu  Option to continue</center>";
a.setAttribute("style","color:black;");

}
function log(a)
{
a.setAttribute("style","color:red;");
document.getElementById("output").innerHTML="<?php echo $log; ?>";
}
  </script>

 </head>

 <body onload="" style="background-image:url('images/bg.jpg')">
 	
  <div id="page-header" class="">
  <div id="txt" style="float:left;font-size:1.5em;font-family: Arial;">
	
  </div>
	<div class="navbar-fixed-top" ><center>Music Referred (Online Music Manager)</center>
	
<!--	<div id="" class='navbar-fixed-top'>-->
	<?php 
		//$_SESSION['views']++;
		echo $_SESSION['name']."<a href='logout.php' >Clik here to logout</a>";
		?>

	</div>
	
	
  </div>
  </form>
  <div id="breadcrumb" class="">
<table  align="center" cellspacing="20px"><tr>
	<td  class="transit" id="shh" onclick ="call(this)" onblur="gone(this)"> Home</td>
	<td  class="transit" id="shh" onblur="gone(this)" onclick="topr(this)" >Top Referred Songs</td>
	<td class="transit" id="shh" onblur="gone(this)" onclick="log(this)" >Log</td>
	<td class="transit" id="shh" onblur="gone(this)" onclick="charts(this)" >Charts</td>
		<td class="transit" id="shh" onblur="gone(this)" onclick="rating(this)" >Rating</td>
				<td class="transit" id="shh" onblur="gone(this)" onclick="aboutus(this)" >About Us</td></tr>
</table></div>

  <div id="output" class="outputcc" style="" >
<br><br><br><center>Please Select a Menu  Option to continue</center>
  </div>
  <div id="output22" class="">

  </div>
 </body>
</html>
