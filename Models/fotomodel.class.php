<?php

require_once '../ADOs/fotoado.class.php';
require_once '../Classes/cpf.class.php';

class F extends FotoAdo {

    protected $fotoId;
    protected $fotoTitulo;
    protected $fotoQuarNumero;
    protected $fotoImagem;
    protected $fotoExtensao;


    function __construct($fotoId = null, $fotoTitulo = null, $fotoQuarNumero = null, $fotoImagem = null, $fotoExtensao = null) {
        $this->fotoId = $fotoId;
        $this->fotoTitulo = $fotoTitulo;
        $this->fotoQuarNumero = $fotoQuarNumero;
        $this->fotoImagem = $fotoImagem;
        $this->fotoExtensao = $fotoExtensao;
        
        parent::__construct();
    }

    public function checaAtributos() {
        if (is_null($this->fotoId) || trim($this->fotoId) == "") {
            $this->addMensagem("O id da foto não pode ser vazio");
            return false;
        }

        if (!(CPF::validaCPF($this->fotoId))) {
            $this->addMensagem("O id da foto informado é inválido");
            return false;
        }

        if (is_null($this->fotoTitulo) || trim($this->fotoTitulo) == "") {
            $this->addMensagem("O titulo da foto deve ser informado");
            return false;
        }

        if (is_null($this->fotoImagem) || trim($this->fotoImagem) == "") {
            $this->addMensagem("A imagem deve ser informada");
            return false;
        }

        if (is_null($this->fotoExtensao) || trim($this->fotoExtensao) ) {
            $this->addMensagem("A extensão da foto deve ser informada");
            return false;
        }
        
        return true;
    }
    
    function getFotoId() {
        return $this->fotoId;
    }

    function getFotoTitulo() {
        return $this->fotoTitulo;
    }

    function getFotoQuarNumero() {
        return $this->fotoQuarNumero;
    }

    function getFotoImagem() {
        return $this->fotoImagem;
    }

    function getFotoExtensao() {
        return $this->fotoExtensao;
    }

    function setFotoId($fotoId) {
        $this->fotoId = $fotoId;
    }

    function setFotoTitulo($fotoTitulo) {
        $this->fotoTitulo = $fotoTitulo;
    }

    function setFotoQuarNumero($fotoQuarNumero) {
        $this->fotoQuarNumero = $fotoQuarNumero;
    }

    function setFotoImagem($fotoImagem) {
        $this->fotoImagem = $fotoImagem;
    }

    function setFotoExtensao($fotoExtensao) {
        $this->fotoExtensao = $fotoExtensao;
    }

    
    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
