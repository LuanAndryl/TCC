<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/AuditoriaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class AuditoriaController {

    public static function addAuditoriaAction($usuario = null, $acao = null, $arquivo = null, $nivel = null) {


        if (strpos($acao, 'select') === FALSE) {
            if (strpos($acao, 'frequeciaDiaAction') === FALSE) {
                date_default_timezone_set("Brazil/East");
                $data = date('Y-m-d H:i:s');

                $audit = new AuditoriaModel();
                $audit->setAcao($acao);
                $audit->setDataAcao($data);
                $audit->setLoginUsuario($usuario);
                $audit->setArquivo($arquivo);
                $audit->setNivelUsuario($nivel);
                $audit->create();
            }
        }
    }

    public function selectAuditoriaAction($param = NULL, $cond = NULL) {
        $auditi = new AuditoriaModel();

        if (empty($param) and empty($cond))
            $auditi->read();
        else if (!empty($param) and empty($cond))
            $auditi->read($param);
        else if (empty($param) and !empty($cond))
            $auditi->read(NULL, $cond);
        else
            $auditi->read($param, $cond);

        return ($auditi->getRetorno());
    }

    public function selectSearchAction() {
        if (!empty($_POST['campo']) and !empty($_POST['txtPesq'])) {

            $campo = $_POST['campo'];
            $condicao = $_POST['txtPesq'];

            $read = new readerSqlModel();

            $read->reader("SELECT *
                        FROM auditoria
                        WHERE  {$campo}
                        LIKE '%{$condicao}%'
                        ");
            return $read->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

}

?>
