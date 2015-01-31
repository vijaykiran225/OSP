<?php
    session_start();
	    if(!isset($_SESSION['name'])){header("location:index.php");}
$_SESSION['views']=$_SESSION['views']+1;

	$con=@mysql_connect("localhost","root","");

mysql_select_db('userdata',$con) or die("error 1");

$s=$_SESSION['name']."log";

//$s="vijaylog";
$res=mysql_query("select id,title,artist,rating from $s where title is not null group by title,artist") or die ("error 3");
$stringr="<table cellspacing='30' cellpadding='20' border='2' align=center><tr style='background-color:#6633ff'><th>ID</th><th>Song</th><th>By</th><th>Your Rating</th></tr>";
while($n=mysql_fetch_array($res))
{
	
$stringr.="<tr style='background-color:#123456;color:white'><td>".$n['id']."</td><td>".$n['title']."</td><td>".$n['artist']."</td>";

$stringr.="<td><input type='range' name='range_".$n['id']."'  min=1 max=5 value=".$n['rating']." onchange='val(this,".$n['id'].");'> </td><td id='val".$n['id']."'>".$n['rating']."</td></tr>";
}
$stringr.="</table>";

// $r='update '.$s.' set rating='.a.value.' where id= '."+b+" .''; 
?>

<html>
<head>
<script type="text/javascript">
function val(a,v)
{
	document.getElementById("val"+v).innerHTML=a.value;
	//window.alert("content si changed");
}

</script>

<body>
<form action="updaterating.php" method="post">
<?php echo $stringr;?>
<input type="submit" name="submit"> <input type=button onclick="history.back();" value="Back">
<span id="content"></span>
</form>
</body>
</html>
