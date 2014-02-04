<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstallModel
 *
 * @author Luan
 */
class InstallModel {

    private $sql;
    private $conn;
    
    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function installBD() {
        $this->populaSQL();
        if ($this->sql != null) {
            $stmt = $this->conn->prepare($this->sql);
            $stmt->execute();
        }
    }
    
    /*
     * Faz a limpeza do atributo @conn assim fechando a conexao;
     * @return   @conn vazia,limpa;
     */

    private function populaSQL() {
        $this->sql =
                "-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jun 21, 2013 as 05:11 AM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bd_sogfe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `codAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `loginAdmin` varchar(40) NOT NULL,
  `senhaAdmin` int(20) NOT NULL,
  `nomeAdmin` varchar(100) NOT NULL,
  PRIMARY KEY (`codAdministrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `codAluno` int(11) NOT NULL AUTO_INCREMENT,
  `loginAluno` varchar(40) DEFAULT NULL,
  `statusAluno` int(5) NOT NULL,
  `emailAluno` varchar(40) DEFAULT NULL,
  `rgAluno` int(9) NOT NULL,
  `dataNascAluno` varchar(10) NOT NULL,
  `telefoneResponsavelAluno` varchar(14) NOT NULL,
  `emailResponsavelAluno` varchar(40) DEFAULT NULL,
  `nomeAluno` varchar(100) NOT NULL,
  `senhaAluno` int(20) NOT NULL,
  `codaBar` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`codAluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  ` codAuditoria` int(11) NOT NULL AUTO_INCREMENT,
  `loginUsuario` varchar(40) NOT NULL,
  `dataAcao` datetime NOT NULL,
  `acao` varchar(30) NOT NULL,
  `arquivo` varchar(100) NOT NULL,
  `nivelUsuario` varchar(40) NOT NULL,
  PRIMARY KEY (` codAuditoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamada`
--

CREATE TABLE IF NOT EXISTS `chamada` (
  `codChamada` int(11) NOT NULL AUTO_INCREMENT,
  `codMateriaTurma` int(11) NOT NULL,
  `dataChamada` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codChamada`),
  KEY `Chamada_FKIndex1` (`codMateriaTurma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `codCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(40) NOT NULL,
  `periodoCurso` varchar(40) NOT NULL,
  `classificacao` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE IF NOT EXISTS `frequencia` (
  `codFrequencia` int(11) NOT NULL AUTO_INCREMENT,
  `codChamada` int(11) NOT NULL,
  `codMateriaMatricula` int(11) NOT NULL,
  `falta` double DEFAULT NULL,
  PRIMARY KEY (`codFrequencia`),
  KEY `Frequencia_FKIndex1` (`codChamada`),
  KEY `Frequencia_FKIndex2` (`codMateriaMatricula`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `codFunc` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFunc` varchar(100) NOT NULL,
  `loginFunc` varchar(40) NOT NULL,
  `senhaFunc` int(20) NOT NULL,
  PRIMARY KEY (`codFunc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `codMateria` int(11) NOT NULL AUTO_INCREMENT,
  `codCurso` int(11) NOT NULL,
  `nomeMateria` varchar(40) NOT NULL,
  `ementaMateria` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`codMateria`),
  KEY `Materia_FKIndex1` (`codCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiamatricula`
--

CREATE TABLE IF NOT EXISTS `materiamatricula` (
  `codMateriaMatricula` int(11) NOT NULL AUTO_INCREMENT,
  `codMateriaTurma` int(11) NOT NULL,
  `codMatricula` int(11) NOT NULL,
  `notaFinal` double DEFAULT NULL,
  `situacao` int(5) DEFAULT NULL,
  `dataSituacao` date DEFAULT NULL,
  PRIMARY KEY (`codMateriaMatricula`),
  KEY `MateriaMatricula_FKIndex1` (`codMateriaTurma`),
  KEY `MateriaMatricula_FKIndex2` (`codMatricula`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiaturma`
--

CREATE TABLE IF NOT EXISTS `materiaturma` (
  `codMateriaTurma` int(11) NOT NULL AUTO_INCREMENT,
  `codProf` int(11) NOT NULL,
  `codMateria` int(11) NOT NULL,
  `codTurma` int(11) NOT NULL,
  PRIMARY KEY (`codMateriaTurma`),
  KEY `MateriaTurma_FKIndex1` (`codTurma`),
  KEY `MateriaTurma_FKIndex2` (`codMateria`),
  KEY `MateriaTurma_FKIndex3` (`codProf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `codMatricula` int(11) NOT NULL AUTO_INCREMENT,
  `codTurma` int(11) NOT NULL,
  `codAluno` int(11) NOT NULL,
  PRIMARY KEY (`codMatricula`),
  KEY `Matricula_FKIndex1` (`codTurma`),
  KEY `Matricula_FKIndex2` (`codAluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `codProf` int(11) NOT NULL AUTO_INCREMENT,
  `matriculaProf` int(10) DEFAULT NULL,
  `senhaProf` int(20) NOT NULL,
  `statusProf` int(5) NOT NULL,
  `loginProf` varchar(40) NOT NULL,
  `nomeProf` varchar(100) NOT NULL,
  `emailProf` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codProf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `codTurma` int(11) NOT NULL AUTO_INCREMENT,
  `codCurso` int(11) NOT NULL,
  `moduloTurma` varchar(20) NOT NULL,
  `prefixoTurma` varchar(20) NOT NULL,
  `dataTurma` varchar(10) DEFAULT NULL,
  `semestreTurma` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`codTurma`),
  KEY `Turma_FKIndex1` (`codCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `chamada`
--
ALTER TABLE `chamada`
  ADD CONSTRAINT `chamada_ibfk_1` FOREIGN KEY (`codMateriaTurma`) REFERENCES `materiaturma` (`codMateriaTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `frequencia_ibfk_1` FOREIGN KEY (`codChamada`) REFERENCES `chamada` (`codChamada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `frequencia_ibfk_2` FOREIGN KEY (`codMateriaMatricula`) REFERENCES `materiamatricula` (`codMateriaMatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`codCurso`) REFERENCES `curso` (`codCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `materiamatricula`
--
ALTER TABLE `materiamatricula`
  ADD CONSTRAINT `materiamatricula_ibfk_1` FOREIGN KEY (`codMateriaTurma`) REFERENCES `materiaturma` (`codMateriaTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `materiamatricula_ibfk_2` FOREIGN KEY (`codMatricula`) REFERENCES `matricula` (`codMatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `materiaturma`
--
ALTER TABLE `materiaturma`
  ADD CONSTRAINT `materiaturma_ibfk_1` FOREIGN KEY (`codTurma`) REFERENCES `turma` (`codTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `materiaturma_ibfk_2` FOREIGN KEY (`codProf`) REFERENCES `professor` (`codProf`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `materiaturma_ibfk_3` FOREIGN KEY (`codMateria`) REFERENCES `materia` (`codMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`codTurma`) REFERENCES `turma` (`codTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`codAluno`) REFERENCES `aluno` (`codAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`codCurso`) REFERENCES `curso` (`codCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;
";
    }
}

?>
