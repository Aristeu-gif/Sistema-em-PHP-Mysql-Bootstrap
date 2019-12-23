<?php

require_once '../Models/modelabstract.class.php';

abstract class ReservasAdo extends ModelAbstract {

    public function __construct() {
        $this->setNomeDaTabela("Reservas");
        parent::__construct();
    }

    public function buscaObjeto() {
        $where = "  reseClieCpf=?"
                . " and reseQuarNumero = ?"
                . " and reseDataInicial = ?"
                . " and reseDataFinal=?"
                . " and reseData=?"
                . " and reseClieCpf";
        return $this->buscaObjetoComPs(array($this->reseClieCpf,$this->reseQuarNumero,$this->reseDataInicial, $this->reseDataFinal, $this->reseData),$where);
    }

    public function buscaReservaPorCpfENumeroDoQuarto() {
        $where = " and reseQuarNumero = ?"
                . " and reseClieCpf";
        return $this->buscaObjetoComPs(array($this->reseQuarNumero), ($this->reseClieCpf), $where);
    }

    public function excluiObjeto() {
        $query = $this->montaDeleteUsandoAndDoObjetoPS(array('reseClieCpf' => $this->getReseClieCpf(), 'reseQuarNumero' => $this->getReseQuarNumero(),
            'reseDataInicial' => $this->getReseDataInicial(), 'reseDataFinal' => $this->getReseDataFinal(), 'reseData' => $this->getReseData()));
        return $this->executaPs($query, array($this->getReseClieCpf(), $this->getReseQuarNumero(), $this->getReseDataInicial(), $this->getReseDataFinal(), $this->getReseData()));
    }

    public function buscaReservasDoUsuarioLogado() {
        $where = "reseClieCpf = '{$this->reseClieCpf}'";
        return $this->buscaArrayObjetoComPs(array(null), $where, null);
    }

    public function verficaSeADataPassadaNoParametroEstaEmUmIntervadoDeDatas($data) {
        $query = "Select * from Reservas"
                . " where ?"
                . " BETWEEN (SELECT reseDataInicial from Reservas) and (SELECT reseDataFinal from Reservas)"
                . " and reseQuarNumero = ?";

        $arrayDeValores = array($data, $this->reseQuarNumero);

        $executou = $this->executaPs($query, $arrayDeValores);
        if ($executou) {
            if (parent::qtdeLinhas() === 0) {
                return 0;
            }
            if (parent::qtdeLinhas() === 1) {
                return 1;
            }
        } else {
            return false;
        }
    }

}
