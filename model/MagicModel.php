<?php

class MagicModel {

    private $conn;

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function insertSQL() {
        $this->magicAlunoSQL();
        $this->magicProfSQL();
        $this->magicCursoSQL();
        $this->magicFuncSQL();
        $this->magicMateriaSQL();
        $this->magicTurmaSQL();
    }

    public function magicAlunoSQL() {
        $sql = "
INSERT INTO `aluno` (`loginAluno`, `statusAluno`, `emailAluno`, `rgAluno`, `dataNascAluno`, `telefoneResponsavelAluno`, `emailResponsavelAluno`, `nomeAluno`, `senhaAluno`) VALUES
( 'quik@quik.com', 1, 'quik@quik.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidoquick@hotmail.com', 'Alan Souza', 111111111),
( 'andresa@andressa.com', 1, 'andresa@andressa.com', 11111, '11/11/1111', '(22) 2222-2222', 'paidaandressa@hotmail.com', 'Andressa Bozio', 111111111),
( 'angelica@angelica.com', 1, 'angelica@angelica.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidaangelica@hotmail.com', 'Angelica Zaparolli', 111111111),
( 'egydio@egydio.com', 1, 'egydio@egydio.com', 11111, '11/11/1111', '(11) 1111-1111', 'bacon@bacon.com', 'Egydio Albanez', 111111111),
( 'elias@elias.com', 1, 'elias@elias.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidoelias@hotmail.com', 'Elias Ferreira', 111111111),
( 'ewerton@ewerton.com', 1, 'ewerton@ewerton.com', 11111, '11/11/1111', '(11) 1111-1111', 'eristi@hotmail.com', 'Ewerton Alan', 111111111),
( 'jessica@jessica.com', 1, 'jessica@jessica.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidajessica@hotmail.com', 'Jessica Simões', 111111111),
( 'joao@joao.com', 1, 'joao@joao.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidojoao@hotmail.com', 'Joao Paulo de Oliveira', 111111111),
( 'joyce@joyce.com', 1, 'joyce@joyce.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidajoyce@hotmail.com', 'Joyce Faria', 111111111),
( 'ferb@ferb.com', 1, 'ferb@ferb.com', 11111, '11/11/1111', '(11) 1111-1111', 'carlao@hotmail.com', 'Luis Fernando Piramba', 111111111),
( 'stefany@stefany.com', 1, 'stefany@stefany.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidastefany@hotmail.com', 'Stefany Gianini', 111111111),
( 'thaina@thaina.com', 1, 'thaina@thaina.com', 11111, '11/11/1111', '(11) 1111-1111', 'paidathaina@hotmail.com', 'Thaina Mariane', 111111111),
( 'vitor@vitor.com', 1, 'vitor@vitor.com', 11111, '11/11/1111', '(11) 1111-1111', 'marcao@hotmail.com', 'Vitor Hugo Largs', 111111111);

";
        if ($sql != null) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }

    public function magicProfSQL() {
        $sql = " 
            INSERT INTO `professor` ( `matriculaProf`, `senhaProf`, `statusProf`, `loginProf`, `nomeProf`, `emailProf`) VALUES
( 1111, 123, 1, 'regiane@regiane.com', 'Regiane Fantinati', 'regiane@regiane.com'),
( 2222, 123, 1, 'adriana@adriana.com', 'Adriana Melotte', 'adriana@adriana.com'),
( 3333, 123, 1, 'geraldo@geraldo.com', 'Geraldo', 'geraldo@geraldo.com'),
( 4444, 123, 1, 'fabio@fabio.com', 'Fabio Nogueira', 'fabio@fabio.com'),
( 5555, 123, 1, 'anderson@anderson.com', 'Anderson', 'anderson@anderson.com'),
( 6666, 123, 1, 'reinor@reinor.com', 'Reinor Pires', 'reinor@reinor.com'),
( 7777, 123, 1, 'vera@vera.com', 'Vera Hypolito', 'vera@vera.com');
    ";
        if ($sql != null) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }

    public function magicCursoSQL() {
        $sql = "INSERT INTO `curso` ( `nomeCurso`, `periodoCurso`, `classificacao`) VALUES
('Informática', 'Vespertino', 'Ensino Técnico');";
        if ($sql != null) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }

    public function magicFuncSQL() {
        $sql = "INSERT INTO `funcionario` (`nomeFunc`, `loginFunc`, `senhaFunc`) VALUES
( 'Fagner Cunha', 'fagnera', 123),
( 'Jorge Monteiro', 'jorgera', 123);";
        if ($sql != null) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }

    public function magicMateriaSQL() {
        $sql = "INSERT INTO `materia` ( `codCurso`, `nomeMateria`, `ementaMateria`) VALUES
( 3, 'Gestão de Sistema Operacionais III', 'GSO'),
( 3, 'Programação de Computadores II', 'C#'),
( 3, 'Desenvolvimento de Software II', 'javera'),
( 3, 'Programação Para Internet', 'PI'),
( 3, 'Aplicativos para Projetos', 'APP'),
( 3, 'Ética e Cidadania Organizacional', 'etica'),
( 3, 'Desenvolvimento de Trabalho de Conclusao', 'dtcc');";
        if ($sql != null) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }

    public function magicTurmaSQL() {
        $sql = "INSERT INTO `turma` (`codCurso`, `moduloTurma`, `prefixoTurma`, `dataTurma`, `semestreTurma`) VALUES
( 3, 'Modulo', '3º', '2013-06-21', '1º Semestre');";
        if ($sql != null) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }

}

?>
