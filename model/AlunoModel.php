<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/configModel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/PessoaModel.php');
//require_once ('../../model/configModel.php');
//require_once ('../../model/PessoaModel.php');
/*
 * ###############################################################
 * #  @author Luan :D                                            #
 * #  @Class AlunoModel        - persistencia do Aluno no banco  #                                           #
 * ###############################################################
 *
 */
?>
<?php

class AlunoModel extends PessoaModel implements iModelAbstract {
    /*
     * Objeto padrao para a conexao com o Banco
     * @conn
     */

    private $conn;
    /*
     * Atributo RG do aluno
     * @rgAluno;
     */
    private $rgAluno;
    /*
     * Atributo telefone do Responsavel do aluno
     * @telefoneResponsavelAluno;
     */
    private $telefoneResponsavelAluno;
    /*
     * Atributo email do aluno
     * @emailAluno;
     */
    private $emailAluno;
    /*
     * Atributo data nascimento do aluno
     * @dataNasceAluno;
     */
    private $dataNasceAluno;
    /*
     * Atributo email do responsavel do aluno
     * @emailResponsavelAluno;
     */
    private $emailResponsavelAluno;
    /*
     * Aluno Ativo ou inativo
     * @statusAluno;
     */
    private $statusAluno;
    private $codBar;

    /*
     * incio Gets and Sets
     */

    public function getCodBarAluno() {
        return $this->codBar;
    }

    public function setCodBarAluno($codBar) {
        $this->codBar = $codBar;
    }

    public function getStatusAluno() {
        return $this->statusAluno;
    }

    public function setStatusAluno($statusAluno) {
        $this->statusAluno = $statusAluno;
    }

    public function getRgAluno() {
        return $this->rgAluno;
    }

    public function setRgAluno($rgAluno) {
        $this->rgAluno = $rgAluno;
    }

    public function getTelefoneResponsavelAluno() {
        return $this->telefoneResponsavelAluno;
    }

    public function setTelefoneResponsavelAluno($telefoneResponsavelAluno) {
        $this->telefoneResponsavelAluno = $telefoneResponsavelAluno;
    }

    public function getEmailAluno() {
        return $this->emailAluno;
    }

    public function setEmailAluno($emailAluno) {
        $this->emailAluno = $emailAluno;
    }

    public function getDataNasceAluno() {
        return $this->dataNasceAluno;
    }

    public function setDataNasceAluno($dataNasceAluno) {
        $this->dataNasceAluno = $dataNasceAluno;
    }

    public function getEmailResponsavelAluno() {
        return $this->emailResponsavelAluno;
    }

    public function setEmailResponsavelAluno($emailResponsavelAluno) {
        $this->emailResponsavelAluno = $emailResponsavelAluno;
    }

    /*
     * fim Gets and Sets
     */

    /*
     * garante na instanciacao da classe a conexao com o banco 
     */

    public function __construct() {
        
        $this->conn = ConnectDataBase::conectaBD();
        
    }

    /*
     * quando o obj da classe for destruido a do obj conexao morre junto
     */

    public function __destruct() {
        ConnectDataBase::disconectaBD($this->conn);
    }

    /*
     * Persiste um aluno no banco de dados
     * @stmt    variavel de manipulaçao da conexao no metodo;
     * @return  vazio
     */

    public function create() {
        $sql = "INSERT INTO aluno (nomeAluno,rgAluno,emailResponsavelAluno,senhaAluno,emailAluno,dataNascAluno,loginAluno,telefoneResponsavelAluno,statusAluno,codaBar) ";
        $sql .= "VALUES (:nomeAluno,:rgAluno,:emailResponsavel,:senhaAluno,:emailAluno,:dataNascAluno,:loginAluno,:telefoneResponsavelAluno,:statusAluno,:codaBar)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nomeAluno', $this->getNome());
        $stmt->bindValue(':rgAluno', $this->getRgAluno());
        $stmt->bindValue(':emailResponsavel', $this->getEmailResponsavelAluno());
        $stmt->bindValue(':senhaAluno', $this->getSenha());
        $stmt->bindValue(':emailAluno', $this->getEmailAluno());
        $stmt->bindValue(':dataNascAluno', $this->getDataNasceAluno());
        $stmt->bindValue(':loginAluno', $this->getLogin());
        $stmt->bindValue(':telefoneResponsavelAluno', $this->getTelefoneResponsavelAluno());
        $stmt->bindValue(':statusAluno', $this->getStatusAluno());
        $stmt->bindValue(':codaBar', $this->getCodBarAluno());
        $stmt->execute();
    }

    /*
     * busca um array de linhas com os adminstradores do sistema
     * @param    $sql  caso passado, faz um select especifico na tabela;
     * @return    array   @getRetorno;
     */

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM aluno";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM aluno";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM aluno WHERE {$condition}";
        else
            $query = "SELECT {$sql} FROM aluno WHERE {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readActive($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM aluno WHERE statusAluno = 1";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM aluno WHERE statusAluno = 1";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM aluno WHERE {$condition} AND statusAluno = 1";
        else
            $query = "SELECT {$sql} FROM aluno WHERE statusAluno = 1 AND {$condition}";

        echo $sql;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readInactive($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM aluno WHERE statusAluno = 2";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM aluno WHERE statusAluno = 2";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM aluno WHERE statusAluno = 2 AND {$condition}";
        else
            $query = "SELECT {$sql} FROM aluno WHERE statusAluno = 2 AND {$condition}";


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /*
     * reliza uma atualizaçao nos dados do usuario pelo numero do seu codigo;
     * @return    =  vazio;
     * @param    setCod(); 
     */

    public function readRow($sql = null, $condition = NULL) {


        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM aluno";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM aluno";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM aluno {$condition}";
        else
            $query = "SELECT {$sql} FROM aluno {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno(count($stmt->fetchAll(PDO::FETCH_ASSOC)));
    }

    public function update() {
        $sql = "UPDATE aluno SET nomeAluno=:nomeAluno,rgAluno=:rgAluno,emailResponsavelAluno=:emailResponsavel,senhaAluno=:senhaAluno,emailAluno=:emailAluno,";
        $sql .="dataNascAluno=:dataNascAluno,loginAluno=:loginAluno,telefoneResponsavelAluno=:telefoneResponsavelAluno WHERE codAluno=:codAluno";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':codAluno', $this->getCod());
        $stmt->bindValue(':nomeAluno', $this->getNome());
        $stmt->bindValue(':rgAluno', $this->getRgAluno());
        $stmt->bindValue(':emailResponsavel', $this->getEmailResponsavelAluno());
        $stmt->bindValue(':senhaAluno', $this->getSenha());
        $stmt->bindValue(':emailAluno', $this->getEmailAluno());
        $stmt->bindValue(':dataNascAluno', $this->getDataNasceAluno());
        $stmt->bindValue(':loginAluno', $this->getLogin());
        $stmt->bindValue(':telefoneResponsavelAluno', $this->getTelefoneResponsavelAluno());
        $stmt->execute();
    }
    
    public function updateCodaBar() {
        
        $sql = "UPDATE aluno SET codaBar=:codaBar WHERE codAluno=:codAluno";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':codaBar', $this->getCodBarAluno());
        $stmt->bindValue(':codAluno', $this->getCod());
        $stmt->execute();
    }

    /*
     * exclui um usuario apartir do numero do codigo 
     * @param    setCod();
     */

    public function delete() {
        $stmt = $this->conn->prepare("UPDATE aluno SET statusAluno = 2 WHERE codAluno=:codAluno");
        $stmt->bindValue(':codAluno', $this->getCod());
        $stmt->execute();
    }

    public function Active() {
        $stmt = $this->conn->prepare("UPDATE aluno SET statusAluno = 1 WHERE codAluno=:codAluno");
        $stmt->bindValue(':codAluno', $this->getCod());
        $stmt->execute();
    }

    /*
     * Faz a busca de um unico usuario apartir do numero do codigo
     * @param   setCod();
     */

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM aluno WHERE codAluno=:codAluno");
        $stmt->bindValue(':codAluno', $this->getCod());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /*
     * Faz a instanciacao do objeto de conexao com o banco dados; 
     * Estamos utilizando o PDO que é um driver de conexao nativo do php 
     * para este tipo de abstraçao;
     * 
     * @param    STRCON = string de conexao com o banco de dados; -- 
     * @param    USER = nome do usuario do banco de dados; -- @location model/configModel.php;
     * @param    PASS  = senha para conexao com o BD; -- @location model/configModel.php;
     * @return   @conn = uma instancia de conexao com o banco de dados :D;
     */


    /*
     * Faz a limpeza do atributo @conn assim fechando a conexao;
     * @return   @conn vazia,limpa;
     */



}

?>