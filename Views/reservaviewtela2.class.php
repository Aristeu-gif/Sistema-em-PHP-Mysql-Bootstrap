<?php

require_once '../Views/reservaview.class.php';

class ReservaViewTela2 extends ReservaView {

    public function montaDivDeBotoes() {
        //div dos botões
        $divDeBotoes = new HtmlDiv();
        $divDeBotoes->setClass("form-group text-center");
        //botão de exclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("cancelarReserva");
        $button->setConteudo("Cancelar reserva");
        $button->setClass("btn btn-primary");
        $divDeBotoes->addElemento($button);
        return $divDeBotoes;
    }

}
