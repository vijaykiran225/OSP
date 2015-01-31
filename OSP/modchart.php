<?php
session_start();
if(!(isset($_SESSION['name'])))
{
 header("location:index.php"); 
}


	$con=@mysql_connect("localhost","root","");

mysql_select_db('userdata',$con) or die("error 1");
$s=$_SESSION['name']."log";
$res=mysql_query("select artist,count(*) from $s where artist is not null group by artist") or die ("error 3");
$artist=array();
$Pcount=array();

include("./pChart/class/pData.class.php");
include("./pChart/class/pDraw.class.php");
include("./pChart/class/pImage.class.php");

while($arrayRow=mysql_fetch_array($res))
{
	$Pcount[]=$arrayRow['count(*)'];
	$artist[]=$arrayRow['artist'];
}
$MyData = new pData();
$MyData->addPoints($Pcount,"pcount");
$MyData->setAxisName(0,"Play Counts");
$MyData->setAxisName(1,"Artists");
$MyData->setAxisDisplay(0,AXIS_FORMAT_CURRENCY);
$MyData->addPoints($artist,"Artists");
$MyData->setSerieDescription("Artists","Singers");
$MyData->setAbscissa("Artists");
$MyData->setPalette("pcount",array("R"=>95,"G"=>81,"B"=>27));
/* Create the pChart object */

/* Render the picture (choose the best way) */
//$myPicture->autoOutput("drawSimple.png");

$myPicture = new pImage(1370,670,$MyData);
$myPicture->setGraphArea(400,60,1070,670);
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>13));
$myPicture->drawFilledRectangle(500,60,670,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
$myPicture->drawScale(array("Pos"=>SCALE_POS_TOPBOTTOM,"DrawSubTicks"=>TRUE));
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->drawSplineChart();
$myPicture->setShadow(FALSE);
/* Write the legend*/
//$myPicture->drawLegend(510,205,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));


$myPicture->autoOutput("drawSimple.png");
?>
