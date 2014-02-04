<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BarcodeController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MateriaMatriculaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MatriculaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class NovasTurmasController {

    private $turmasEmPrefixo = array();
    private $turmasEmModulo = array();

    public function novasTurmasEMAction() {

        $moduloPrf = $this->selectAtributosTurma('Ensino Regular');

        for ($i = 0; $i < count($moduloPrf); $i++) {
            $this->turmasEmPrefixo[$i] = $moduloPrf[$i]['prefixoTurma'];
        }

        $this->turmasEmPrefixo = array_reverse(array_unique($this->turmasEmPrefixo));

        $this->turmasEnsinoMedio('Terceiro', NULL);
        $this->turmasEnsinoMedio('Segundo', 'Terceiro');
        $this->turmasEnsinoMedio('Primeiro', 'Segundo');
    }

    public function novasTurmasETAction() {
        
    }

    public function novasTurmasETIMAction() {
        
    }

    public function turmasEnsinoMedio($turmaOriginal, $turmaFutura) {
        $matricula = new MatriculaModel();
        $matMtr = new MateriaMatriculaModel();
        $barCode = new BarcodeController();


        for ($i = 0; $i < count($this->turmasEmPrefixo); $i++) {

            $aln = $this->selectTurmasAlunosEM($turmaOriginal, $this->turmasEmPrefixo[$i]);

            foreach ($aln as $a => $valor) {
                $turma = (int) $valor['codTurma'];
                $barCode->delDiretorio($_SERVER['DOCUMENT_ROOT'] . "app/{$valor['nomeCurso']}-{$valor['periodoCurso']}");

                $codMatricula = (int) $valor['codMatricula'];

                $matTur = $this->selectMateriaTurmaAluno($turma);
                $today = date("d.m.Y");
                $today = implode("-", array_reverse(explode(".", $today)));

                foreach ($matTur as $m => $valMatTur) {
                    $codMatTur = (int) $valMatTur['codMateriaTurma'];
                    $matMtr->setCodMateriaTurma($codMatTur);
                    $matMtr->setCodMatricula($codMatricula);
                    $matMtr->setSituacao(5);
                    $matMtr->setDataSituacao($today);
                    $matMtr->updateSituacaoAtributos();
                }

                if ($turmaFutura != null) {

                    $turmaVai = $this->selectTurmaAlunoVai($turmaFutura, $this->turmasEmPrefixo[$i]);

                    $turmaVai = (int) $turmaVai[0]['codTurma'];
                    $matricula->setCodTurma($turmaVai);
                    $matricula->setCodMatricula($codMatricula);
                    $matricula->updateAtributos();


                    $matTurCreate = $this->selectMateriaTurmaAlunoVai($turmaFutura, $this->turmasEmPrefixo[$i]);
                    foreach ($matTurCreate as $m => $valorMatTur) {
                        
                        $barCode->geraBarCodeAction($turmaVai);
                        
                        $codMatTurma = (int) $valorMatTur['codMateriaTurma'];
                        $matMtr->setCodMateriaTurma($codMatTurma);
                        $matMtr->setCodMatricula($codMatricula);
                        $matMtr->setDataSituacao($today);
                        $matMtr->setSituacao(1);
                        $matMtr->create();
                    }
                }
            }
        }
    }

    public function selectAtributosTurma($Attr) {
        $read = new readerSqlModel();
        $read->reader("SELECT turma.moduloTurma, turma.prefixoTurma
                            FROM turma, curso
                            WHERE turma.codCurso = curso.codCurso
                            AND curso.classificacao LIKE  '%{$Attr}%'
                            ");

        return $read->getRetorno();
    }

    public function selectMateriaTurmaAlunoVai($modulo, $prefixo) {
        $read = new readerSqlModel();
        $read->reader("SELECT materiaTurma.codMateriaTurma
                        FROM materiaTurma, turma
                        WHERE turma.codTurma = materiaTurma.codTurma
                        AND turma.moduloTurma LIKE  '%{$modulo}%'
                        AND turma.prefixoTurma LIKE  '%{$prefixo}%'
                        ");

        return $read->getRetorno();
    }

    public function selectMateriaTurmaAluno($turma) {
        $read = new readerSqlModel();
        $read->reader("SELECT * 
                        FROM materiaTurma
                        WHERE codTurma ={$turma}
                        ");

        return $read->getRetorno();
    }

    public function selectTurmaAlunoVai($modulo, $prefixo) {
        $read = new readerSqlModel();
        $read->reader("SELECT turma.codTurma
                        FROM turma  
                        WHERE turma.moduloTurma LIKE  '%{$modulo}%'
                        AND turma.prefixoTurma LIKE  '%{$prefixo}%'
                        ");

        return $read->getRetorno();
    }

    public function selectTurmasAlunosEM($modulo, $prefixo) {
        $read = new readerSqlModel();
        $read->reader("SELECT aluno.codAluno, aluno.nomeAluno, curso.nomeCurso, curso.periodoCurso, turma.moduloTurma, turma.prefixoTurma, turma.semestreTurma, turma.dataTurma, aluno.codaBar, matricula.codMatricula, turma.codTurma, turma.moduloTurma
                        FROM aluno, matricula, turma, curso
                        WHERE aluno.codAluno = matricula.codAluno
                        AND turma.codTurma = matricula.codTurma
                        AND curso.codCurso = turma.codCurso
                        AND turma.moduloTurma LIKE  '%{$modulo}%'
                        AND turma.prefixoTurma LIKE  '%{$prefixo}%'
                        ");

        return $read->getRetorno();
    }

}

?>
