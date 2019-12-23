<?php

require_once '../Models/modelabstract.class.php';

abstract class UsuarioAdo extends ModelAbstract {

    function __construct() {
        $this->setNomeDaTabela("Usuarios");
        parent::__construct();
    }

    public function buscaObjeto() {

        $where = " usuaCpf = ? ";
        return $this->buscaObjetoComPs(array($this->usuaCpf), $where);
    }
    
    public function montaStringInstrucaoDelete(){
        
    }


    public function alteraObjeto() {
        $arrayDeColunasEValores = array(
            "usuaNome" => $this->getUsuaNome(),
            "usuaEmail" => $this->getUsuaEmail(),
            "usuaSenha" => $this->getUsuaSenha(),
        );

        $where = " usuaCpf = ? ";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);

        $arrayDeColunasEValores ["usuaCpf"] = $this->getUsuaCpf();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {
        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('usuaCpf' => $this->getUsuaCpf()));
        return $this->executaPs($query, array($this->getUsuaCpf()));
    }
    
     public function buscaUsuarioPorCpfESenha() {

        $where = " usuaCpf = ? and usuaSenha = ?";
        
        return $this->buscaObjetoComPs(array($this->usuaCpf,$this->usuaSenha), $where);
    }

}
