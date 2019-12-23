<?php

require_once '../ADOs/quartoado.class.php';

class QuartoModel extends QuartosAdo {

    protected $quarNumero;
    protected $quarNome;
    protected $quarDescricao;
    protected $quarQtdeHospedes;

    function __construct($quarNumero = null, $quarNome = null, $quarDescricao = null, $qtdeHospedes = null) {
        $this->quarNumero = $quarNumero;
        $this->quarNome = $quarNome;
        $this->quarDescricao = $quarDescricao;
        $this->quarQtdeHospedes = $qtdeHospedes;
        parent::__construct();
    }

    public function checaAtributos() {

        if (is_null($this->quarNumero) || trim($this->quarNumero) == '') {
            $this->addMensagem("O número do quarto deve ser informado");
            return false;
        }
        if (is_null($this->quarNome) || trim($this->quarNome) == '') {
            $this->addMensagem("O nome deve ser informado");
            return false;
        } else {
            if (strlen($this->quarNome) > 45) {
                $this->addMensagem("O nome deve ter conter menos de 45 caracteres");
                return false;
            }
        }if (is_null($this->quarDescricao) || trim($this->quarDescricao) == '') {
            $this->addMensagem("A descrição deve ser informada");
            return false;
        } else {
            if (strlen($this->quarDescricao) > 400) {
                $this->addMensagem("A descrição deve ter conter menos de 400 caracteres");
                return false;
            }
        } if (is_null($this->quarQtdeHospedes) || trim($this->quarQtdeHospedes) == '') {
            $this->addMensagem("O número do quarto deve ser informado");
            return false;
        }

        return true;
    }

    function getQuarNumero() {
        return $this->quarNumero;
    }

    function getQuarNome() {
        return $this->quarNome;
    }

    function getQuarDescricao() {
        return $this->quarDescricao;
    }

    function getQuarQtdeHospedes() {
        return $this->quarQtdeHospedes;
    }

    function setQuarNumero($quarNumero) {
        $this->quarNumero = $quarNumero;
    }

    function setQuarNome($quarNome) {
        $this->quarNome = $quarNome;
    }

    function setQuarDescricao($quarDescricao) {
        $this->quarDescricao = $quarDescricao;
    }

    function setQuarQtdeHospedes($quarQtdeHospedes) {
        $this->quarQtdeHospedes = $quarQtdeHospedes;
    }

    
    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

}
