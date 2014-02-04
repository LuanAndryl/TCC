<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

?>


<div class="container">

    <script src="imagemap.js" type="text/javascript"></script>
    <img src="geraGrafico.php" id="testPicture" alt="" class="pChartPicture"/>
    <script>
        addImage("testPicture", "pictureMap", "geraGrafico.php?ImageMap=get");
    </script>
</div>
<br>
<br>
<br>
<br>
<?php include 'footer.html' ?>