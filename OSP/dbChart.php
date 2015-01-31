<?php
/* pChart library inclusions */
include("./pChart/class/pData.class.php");
include("./pChart/class/pDraw.class.php");
include("./pChart/class/pImage.class.php");
/* Create and populate the pData object */
$MyData = new pData();
$MyData->addPoints(array(2,7,5,18,19,22,23,25,22,10,84,34),"DEFCA");
$MyData->addPoints(array(52,37,45,68,11,2,2,45,22,1,8,13),"DEFCwA");
$MyData->addPoints(array(12,17,15,18,19,12,43,2,2,14,8,3),"DEFCswA");
$MyData->setAxisName(0,"Play Counts");
$MyData->setAxisDisplay(0,AXIS_FORMAT_CURRENCY);
$MyData->addPoints(array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aou","Sep","Oct","Nov","Dec"),"Labels");
$MyData->setSerieDescription("Labels","Months");
$MyData->setAbscissa("Labels");
$MyData->setPalette("DEFCA",array("R"=>55,"G"=>91,"B"=>127));
$MyData->setPalette("DEFCwA",array("R"=>155,"G"=>97,"B"=>17));
$MyData->setPalette("DEFCswA",array("R"=>95,"G"=>81,"B"=>27));
/* Create the pChart object */
$myPicture = new pImage(700,230,$MyData);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>220,"StartG"=>220,"StartB"=>220,"EndR"=>255,"EndG"=>255,"EndB"=>255,"Alpha"=>100));

$myPicture->drawRectangle(0,0,699,259,array("R"=>200,"G"=>200,"B"=>200));
/* Write the picture title */
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>11));
$myPicture->drawText(60,35,"Charts for  the User :vijay",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMLEFT));
/* Do some cosmetic and draw the chart */
$myPicture->setGraphArea(60,40,670,190);
$myPicture->drawFilledRectangle(60,40,670,290,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
$myPicture->drawScale(array("GridR"=>180,"GridG"=>180,"GridB"=>180));
$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/pf_arma_five.ttf","FontSize"=>6));
$myPicture->drawSplineChart();
$myPicture->setShadow(FALSE);
/* Write the chart legend */
//$myPicture->drawLegend(643,210,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));




/* Write a legend box *
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/MankSans.ttf","FontSize"=>10,"R"=>30,"G"=>30,"B"=>30));
$myPicture->drawLegend(230,60,array("BoxSize"=>4,"R"=>173,"G"=>163,"B"=>83,"Surrounding"=>20,"Family"=>LEGEND_FAMILY_CIRCLE));*
/* Write a legend box */
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>19,"R"=>70,"G"=>190,"B"=>56));
$myPicture->drawLegend(400,60,array("Style"=>LEGEND_BOX,"Family"=>LEGEND_FAMILY_CIRCLE,"BoxSize"=>4,"R"=>173,"G"=>163,"B"=>83,"Surrounding"=>20,"Alpha"=>50));
/* Write a legend box *
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Silkscreen.ttf","FontSize"=>6));
$myPicture->drawLegend(70,150,array("Mode"=>LEGEND_HORIZONTAL, "Family"=>LEGEND_FAMILY_CIRCLE));
/* Write a legend box *
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/pf_arma_five.ttf","FontSize"=>6));
$myPicture->drawLegend(400,150,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL,"BoxWidth"=>30,"Family"=>LEGEND_FAMILY_LINE));
/* Write a legend box *
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Silkscreen.ttf","FontSize"=>6));
$myPicture->drawFilledRectangle(1,200,698,228,array("Alpha"=>30,"R"=>255,"G"=>255,"B"=>255));
$myPicture->drawLegend(10,208,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));






/* Render the picture (choose the best way) */
$myPicture->autoOutput("drawSimple.png");
//echo "<img src='./drawSimple.png'> ";
?>
