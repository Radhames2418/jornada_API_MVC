<?php 

namespace Controllers;

use Model\Residente;
use Classes\Paginador;

class PaginadorController{

    public static function paginador()
    {
        $pagina = $_GET['pagina'] ?? null;
        $errores = [];

        if (!$pagina || !is_numeric($pagina)) {
            $errores = [
                'Pagina no valida' => 'no valido'
            ];
            echo json_encode($errores);
            return;
        }

        $paginado = new Paginador(Residente::reverse(), $pagina);
        $arregloPaginado = $paginado->paginar();

        echo Repuesta($arregloPaginado);
    } 
}