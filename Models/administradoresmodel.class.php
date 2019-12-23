<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administradormodel
 *
 * @author aristeu
 */
require_once '../ADOs/administradoresado.class.php';

class AdministradoresModel extends AdministradorAdo {

    protected $admnUsuaCpf;

    function __construct($admnUsuaCpf = null) {
        $this->admnUsuaCpf = $admnUsuaCpf;
        parent::__construct();
    }

    public function checaAtributos() {
        if (is_null($this->admnUsuaCpf) || trim($this->admnUsuaCpf) == "") {
            $this->addMensagem("O CPF deve ser informado");
            return false;
        }

        if (strlen($this->admnUsuaCpf) != 11) {
            $this->addMensagem("O CPF deve conter 11 dígitos");
            return false;
        }
        if (!(CPF::validaCPF($this->admnUsuaCpf))) {
            $this->addMensagem("O CPF informado é inválido");
            return false;
        }
        return true;
    }

    function getAdmnUsuaCpf() {
        return $this->admnUsuaCpf;
    }

    function setAdmnUsuaCpf($admnUsuaCpf) {
        $this->admnUsuaCpf = $admnUsuaCpf;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

    public function alteraObjeto() {
        
    }

}
