<?php

abstract class ValidaData {

    private function __construct() {
        
    }

    static function validaData($data) {
        // data é menor que 8
        if (strlen($data) < 8) {
            return false;
        } else {
            // verifica se a data possui
            // a barra (/) de separação
            if (strpos($data, "/") !== FALSE) {
                //
                $partes = explode("/", $data);
                // pega o dia da data
                $dia = $partes[0];
                // pega o mês da data
                $mes = $partes[1];
                // prevenindo Notice: Undefined offset: 2
                // caso informe data com uma única barra (/)
                $ano = isset($partes[2]) ? $partes[2] : 0;

                if (strlen($ano) < 4) {
                    return false;
                } else {
                    // verifica se a data é válida
                    if (checkdate($mes, $dia, $ano)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }

}
