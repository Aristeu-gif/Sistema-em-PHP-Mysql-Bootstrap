<?php

require_once '../ADOs/reservasado.class.php';

class ReservaModel extends ReservasAdo {

    protected $reseClieCpf;
    protected $reseQuarNumero;
    protected $reseDataInicial;
    protected $reseDataFinal;
    protected $reseData;

    function __construct($reseClieCpf = null, $reseQuarNumero = null, $reseDataInicial = null, $reseDataFinal = null, $reseData = null) {
        $this->reseClieCpf = $reseClieCpf;
        $this->reseQuarNumero = $reseQuarNumero;
        $this->reseDataInicial = $reseDataInicial;
        $this->reseDataFinal = $reseDataFinal;
        $this->reseData = $reseData;
        parent::__construct();
    }

    public function checaAtributos() {


        if (is_null($this->reseClieCpf) || trim($this->reseClieCpf) == '') {
            $this->addMensagem("O CPF deve ser informado");
            return false;
        } else {
            if (strlen($this->reseClieCpf) > 11) {
                $this->addMensagem("O CPF deve conter apenas 11 dígitos");
                return false;
            }
        }

        if (trim($this->reseQuarNumero) == '' || is_null($this->reseQuarNumero)) {
            $this->addMensagem("O número do quarto deve ser informado");
            return false;
        }

        if (is_null($this->reseDataInicial) || trim($this->reseDataInicial) == "") {
            $this->addMensagem("A data inicial da reserva deve ser informada");
            return false;
        } else {
            if (strlen($this->reseDataInicial) > 45) {
                $this->addMensagem("A data inicial deve ter menos de 45 dígitos");
                return false;
            }
        }
        if (is_null($this->reseDataFinal) || trim($this->reseDataFinal) == "") {
            $this->addMensagem("A data final da reserva deve ser informada");
            return false;
        } else {
            if (strlen($this->reseDataFinal) > 45) {
                $this->addMensagem("A data final deve ter menos de 45 dígitos");
                return false;
            }
        }
        if (is_null($this->reseData) || trim($this->reseData) == "") {
            $this->addMensagem("A data final da reserva deve ser informada");
            return false;
        } else {
            if (strlen($this->reseData) > 45) {
                $this->addMensagem("A data final deve ter menos de 45 dígitos");
                return false;
            }
        }
        if(strtotime($this->reseDataInicial)> strtotime($this->reseDataFinal)){
            $this->addMensagem("A data inicial precisa ser menor que a final");
            return false;
        }
        return true;
    }

    function getReseClieCpf() {
        return $this->reseClieCpf;
    }

    function getReseQuarNumero() {
        return $this->reseQuarNumero;
    }

    function setReseClieCpf($reseClieCpf) {
        $this->reseClieCpf = $reseClieCpf;
    }

    function setReseQuarNumero($reseQuarNumero) {
        $this->reseQuarNumero = $reseQuarNumero;
    }

    function getReseDataInicial() {
        return $this->reseDataInicial;
    }

    function getReseDataFinal() {
        return $this->reseDataFinal;
    }

    function setReseDataInicial($reseDataInicial) {
        $this->reseDataInicial = $reseDataInicial;
    }

    function setReseDataFinal($reseDataFinal) {
        $this->reseDataFinal = $reseDataFinal;
    }

//    protected function getAtributosDaClasse($nomeDaClasseModel = __CLASS__) {
//        return parent::getAtributosDaClasse($nomeDaClasseModel);
//    }
//
//    public function getArrayDeDadosDaClasse($nomeDaClasseModel = __CLASS__) {
//        return parent::getArrayDeDadosDaClasse($nomeDaClasseModel);
//    }

    function getReseData() {
        return $this->reseData;
    }

    function setReseData($reseData) {
        $this->reseData = $reseData;
    }

    protected function getAtributosDaClasse() {
        return get_class_vars(get_class());
    }

    public function alteraObjeto() {
        
    }

//
//    public function getArrayDeDadosDaClasse () {
//        //recupera todos os atributos desta classe para um array.
//        $arrayDeDadosDaClasse = $this->getAtributosDaClasse ();
//
//        //varre o array com os atributos e alimenta-o com os dados contidos nos 
//        //atributos desta classe.
//        foreach ($arrayDeDadosDaClasse as $atributo => $dado) {
//            $arrayDeDadosDaClasse[$atributo] = $this->$atributo;
//        }
//
//        //retorna o array com os atributos e dados desta classe.
//        return $arrayDeDadosDaClasse;
//    }
}
