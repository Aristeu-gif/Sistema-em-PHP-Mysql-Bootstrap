<?php

require_once '../Models/modelabstract.class.php';

abstract class fotoado extends ModelAbstract {

    function __construct() {
        $this->setNomeDaTabela("Fotos");
        parent::__construct();
    }

    public function buscaObjeto() {

        $where = " fotoId = ? ";
        return $this->buscaObjetoComPs(array($this->fotoId), $where);
    }
    
    public function alteraObjeto() {
        $arrayDeColunasEValores = array(
            "fotoTitulo" => $this->getFotoTitulo(),
            "fotoQuarNumero" => $this->getFotoQuarNumero(),
            "fotoImagem" => $this->getFotoImagem(),
            "fotoExtensao" => $this->getFotoExtensao()
        );

        $where = " fotoId = ? ";

        $query = $this->montaUpdateDoObjetoPS($this->getNomeDaTabela(), $arrayDeColunasEValores, $where);

        $arrayDeColunasEValores ["fotoId"] = $this->getFotoId();

        return $this->executaPs($query, $arrayDeColunasEValores);
    }

    public function excluiObjeto() {
        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('fotoId' => $this->getFotoId()));
        return $this->executaPs($query, array($this->getFotoId()));
    }

}

