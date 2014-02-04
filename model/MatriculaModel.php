<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/configModel.php');
/**
 * MatriculaModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class MatriculaModel implements iModelAbstractQuebra {

    private $codMatricula;
    private $codAluno;
    private $codTurma;
    private $retorno = Array();

    public function getCodMatricula() {
        return $this->codMatricula;
    }

    public function setCodMatricula($codMatricula) {
        $this->codMatricula = $codMatricula;
    }

    public function getCodAluno() {
        return $this->codAluno;
    }

    public function setCodAluno($codAluno) {
        $this->codAluno = $codAluno;
    }

    public function getCodTurma() {
        return $this->codTurma;
    }

    public function setCodTurma($codTurma) {
        $this->codTurma = $codTurma;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    public function setRetorno($retorno) {
        $this->retorno = $retorno;
    }

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $query = "INSERT INTO matricula (codAluno,codTurma) VALUES(:codAluno,:codTurma)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codAluno', $this->getCodAluno());
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM matricula";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM matricula";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM matricula {$condition}";
        else
            $query = "SELECT {$sql} FROM matricula {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function updateAtributos() {
        $query = "UPDATE matricula SET codTurma=:codTurma WHERE codMatricula=:codMatricula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMatricula', $this->getCodMatricula());
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->execute();
    }

    public function update() {
        $query = "UPDATE matricula SET codAluno=:codAluno,codTurma=:codTurma WHERE codMatricula=:codMatricula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMatricula', $this->getCodMatricula());
        $stmt->bindValue(':codAluno', $this->getCodAluno());
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM matricula WHERE codMatricula=:codMatricula");
        $stmt->bindValue(':codMatricula', $this->getCodMatricula());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }


}

?>
