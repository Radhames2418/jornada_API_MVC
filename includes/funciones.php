<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar por Get  WHERE
function validarGet($valor)
{
    try {
        $valor = $_GET[$valor] ?? null;
        $errores = [];

        if (!$valor || is_numeric($valor)) {
            $errores = [
                `${valor}` => 'No valido'
            ];
            echo json_encode($errores);
            return;
        }

        return $valor;
    } catch (\Throwable $th) {
        return null;
    }
}

//Dar una respuesta JSON 
function Repuesta($valor)
{

    if (!$valor) {
        $errores = [
            'Registro' => 'No Encontrado'
        ];
        return json_encode($errores);
    } else {
        return json_encode($valor);
    }
}
