<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/ChamadaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class FrequenciaHomeController {

    public function frequeciaDiaAction($mes) {

        $aulas = $this->selectAulasDadas($mes);
        $falta = array();
        $resultado = array();

        foreach ($aulas as $m => $valorMat) {

            $falta = $this->selectFaltaAluno($mes);
            $resultado = array_merge($falta, $resultado);
        }


        return $resultado;
    }

    public function selectFaltaAluno($mes) {
        $reader = new readerSqlModel();

        $reader->reader("SELECT count(aluno.codAluno),materia.codMateria,aluno.codAluno
                        FROM aluno, matricula, materiamatricula, materiaturma, frequencia, chamada, materia
                        WHERE aluno.codAluno = matricula.codAluno
                        AND matricula.codMatricula = materiamatricula.codmatricula
                        AND frequencia.codmateriamatricula = materiamatricula.codmateriamatricula
                        AND frequencia.codChamada = chamada.codChamada
                        AND chamada.codMateriaTurma = materiaturma.codMateriaturma
                        AND materiaturma.codmateria = materia.codmateria
                        AND materiaMatricula.situacao =1 ");

        $retorno = $reader->getRetorno();


        for ($i = 0; $i < count($retorno); $i++) {
            $aulasVistas = $retorno[$i]['count(aluno.codAluno)'];
            $totalAula = $this->selectAulasDadas($mes);
            foreach ($totalAula as $k => $total) {
                $totAula = $total['COUNT( codChamada )'];
                if ($totAula == 0) {
                    $retorno[$i]['frequencia'] = '00.00';
                } else {
                    $percent = 100 / $totAula;
                    $presente = ($aulasVistas * $percent) / $aulasVistas;
                    $presente = number_format($presente, 2, '.', '');
                    $retorno[$i]['frequencia'] = $presente;
                }
            }
        }
        return $retorno;
    }

    public function selectAulasDadas($mes) {
        $reader = new readerSqlModel();
        $reader->reader("SELECT COUNT( codChamada ) 
                         FROM chamada
                         WHERE dataChamada LIKE  '%{$mes}%'
                         
                         ");
        return $reader->getRetorno();
    }

}

?>
