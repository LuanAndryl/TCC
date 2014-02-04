<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';

$rota = new AplicationRoute();
$presente = $rota->getParams('Chamada', 'selectAlunoSituacao', 1);
$falta = $rota->getParams('Chamada', 'selectAlunoSituacao', 3);
$_POST['codBarras'] = '20000000';

$rota->setParams('Chamada', 'addFrequencia');

?>
