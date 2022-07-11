<?php

namespace Controllers;

use Model\Residente;

class ResidenteController
{

    public static function nombre()
    {
        $nombre = validarGet('nombre');

        $residente = Residente::where('nombre', $nombre);

        echo Repuesta($residente);
    }

    public static function correo()
    {
        $correo = validarGet('correo');

        $residente = Residente::where('correo', $correo);

        echo Repuesta($residente);
    }


    public static function find()
    {
        $id = $_GET['id'] ?? null;
        $errores = [];

        if (!$id || !is_numeric($id)) {
            $errores = [
                'Id' => 'no valido'
            ];
            echo json_encode($errores);
            return;
        }

        $residente = Residente::find($id);

        echo Repuesta($residente);
    }

    public static function down()
    {
        $residentes = Residente::desc();
        $respuesta = [
            'resultado' => $residentes
        ];

        echo Repuesta($respuesta);
    }

    public static function filter()
    {
        $letra = $_GET['letra'] ?? null;
        $errores = [];

        if (!$letra || is_numeric($letra) || strlen($letra) > 2 ) {
            $errores = [
                'Letra' => 'no valido'
            ];
            echo json_encode($errores);
            return;
        }

        $letraMay = strtoupper($letra);
        $letraMin = $letra;

        $residentes = Residente::letra($letraMay, $letraMin);
        $respuesta = [
            'resultado' => $residentes
        ];

        echo Repuesta($respuesta['resultado']);
    }
}
