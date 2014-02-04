<?php

require_once ('../../model/configModel.php');
/**
 * CursoModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class CursoModel implements imodelAbstract {

    private $codCurso;
    private $nomeCurso;
    private $periodoCurso;
    private $classificacao;
    private $retorno = Array();
    private $conn;

    /* gets and sets */

    public function getClassificacao() {
        return $this->classificacao;
    }

    public function setClassificacao($classificacao) {
        $this->classificacao = $classificacao;
    }

    public function setCodCurso($cod) {
        $this->codCurso = $cod;
    }

    public function getCodCurso() {
        return $this->codCurso;
    }

    public function setNomeCurso($nome) {
        $this->nomeCurso = $nome;
    }

    public function getNomeCurso() {
        return $this->nomeCurso;
    }

    public function setPeriodoCurso($per) {
        $this->periodoCurso = $per;
    }

    public function getPeriodoCurso() {
        return $this->periodoCurso;
    }

    private function setRetorno($retrono) {
        $this->retorno = $retrono;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    /* gets and sets */

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO curso (nomeCurso,periodoCurso,classificacao) VALUES (:nomeCurso,:periodoCurso,:classificacao)");
        $stmt->bindValue(':nomeCurso', $this->getNomeCurso());
        $stmt->bindValue(':periodoCurso', $this->getPeriodoCurso());
        $stmt->bindValue(':classificacao', $this->getClassificacao());
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM curso";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM curso";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM curso {$condition}";
        else
            $query = "SELECT {$sql} FROM curso {$condition}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update() {
        $stmt = $this->conn->prepare("UPDATE curso SET nomeCurso=:nomeCurso , periodoCurso=:periodoCurso, classificacao=:classificacao WHERE codCurso=:codCurso");
        $stmt->bindValue(':codCurso', $this->getCodCurso());
        $stmt->bindValue(':nomeCurso', $this->getNomeCurso());
        $stmt->bindValue(':periodoCurso', $this->getPeriodoCurso());
        $stmt->bindValue(':classificacao', $this->getClassificacao());
        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM curso WHERE codCurso=:codCurso");
        $stmt->bindValue(':codCurso', $this->getCodCurso());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM curso WHERE codCurso=:codCurso");
        $stmt->bindValue(':codCurso', $this->getCodCurso());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }


}

?>