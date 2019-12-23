<?php

require_once '../Models/modelabstract.class.php';

abstract class QuartosAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Quartos");

        parent::__construct();
    }

    public function buscaObjeto() {

        $where = "quarNumero = ?";
        return $this->buscaObjetoComPs(array($this->quarNumero), $where);
    }

    public function alteraObjeto() {
        $arrayDeColunasEValores = array(
            "quarNome" => $this->getQuarNome(),
            "quarDescricao"=> $this->getQuarDescricao(),
            "quarQtdeHospedes"=>$this->getQuarQtdeHospedes()
        );

        $where = " quarNumero = ? ";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);
        
        $arrayDeColunasEValores ["quarNumero"] = $this->getQuarNumero();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {
        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('quarNumero' => $this->getQuarNumero()));
        return $this->executaPs($query, array($this->getQuarNumero()));
    }
    
    

}
