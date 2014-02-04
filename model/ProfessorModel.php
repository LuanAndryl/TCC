<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/configModel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/PessoaModel.php');
//require_once ('../../model/configModel.php');
//require_once ('../../model/PessoaModel.php');

/**
 * ProfessorModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class ProfessorModel extends PessoaModel implements iModelAbstract {

    private $conn;
    private $matriculaProf;
    private $emailProf;
    private $statusProf;

    public function getStatusProf() {
        return $this->statusProf;
    }

    public function setStatusProf($statusProf) {
        $this->statusProf = $statusProf;
    }

    public function getMatriculaProf() {
        return $this->matriculaProf;
    }

    public function setMatriculaProf($matriculaProf) {
        $this->matriculaProf = $matriculaProf;
    }

    public function getEmailProf() {
        return $this->emailProf;
    }

    public function setEmailProf($emailProf) {
        $this->emailProf = $emailProf;
    }

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        //matricula nome email senha cod
        $sql = "INSERT INTO professor(matriculaProf,nomeProf,emailProf,senhaProf,loginProf,statusProf)";
        $sql .= "VALUES(:matriculaProf,:nomeProf,:emailProf,:senhaProf,:loginProf,:statusProf)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':matriculaProf', $this->getMatriculaProf());
        $stmt->bindValue(':nomeProf', $this->getNome());
        $stmt->bindValue(':emailProf', $this->getEmailProf());
        $stmt->bindValue(':senhaProf', $this->getSenha());
        $stmt->bindValue(':loginProf', $this->getLogin());
        $stmt->bindValue(':statusProf', $this->getStatusProf());
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM professor";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM professor";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM professor {$condition}";
        else
            $query = "SELECT {$sql} FROM professor {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readActive($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM professor WHERE statusProf = 1";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM professor WHERE statusProf = 1";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM professor WHERE {$condition} AND statusProf = 1";
        else
            $query = "SELECT {$sql} FROM professor WHERE status = 1 statusProf{$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readInactive($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM professor WHERE statusProf = 2";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM professor WHERE statusProf = 2";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM professor WHERE statusProf = 2 AND {$condition}";
        else
            $query = "SELECT {$sql} FROM professor WHERE statusProf = 2 AND {$condition}";


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readRow($sql = null, $condition = NULL) {
        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM professor";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM professor";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM professor {$condition}";
        else
            $query = "SELECT {$sql} FROM professor {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno(count($stmt->fetchAll(PDO::FETCH_ASSOC)));
    }

    public function update() {

        $sql = "UPDATE professor SET matriculaProf=:matriculaProf,nomeProf=:nomeProf,emailProf=:emailProf,senhaProf=:senhaProf, loginProf=:loginProf WHERE codProf = :codProf";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':matriculaProf', $this->getMatriculaProf());
        $stmt->bindValue(':nomeProf', $this->getNome());
        $stmt->bindValue(':emailProf', $this->getEmailProf());
        $stmt->bindValue(':senhaProf', $this->getSenha());
        $stmt->bindValue(':codProf', $this->getCod());
        $stmt->bindValue(':loginProf', $this->getLogin());

        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("UPDATE professor SET statusProf = 2 WHERE codProf=:codProf");
        $stmt->bindValue(':codProf', $this->getCod());
        $stmt->execute();
    }

    public function Active() {
        $stmt = $this->conn->prepare("UPDATE professor SET statusProf = 1 WHERE codProf=:codProf");
        $stmt->bindValue(':codProf', $this->getCod());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM professor WHERE codProf=:codProf");
        $stmt->bindValue(':codProf', $this->getCod());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAlls(PDO::FETCH_ASSOC));
    }

}

?>