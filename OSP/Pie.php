<?php

    session_start();
	    if(!isset($_SESSION['name'])){header("location:index.php");}


	$con=@mysql_connect("localhost","root","");

mysql_select_db('userdata',$con) or die("error 1");

$s=$_SESSION['name']."log";
$sql="SELECT rating, count(rating) FROM $s GROUP BY rating ";
$res=mysql_query($sql) or die ("error 3");
$vkey=array();
$val=array();
while($n=mysql_fetch_array($res))
{
$vkey[]="Rating : ".$n['rating'];
$val[]=$n['count(rating)'];

}	
//var_export($vkey);
//var_export($val);

 /*pChart library inclusions */
include("./pChart/class/pData.class.php");
include("./pChart/class/pDraw.class.php");
include("./pChart/class/pPie.class.php");
include("./pChart/class/pImage.class.php");
/* pData object creation */
$MyData = new pData();
/* Data definition */
$MyData->addPoints($val,"Value");
/* Labels definition */
$MyData->addPoints($vkey,"Legend");
$MyData->setAbscissa("Legend");
/* Create the pChart object */
$myPicture = new pImage(1366,768,$MyData);
/* Draw a gradient background */
$myPicture->drawGradientArea(0,0,1366,768,DIRECTION_HORIZONTAL,array("StartR"=>220,"StartG"=>220,"StartB"=>220,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
/* Add a border to the picture */
$myPicture->drawRectangle(0,0,1366,768,array("R"=>0,"G"=>0,"B"=>0));
/* Create the pPie object */
$PieChart = new pPie($myPicture,$MyData);
/* Enable shadow computing */
//$PieChart->setShadow(TRUE,array("X"=>3,"Y"=>3,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
/* Set the default font properties */
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));
/* Draw a splitted pie chart */
$PieChart->draw3DPie(600,340,array("Radius"=>160,"DrawLabels"=>true,"DataGapAngle"=>10,"DataGapRadius"=>6,"Border"=>TRUE,"SecondPass"=>false));
$PieChart->drawPieLegend(90,176,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL));


/* Render the picture (choose the best way) */
$myPicture->autoOutput("pie.png");

?>
