<?php

require_once ('../../model/configModel.php');
/**
 * MateriaTurmaModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class MateriaTurmaModel implements iModelAbstractQuebra {

    private $codMateriaTurma;
    private $codTurma;
    private $codProf;
    private $codMateria;
    private $conn;
    private $retorno = Array();

    public function getCodTurma() {
        return $this->codTurma;
    }

    public function setCodTurma($codTurma) {
        $this->codTurma = $codTurma;
    }

    public function getCodProf() {
        return $this->codProf;
    }

    public function setCodProf($codProf) {
        $this->codProf = $codProf;
    }

    public function getCodMateria() {
        return $this->codMateria;
    }

    public function setCodMateria($codMateria) {
        $this->codMateria = $codMateria;
    }

    public function getCodMateriaTurma() {
        return $this->codMateriaTurma;
    }

    public function setCodMateriaTurma($codMateriaTurma) {
        $this->codMateriaTurma = $codMateriaTurma;
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
        $query = "INSERT INTO materiaturma (codProf,codMateria,codTurma) VALUES(:codProf,:codMateria,:codTurma)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codProf', $this->getCodProf());
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM  materiaturma";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM  materiaturma";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM  materiaturma {$condition}";
        else
            $query = "SELECT {$sql} FROM  materiaturma {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM materiaturma WHERE codMateriaTurma=:codMateriaTurma");
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update() {
        $query = "UPDATE materiaturma SET codProf=:codProf , codMateria=:codMateria , codTurma=:codTurma WHERE codMateriaTurma=:codMateriaTurma";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        $stmt->bindValue(':codProf', $this->getCodProf());
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM materiaturma WHERE codMateriaTurma=:codMateriaTurma");
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        if ($stmt->execute())
            return true;
        else
            return false;
    }

}

?>
