<?php

require_once '../Models/modelabstract.class.php';

abstract class ClienteAdo extends ModelAbstract {

    public function __construct() {

        $this->setNomeDaTabela("Clientes");
        parent::__construct();
    }

    public function buscaObjeto() {

        $where = " clieUsuaCpf = ? ";
        return $this->buscaObjetoComPs(array($this->clieUsuaCpf), $where);
    }

    public function alteraObjeto() {
        $arrayDeColunasEValores = array(
            "clieFone1" => $this->getClieFone1(),
            "clieFone2" => $this->getClieFone2(),
            "clieEndereco" => $this->getClieEndereco(),
            "clieComplementoEndereco" => $this->getClieComplementoEndereco(),
            "clieCidade" => $this->getClieCidade(),
            "clieUf" => $this->getClieUf()
        );

        $where = " clieUsuaCpf = ? ";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);

        $arrayDeColunasEValores ["clieUsuaCpf"] = $this->getClieUsuaCpf();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {
        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('clieUsuaCpf' => $this->getClieUsuaCpf()));
        return $this->executaPs($query, array($this->getClieUsuaCpf()));
    }

    public function buscaClientesNaoPresentesNaTabelaAdministradores() {
        $query = "select * from Clientes WHERE Clientes.clieUsuaCpf not in(select Administradores.admnUsuaCpf from Administradores)";

        $buscou = parent::executaPs($query, array(0));
        if ($buscou) {
            if (parent::qtdeLinhas() == 0) {
                return 0;
            }
        } else {
            return FALSE;
        }

        $clientes = [];
        while ($tabelaBd = parent::leTabelaBD()) {

            $clientes[] = new ClienteModel(
                    $tabelaBd["clieUsuaCpf"],
                    $tabelaBd["clieFone1"],
                    $tabelaBd["clieEndereco"],
                    $tabelaBd["clieComplementoEndereco"],
                    $tabelaBd["clieCidade"],
                    $tabelaBd["clieUf"]);
        }

        return $clientes;
    }

}
