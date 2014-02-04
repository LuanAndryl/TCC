<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/AlunoModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/php-barcode.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class BarcodeController {

    private $basePath;
    private $delPath;

    public function geraBarCodeAction($codTurma = null) {
        $aluno = new AlunoModel();
        $alunosGerar = $this->selectAlunosByTurmaAction($codTurma);
        $this->gerarDiretorio($codTurma);
        foreach ($alunosGerar as $a => $valor) {

            $code = $valor['codAluno'];

            $tamanho = strlen($code);
            for ($i = 1; $i <= 8; $i++) {
                if ($i <= $tamanho)
                    $zero = $code;
                else
                    $zero .= '0';
            }

            $im = imagecreatetruecolor(200, 100);
            $black = ImageColorAllocate($im, 0x00, 0x00, 0x00);
            $white = ImageColorAllocate($im, 0xff, 0xff, 0xff);
            imagefilledrectangle($im, 0, 0, 300, 300, $white);
            ImageString($im, 5, 21, 0, $valor['nomeAluno'], $black);
            ImageString($im, 5, 21, 20, $valor['nomeCurso'] . " " . $valor['periodoCurso'], $black);
            $imgUrl = "{$this->basePath}/{$zero}-{$valor['nomeAluno']}.gif";
            $data = Barcode::gd($im, $black, 100, 65, 0, "code128", $zero, 2, 50);
            imagegif($im, "{$imgUrl}");
            imagedestroy($im);

            $aluno->setCod($code);
            $aluno->setCodBarAluno($zero);
            $aluno->updateCodaBar();
        }
    }

    public function gerarDiretorio($codTurma) {
        $alunosGerar = $this->selectAlunosByTurmaAction($codTurma);
        foreach ($alunosGerar as $a => $valor) {
            if ($a == 0) {
                $this->basePath = $_SERVER['DOCUMENT_ROOT'] . "/app/{$valor['nomeCurso']}-{$valor['periodoCurso']}/{$valor['semestreTurma']}_{$valor['dataTurma']}/{$valor['moduloTurma']}_{$valor['prefixoTurma']}";
                $this->delPath = $_SERVER['DOCUMENT_ROOT'] . "/app/{$valor['nomeCurso']}-{$valor['periodoCurso']}";


                if (!is_dir($this->basePath)) {
                    mkdir($this->basePath, 0777, true);
                    chmod($this->basePath, 0777);
                }
            }
        }
    }

    public function delDiretorio($caminhoParaDiretorio) {
        // definindo um array para exibir os erros
        $erros = array();
        // definindo o objeto que faz a iteração do diretório
        $diretorio = new RecursiveDirectoryIterator($caminhoParaDiretorio);
        // definindo o objeto que fará a iteração recursiva
        $arquivos = new RecursiveIteratorIterator($diretorio, RecursiveIteratorIterator::CHILD_FIRST);
        // iterando o objeto
        foreach ($arquivos as $arquivo) {
            // verificando permissão, ou seja, se o arquivo pode ser modificado
            if ($arquivo->isWritable()) {
                // verificamos se a iteração atual é de um diretório
                if ($arquivo->isDir()) {
                    // se for, utilizamos rmdir para excluir
                    rmdir($arquivo->getPathname());
                    // senão, testamos se é um arquivo
                } elseif ($arquivo->isFile()) {
                    // para arquivos, utilizamos o unlink
                    unlink($arquivo->getPathname());
                }
                // caso o arquivo não possa ser modificado, gravamos na variável o nome do arquivo e a permissão do arquivo
            } else {
                $erros [] = 'O arquivo ' . $arquivo->getPathname() . ' tem permissões ' . $arquivo->getPerms() . ' e não pode ser excluído.';
            }
        }
        // caso existam erros, mostramos, ou exibimos mensagem de sucesso.
        if (count($erros)) {
            return implode('<br />', $erros);
        } else {
            return 'Arquivos excluídos com sucesso.';
        }
    }

    public function selectAlunosByTurmaAction($codTurma = null) {
        $read = new readerSqlModel();

        if (!empty($_GET['codTurma']))
            $tur = $_GET['codTurma'];
        else if (!empty($codTurma) and $codTurma = !null)
            $tur = $codTurma;
        else
            throw new Exception("Falha - falta parametros");
        $read->reader("SELECT aluno.codAluno, aluno.nomeAluno, curso.nomeCurso, curso.periodoCurso, turma.moduloTurma, turma.prefixoTurma,turma.semestreTurma,turma.dataTurma,aluno.codaBar
                           FROM aluno, matricula, turma, curso
                            WHERE aluno.codAluno = matricula.codAluno
                            AND turma.codTurma = matricula.codTurma
                            AND curso.codCurso = turma.codCurso
                            AND turma.codTurma ={$tur}
                        ");

        return $read->getRetorno();
    }

}

?>
