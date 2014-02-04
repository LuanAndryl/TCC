<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
$rota = new AplicationRoute();

$retorno = $rota->getParams('Frequencia', 'frequeciaDia', 'false');


?>
