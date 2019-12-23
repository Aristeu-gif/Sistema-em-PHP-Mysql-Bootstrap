<?php

require_once '../Models/modelabstract.class.php';

abstract class AdministradorAdo extends ModelAbstract {

    public function __construct() {

        $this->setNomeDaTabela("Administradores");
        parent::__construct();
    }

    public function buscaObjeto() {

        $where = " admnUsuaCpf = ? ";
        return $this->buscaObjetoComPs(array($this->admnUsuaCpf), $where);
    }

    public function excluiObjeto() {
        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('admnUsuaCpf' => $this->admnUsuaCpf));
        return $this->executaPs($query, array($this->admnUsuaCpf));
    }

}

