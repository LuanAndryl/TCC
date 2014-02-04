<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/model/configModel.php'); 
/**
 * iModelAbstract padrao de metodos para as classes;
 *
 * @author Luan
 */
?>
<?php

interface iModelAbstract {

    public function create();

    public function read($sql = null);

    public function update();

    public function delete();

    public function getById();
    
}

?>