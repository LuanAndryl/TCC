<?php

require_once ('model/configModel.php');
/**
 * MateriaAlunoModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class MateriaAlunoModel implements iModelAbstractQuebra {

    private $codMateriaAluno;
    private $situacao;
    private $dataSituacao;
    private $codAluno;
    private $codMateria;
    private $notaFinalAluno;
    private $conn;
    private $retorno = Array();

    public function getNotaFinalAluno() {
        return $this->notaFinalAluno;
    }

    public function setNotaFinalAluno($notaFinalAluno) {
        $this->notaFinalAluno = $notaFinalAluno;
    }

    public function getCodMateriaAluno() {
        return $this->codMateriaAluno;
    }

    public function setCodMateriaAluno($codMateriaAluno) {
        $this->codMateriaAluno = $codMateriaAluno;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getDataSituacao() {
        return $this->dataSituacao;
    }

    public function setDataSituacao($dataSituacao) {
        $this->dataSituacao = $dataSituacao;
    }

    public function getCodAluno() {
        return $this->codAluno;
    }

    public function setCodAluno($codAluno) {
        $this->codAluno = $codAluno;
    }

    public function getCodMateria() {
        return $this->codMateria;
    }

    public function setCodMateria($codMateria) {
        $this->codMateria = $codMateria;
    }

    private function setRetorno($retrono) {
        $this->retorno = $retrono;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $query = "INSERT INTO historico(situacao,dataSituacao,notaFinalAluno,codAluno,codMateria) VALUES(:situacao,:dataSituacao,:notaFinalAluno,:codAluno,:codMateria)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':situacao', $this->getSituacao());
        $stmt->bindValue(':dataSituacao', $this->getDataSituacao());
        $stmt->bindValue(':notaFinalAluno', $this->getNotaFinalAluno());
        $stmt->bindValue(':codAluno', $this->getCodAluno());
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
    }

    public function read($sql = NULL) {
        if ($sql != null)
            $query = "SELECT FROM historico " . $sql;
        else
            $query = "SELECT * FROM historico ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM historico WHERE codMateriaAluno=:codMateriaAluno");
        $stmt->bindValue(':codMateriaAluno', $this->getCodMateriaAluno());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update() {
        $query = "UPDATE historico SET situacao=:situacao,dataSituacao=:dataSituacao,notaFinalAluno=:notaFinalAluno,codAluno=:codAluno,codMateria=:codMateria WHERE codMateriaAluno=:codMateriaAluno";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMateriaAluno', $this->getCodMateriaAluno());
        $stmt->bindValue(':situacao', $this->getSituacao());
        $stmt->bindValue(':dataSituacao', $this->getDataSituacao());
        $stmt->bindValue(':notaFinalAluno', $this->getNotaFinalAluno());
        $stmt->bindValue(':codAluno', $this->getCodAluno());
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
    }


}

?>
