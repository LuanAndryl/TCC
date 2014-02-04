<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/model/configModel.php'); 
/**
 * iModelAbstractQuebra padrao de metodos para as classes que fazem Model de tabelas de Quebra;
 *
 * @author Luan
 */
?>
<?php

interface iModelAbstractQuebra {
    
    public function create();
    public function read($sql = NULL);
    public function update();
    public function getById();
}

?>
