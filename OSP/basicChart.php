<?php
/* Include all the classes */
include("./pChart/class/pDraw.class.php");
include("./pChart/class/pImage.class.php");
include("./pChart/class/pData.class.php");
/* Create your dataset object */
$myData = new pData();
/* Add data in your dataset */
$myData->addPoints(array(VOID,13,42,33,56));
/* Create a pChart object and associate your dataset */
$myPicture = new pImage(700,230,$myData);
/* Choose a nice font */
$myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11));
/* Define the boundaries of the graph area */
$myPicture->setGraphArea(60,40,670,190);
/* Draw the scale, keep everything automatic */
$myPicture->drawScale();
/* Draw the scale, keep everything automatic */
$myPicture->drawSplineChart();
/* Build the PNG file and send it to the web browser */
$myPicture->Render("basic.png");

echo "<img src='./basic.png'> ";


?>
