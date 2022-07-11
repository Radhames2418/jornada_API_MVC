<?php

namespace Classes;

class Paginador
{

    public $ArregloTotal;
    public $paginaAnterior;
    public $paginaSiguiente;


    public function __construct($args = [], $pagina)
    {
        $this->ArregloTotal = $args;
        $this->paginaAnterior = ($pagina - 1) * 10;
        $this->paginaSiguiente = ($pagina) * 10;
    }

    public function paginar()
    {
        $arregloPaginado = [];

        for ($i = $this->paginaAnterior; $i < $this->paginaSiguiente; $i++) {
            if (isset($this->ArregloTotal[$i])) {
                $arregloPaginado[] = $this->ArregloTotal[$i];
            }
        }

        return $arregloPaginado;
    }
}
