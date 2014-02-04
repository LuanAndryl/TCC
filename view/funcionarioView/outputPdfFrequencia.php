<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/app/lib/fpdf.php";
require_once '../../lib/AplicationRoute.php';
header("Content-Type: text/html;  charset=utf-8", true);
if (!empty($_GET['codTurma'])) {

    $rota = new AplicationRoute();
    $alunos = $rota->getParams('Frequencia', 'selectAlunoByTurma');
    $materia = $rota->getParams('Frequencia', 'selectMateriaByTurma');
    $curso = $rota->getParams('Turma', 'selectCursoTurma', $_GET['codTurma']);
    $class = $curso[0]['classificacao'];

    if ($class == 'Ensino Técnico')
        $mf = TRUE;
    else
        $mf = FALSE;

    $retorno = $rota->getParams('Frequencia', 'frequeciaDia', $mf);


    $pdf = new FPDF('L');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetLineWidth(0.7);
    $pdf->Text(40, 20, "{$curso[0]['nomeCurso']}-{$curso[0]['periodoCurso']} {$curso[0]['moduloTurma']}-{$curso[0]['prefixoTurma']}  Frequencia");
    $pdf->Line(40, 22, 200, 22);
    $pdf->Ln(20);
    $pdf->Cell(70, 6, 'Nome', 1, 0, 'L');
    $nomeMat = null;
    foreach ($materia as $m => $mat) {
        if (strlen($mat['nomeMateria']) > 10) {
            $strMt = explode(" ", $mat['nomeMateria']);
            for ($i = 0; $i < count($strMt); $i++) {
                $nomeMat .= substr($strMt[$i], 0, 1);
            }
            $pdf->Cell(15, 6, $nomeMat, 1, 0, 'L');
        } else {
            $pdf->Cell(15, 6, $mat['nomeMateria'], 1, 0, 'L');
        }
        $nomeMat = "";
    }
    $pdf->Cell(25, 6, 'Ciente', 1, 0, 'L');
    $pdf->Ln(7);
    foreach ($alunos as $a => $valor) {
        $nome = null;
        $sobreNome = null;

        if (strlen($valor['nomeAluno']) > 40) {
            $strMt = explode(" ", $valor['nomeAluno']);
            for ($i = 2; $i < count($strMt); $i++) {
                $nome = $strMt[0] . " " . $strMt[1];
                $sobreNome .="." . substr($strMt[$i], 0, 1);
            }
            $nome = $nome . " " . $sobreNome;
            $pdf->Cell(70, 6, $nome, 1, 0, 'L');
        } else {
            $pdf->Cell(70, 6, $valor['nomeAluno'], 1, 0, 'L');
        }

        foreach ($materia as $m => $vale) {
            foreach ($retorno as $r => $ret) {
                if (($valor['codAluno'] == $ret['codAluno']) and ($vale['codMateria'] == $ret['codMateria'])) {
                    $pdf->Cell(15, 6, $ret['frequencia'] . "%", 1, 0, 'L');
                }
            }
        }

        $pdf->Cell(25, 6, '_________', 1, 0, 'L');
        $pdf->Ln(6);
    }
    $pdf->Output("frequencia{$curso[0]['nomeCurso']}-{$curso[0]['periodoCurso']} {$curso[0]['moduloTurma']}-{$curso[0]['prefixoTurma']}.pdf", 'I');
}
else
    throw new Exception("Falha - faltam Parametros");
?>
