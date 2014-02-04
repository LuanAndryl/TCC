<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/ChamadaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class FrequenciaController {

    public function frequenciaMateriaAction($codAluno) {
        if (!empty($_GET['codTurma']) and !empty($_GET['codMateria']) and !empty($codAluno)) {
            $codTurma = (int) $_GET['codTurma'];
            $codMateria = (int) $_GET['codMateria'];

            $reader = new readerSqlModel();

            $reader->reader("SELECT chamada.dataChamada, frequencia.falta
                            FROM frequencia, chamada, materiaturma, aluno, matricula, materiamatricula
                            WHERE frequencia.codchamada = chamada.codchamada
                            AND chamada.codmateriaturma = materiaturma.codmateriaturma
                            AND aluno.codAluno = matricula.codAluno
                            AND materiamatricula.codMatricula = matricula.codMatricula
                            AND frequencia.codmateriamatricula = materiamatricula.codMateriaMatricula
                            AND aluno.codAluno ={$codAluno}
                            AND materiaturma.codTurma ={$codTurma}
                            AND materiaturma.codMateria ={$codMateria}");

            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

    public function frequenciaAlunoAction($codAluno) {
        $materia = $this->selectMateriaByTurma();
        $falta = array();
        $resultado = array();

        foreach ($materia as $m => $valorMat) {
            $codMateria = $valorMat['codMateria'];
            $matTur = $valorMat['codMateriaTurma'];
            $falta = $this->selectFaltaAluno($codMateria, 1, $codAluno, $matTur);
            $resultado = array_merge($falta, $resultado);
        }


        return $resultado;
    }

    public function frequeciaDiaAction($mf) {
        $alunos = $this->selectAlunoByTurmaAction();
        $materia = $this->selectMateriaByTurma();
        $falta = array();
        $resultado = array();
        foreach ($alunos as $a => $valor) {
            foreach ($materia as $m => $valorMat) {
                $codAluno = $valor['codAluno'];
                $codMateria = $valorMat['codMateria'];
                $matTur = $valorMat['codMateriaTurma'];

                $falta = $this->selectFaltaAluno($codMateria, 1, $codAluno, $matTur, $meiaFalta = $mf);
                $resultado = array_merge($falta, $resultado);
            }
        }
        
        return $resultado;
    }

    public function selectTurmaByAlunoAction($codAluno) {
        $reader = new readerSqlModel();

        $reader->reader("SELECT turma.codTurma, turma.prefixoTurma, turma.moduloTurma
                            FROM aluno, matricula, turma
                            WHERE aluno.codAluno = matricula.codAluno
                            AND matricula.codTurma = turma.codTurma
                            AND aluno.codAluno ={$codAluno}");

        return $reader->getRetorno();
    }

    public function selectMateriaByTurma() {
        if (!empty($_GET['codTurma'])) {
            $codTurma = (int) $_GET['codTurma'];
            $reader = new readerSqlModel();

            $reader->reader("SELECT materia.codMateria,materia.nomeMateria,materiaturma.codMateriaTurma
                            FROM materia, materiaturma, turma
                            WHERE materia.codMateria = materiaturma.codMateria
                            AND materiaturma.codTurma = turma.codTurma
                            AND turma.codTurma ={$codTurma}");

            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

    public function selectFaltaAluno($materia, $falta, $codAluno, $matTur, $meiaFalta = FALSE) {
        $reader = new readerSqlModel();
        $reader->reader("SELECT count(aluno.codAluno),materia.codMateria,aluno.codAluno
                        FROM aluno, matricula, materiamatricula, materiaturma, frequencia, chamada, materia
                        WHERE aluno.codAluno = matricula.codAluno
                        AND matricula.codMatricula = materiamatricula.codmatricula
                        AND frequencia.codmateriamatricula = materiamatricula.codmateriamatricula
                        AND frequencia.codChamada = chamada.codChamada
                        AND chamada.codMateriaTurma = materiaturma.codMateriaturma
                        AND materiaturma.codmateria = materia.codmateria
                        AND materiamatricula.situacao =1
                        AND materia.codMateria ={$materia}
                        AND frequencia.falta ={$falta}
                        AND aluno.codAluno ={$codAluno}");

        $retorno = $reader->getRetorno();
        if ($meiaFalta == TRUE) {
            $meiaF = $this->selectMeiaFalta($materia, $codAluno);
            foreach ($meiaF as $k => $valor) {
                $meiaAula = (double) $valor['count(aluno.codAluno)'];
                $meiaAula += $meiaAula;
            }

            for ($i = 0; $i < count($retorno); $i++) {
                $aulasVistas = $retorno[$i]['count(aluno.codAluno)'];
                $totalAula = $this->selectAulasDadas($matTur);
                foreach ($totalAula as $k => $total) {
                    $totAula = $total['COUNT( codChamada )'];
                    if ($totAula == 0) {
                        $retorno[$i]['frequencia'] = '00.00';
                    } else {
                        $percent = 100 / $totAula;
                        $presente = $aulasVistas * $percent;
                        $meioPerc = $percent / 2;
                        $meiaAula = $meiaAula * $meioPerc;
                        
                        $presente = $presente + $meiaAula;
                        $presente = number_format($presente, 2, '.', '');
                        $retorno[$i]['frequencia'] = $presente;
                    }
                }
            }
            return $retorno;
        } else {
            for ($i = 0; $i < count($retorno); $i++) {
                $aulasVistas = $retorno[$i]['count(aluno.codAluno)'];
                $totalAula = $this->selectAulasDadas($matTur);
                foreach ($totalAula as $k => $total) {
                    $totAula = $total['COUNT( codChamada )'];
                    if ($totAula == 0) {
                        $retorno[$i]['frequencia'] = '00.00';
                    } else {
                        $percent = 100 / $totAula;
                        $presente = $aulasVistas * $percent;
                        $presente = number_format($presente, 2, '.', '');
                        $retorno[$i]['frequencia'] = $presente;
                    }
                }
            }
            return $retorno;
        }
    }

    public function selectMeiaFalta($materia, $codAluno) {
        $leitor = new readerSqlModel();
        $leitor->reader("SELECT count(aluno.codAluno),materia.codMateria,aluno.codAluno
                        FROM aluno, matricula, materiamatricula, materiaturma, frequencia, chamada, materia
                        WHERE aluno.codAluno = matricula.codAluno
                        AND matricula.codMatricula = materiamatricula.codmatricula
                        AND frequencia.codmateriamatricula = materiamatricula.codmateriamatricula
                        AND frequencia.codChamada = chamada.codChamada
                        AND chamada.codMateriaTurma = materiaturma.codMateriaturma
                        AND materiaturma.codmateria = materia.codmateria
                        AND materiamatricula.situacao =1
                        AND materia.codMateria ={$materia}
                        AND frequencia.falta = 2
                        AND aluno.codAluno ={$codAluno}");

        return $leitor->getRetorno();
    }

    public function selectAulasDadas($matTur) {
        $reader = new readerSqlModel();
        $reader->reader("SELECT COUNT( codChamada ) 
                         FROM chamada
                         WHERE codMateriaTurma ={$matTur} ");
        return $reader->getRetorno();
    }

    public function selectAlunoByTurmaAction() {
        if (!empty($_GET['codTurma'])) {
            $codTurma = $_GET['codTurma'];
            $reader = new readerSqlModel();
            $reader->reader("SELECT aluno.nomeAluno, aluno.codAluno
                                FROM aluno, turma, matricula
                                WHERE aluno.codAluno = matricula.codAluno
                                AND matricula.codTurma = turma.codTurma
                                AND turma.codTurma ={$codTurma} ");
            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

    public function selectMateriaByTurmaAction() {
        if (!empty($_GET['codTurma'])) {
            $codTurma = $_GET['codTurma'];
            $reader = new readerSqlModel();
            $reader->reader("SELECT materia.nomeMateria,materia.codMateria
                                FROM materia, turma, materiaturma
                                WHERE materiaturma.codmateria = materia.codMateria
                                AND materiaturma.codTurma = turma.codTurma
                                AND turma.codTurma ={$codTurma} ");
            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

}

?>
