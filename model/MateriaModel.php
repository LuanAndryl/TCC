<?php

require_once ('../../model/configModel.php');
/**
 * MateriaModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class MateriaModel implements imodelAbstract {

    private $codCurso;
    private $nomeMateria;
    private $codMateria;
    private $moduloMateria;
    private $ementaMateria;
    private $retorno = Array();

    /*
     * Getters and Setters
     */

    public function getEmentaMateria() {
        return $this->ementaMateria;
    }

    public function setEmentaMateria($ementaMateria) {
        $this->ementaMateria = $ementaMateria;
    }

    public function getCodCurso() {
        return $this->codCurso;
    }

    public function setCodCurso($codCurso) {
        $this->codCurso = $codCurso;
    }

    public function getNomeMateria() {
        return $this->nomeMateria;
    }

    public function setNomeMateria($nomeMateria) {
        $this->nomeMateria = $nomeMateria;
    }

    public function setCodMateria($codMateria) {
        $this->codMateria = $codMateria;
    }

    public function getCodMateria() {
        return $this->codMateria;
    }

    public function setModuloMateria($moduloMateria) {
        $this->moduloMateria = $moduloMateria;
    }

    public function getModuloMateria() {
        return $this->moduloMateria;
    }

    private function setRetorno($retorno) {
        $this->retorno = $retorno;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    /*
     * Getters and Setters
     */

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO materia (nomeMateria,ementaMateria,codCurso) VALUES (:nomeMateria,:ementaMateria,:codCurso)");
        $stmt->bindValue(':nomeMateria', $this->getNomeMateria());
        $stmt->bindValue(':ementaMateria', $this->getEmentaMateria());
        $stmt->bindValue(':codCurso', $this->getCodCurso());
        var_dump($stmt);
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM materia";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM materia";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM materia {$condition}";
        else
            $query = "SELECT {$sql} FROM materia {$condition}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update() {
        $stmt = $this->conn->prepare("UPDATE materia SET nomeMateria=:nomeMateria ,ementaMateria=:ementaMateria ,codCurso=:codCurso WHERE codMateria=:codMateria");

        $stmt->bindValue(':nomeMateria', $this->getNomeMateria());
        $stmt->bindValue(':ementaMateria', $this->getEmentaMateria());
        $stmt->bindValue(':codCurso', $this->getCodCurso());
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
    }

    public function updateAttrOn() {
        $stamt = $this->conn->prepare("SELECT profAtribuido FROM materia WHERE codMateria=:codMateria");
        $stamt->bindValue(':codMateria', $this->getCodMateria());
        $stamt->execute();
        $i = ($stamt->fetchAll(PDO::FETCH_ASSOC));

        $i = (int) $i[0]['profAtribuido'];
        $i = $i + 1;
        $stmt = $this->conn->prepare("UPDATE materia SET atribuir=1,profAtribuido=:profAtribuido WHERE codMateria=:codMateria");
        $stmt->bindValue(':profAtribuido', $i);
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
    }

    public function updateAttrProfMenos() {
        $stamt = $this->conn->prepare("SELECT profAtribuido FROM materia WHERE codMateria=:codMateria");
        $stamt->bindValue(':codMateria', $this->getCodMateria());
        $stamt->execute();
        $i = ($stamt->fetchAll(PDO::FETCH_ASSOC));

        $i = (int) $i[0]['profAtribuido'];
        $i = $i - 1;
        $stmt = $this->conn->prepare("UPDATE materia SET atribuir=1,profAtribuido=:profAtribuido WHERE codMateria=:codMateria");
        $stmt->bindValue(':profAtribuido', $i);
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
    }

    public function updateAttrOff() {
        $stmt = $this->conn->prepare("UPDATE materia SET atribuir=2,profAtribuido=0 WHERE codMateria=:codMateria");
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM materia WHERE codMateria=:codMateria");
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM materia WHERE codMateria=:codMateria");
        $stmt->bindValue(':codMateria', $this->getCodMateria());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }


}

?>
