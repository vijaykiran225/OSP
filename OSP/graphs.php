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
$myPicture = new pImage(700,230,$MyData);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>220,"StartG"=>220,"StartB"=>220,"EndR"=>255,"EndG"=>255,"EndB"=>255,"Alpha"=>100));

$myPicture->drawRectangle(0,0,699,259,array("R"=>200,"G"=>200,"B"=>200));
/* Write the picture title */
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>11));
$myPicture->drawText(60,35,"Charts for  the User :$s",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMLEFT));
/* Do some cosmetic and draw the chart */
$myPicture->setGraphArea(60,40,670,190);
$myPicture->drawFilledRectangle(60,40,670,290,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
$myPicture->drawScale(array("GridR"=>180,"GridG"=>180,"GridB"=>180));
$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/pf_arma_five.ttf","FontSize"=>6));
$myPicture->drawSplineChart(array("DisplayValues"=>TRUE));
$myPicture->setShadow(FALSE);
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>19,"R"=>70,"G"=>190,"B"=>56));




/* Render the picture (choose the best way) */
$myPicture->autoOutput("drawSimple.png");

?>
