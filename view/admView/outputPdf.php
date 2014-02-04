<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/fpdf.php";
require_once '../../lib/AplicationRoute.php';
header("Content-Type: text/html;  charset=utf-8", true);
$rota = new AplicationRoute();

$alunos = $rota->getParams('Barcode', 'selectAlunosByTurma');

if (!empty($_GET['codTurma'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetLineWidth(0.7);

    foreach ($alunos as $a => $valor) {
        if ($a == 0) {
            $pdf->Text(40, 20, "{$valor['nomeCurso']}-{$valor['periodoCurso']} {$valor['moduloTurma']}-{$valor['prefixoTurma']}");
            $pdf->Line(40, 22, 200, 22);
            $pdf->Ln(20);
            $path = $_SERVER['DOCUMENT_ROOT'] . "/app/{$valor['nomeCurso']}-{$valor['periodoCurso']}/{$valor['semestreTurma']}_{$valor['dataTurma']}/{$valor['moduloTurma']}_{$valor['prefixoTurma']}";
            $cont = 0;
        }
        $cont++;
        if ($cont == 8) {
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 11);
            $cont = 0;
        }
        $pdf->Image($path . "/" . $valor['codaBar'] . "-" . $valor['nomeAluno'] . ".gif");
        $pdf->Ln(10);
    }
    $pdf->Output("Frequencia.pdf", 'I');
}
else
    throw new Exception("Falha - faltam Parametros");
?>
