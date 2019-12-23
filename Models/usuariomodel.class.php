<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author aristeu
 */
require_once '../ADOs/usuarioado.class.php';
require_once '../Classes/cpf.class.php';

class UsuarioModel extends UsuarioAdo {

    protected $usuaCpf;
    protected $usuaNome;
    protected $usuaEmail;
    protected $usuaSenha;

    function __construct($usuaCpf = null, $usuaNome = null, $usuaEmail = null, $usuaSenha = null) {
        $this->usuaCpf = $usuaCpf;
        $this->usuaNome = $usuaNome;
        $this->usuaEmail = $usuaEmail;
        $this->usuaSenha = $usuaSenha;
        parent::__construct();
    }

    public function checaAtributos() {
        if (is_null($this->usuaCpf) || trim($this->usuaCpf) == "") {
            $this->addMensagem("O CPF deve ser informado");
            return false;
        }

        if (strlen($this->usuaCpf) != 11) {
            $this->addMensagem("O CPF deve conter 11 dígitos");
            return false;
        }
        if (!(CPF::validaCPF($this->usuaCpf))) {
            $this->addMensagem("O CPF informado é inválido");
            return false;
        }

        if (is_null($this->usuaNome) || trim($this->usuaNome) == "") {
            $this->addMensagem("O nome deve ser informado");
            return false;
        }
        if (strlen($this->usuaNome) > 45) {
            $this->addMensagem("O nome deve conter até 45 dígitos");
            return false;
        }
        if (is_null($this->usuaEmail) || trim($this->usuaEmail) == "") {
            $this->addMensagem("O email deve ser informado");
            return false;
        }
        if (strlen($this->usuaEmail) > 55) {
            $this->addMensagem("O email deve conter até 55 dígitos");
            return false;
        }
        if (is_null($this->usuaSenha) || trim($this->usuaSenha) == "") {
            $this->addMensagem("A senha deve ser informada");
            return false;
        }
        if (strlen($this->usuaSenha) > 45) {
            $this->addMensagem("A senha deve conter até 45 dígitos");
            return false;
        }
        return true;
    }

    function getUsuaCpf() {
        return $this->usuaCpf;
    }

    function getUsuaNome() {
        return $this->usuaNome;
    }

    function getUsuaEmail() {
        return $this->usuaEmail;
    }

    function getUsuaSenha() {
        return $this->usuaSenha;
    }

    function setUsuaCpf($usuaCpf) {
        $this->usuaCpf = $usuaCpf;
    }

    function setUsuaNome($usuaNome) {
        $this->usuaNome = $usuaNome;
    }

    function setUsuaEmail($usuaEmail) {
        $this->usuaEmail = $usuaEmail;
    }

    function setUsuaSenha($usuaSenha) {
        $this->usuaSenha = $usuaSenha;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
