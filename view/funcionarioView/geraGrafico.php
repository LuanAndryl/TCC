<?php

/* pChart library inclusions */
include("../../estilo/pChart/class/pData.class.php");
include("../../estilo/pChart/class/pDraw.class.php");
include("../../estilo/pChart/class/pImage.class.php");
require_once $_SERVER['DOCUMENT_ROOT'] . "app/lib/AplicationRoute.php";

$array = array();
$rota = new AplicationRoute();
$result = array();
$myData = new pData();
for ($o = 0; $o <= 12; $o++) {
    $o = "0" . $o;
    $freq = $rota->getParams('FrequenciaHome', 'frequeciaDia', $o);
    $freq = $freq[0]['frequencia'];
    $freq = explode(".", $freq);
    $myData->addPoints($freq, "Serie1");
}
$myData->setSerieDescription("Serie1", "Total");
$myData->setSerieOnAxis("Serie1", 0);





$myData->addPoints(array("Fereveiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"), "Absissa");
$myData->setAbscissa("Absissa");

$myData->setAxisPosition(0, AXIS_POSITION_LEFT);
$myData->setAxisName(0, "Frequência");
$myData->setAxisUnit(0, "%");

$myPicture = new pImage(1000, 300, $myData);
$Settings = array("StartR" => 209, "StartG" => 250, "StartB" => 255, "EndR" => 13, "EndG" => 166, "EndB" => 151, "Alpha" => 50);
$myPicture->drawGradientArea(0, 0, 1000, 300, DIRECTION_VERTICAL, $Settings);

$myPicture->drawRectangle(0, 0, 999, 299, array("R" => 0, "G" => 0, "B" => 0));

$myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 50, "G" => 50, "B" => 50, "Alpha" => 20));

$myPicture->setFontProperties(array("FontName" => "../../estilo/pChart/fonts/Bedizen.ttf", "FontSize" => 20));
$TextSettings = array("Align" => TEXT_ALIGN_TOPRIGHT
    , "R" => 255, "G" => 255, "B" => 255);
$myPicture->drawText(500, 20, "Gráfico De Frequência Referente", $TextSettings);

$myPicture->setShadow(FALSE);
$myPicture->setGraphArea(50, 50, 975, 260);
$myPicture->setFontProperties(array("R" => 0, "G" => 0, "B" => 0, "FontName" => "../../estilo/pChart/fonts/GeosansLight.ttf", "FontSize" => 10));

$Settings = array("Pos" => SCALE_POS_LEFTRIGHT
    , "Mode" => SCALE_MODE_FLOATING
    , "LabelingMethod" => LABELING_ALL
    , "GridR" => 255, "GridG" => 255, "GridB" => 255, "GridAlpha" => 50, "TickR" => 0, "TickG" => 0, "TickB" => 0, "TickAlpha" => 50, "LabelRotation" => 0, "CycleBackground" => 1, "DrawXLines" => 1, "DrawSubTicks" => 1, "SubTickR" => 255, "SubTickG" => 0, "SubTickB" => 0, "SubTickAlpha" => 50, "DrawYLines" => ALL);
$myPicture->drawScale($Settings);

$myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 50, "G" => 50, "B" => 50, "Alpha" => 10));

$Config = array("DisplayValues" => 1);
$myPicture->drawSplineChart($Config);
$myPicture->autoOutput("grafico.png");
?> 