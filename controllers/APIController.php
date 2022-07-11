<?php

namespace Controllers;

use Model\Residente;

class APIController
{

    public static function index()
    {
        $residentes = Residente::all();
        echo json_encode($residentes);
    }

    public static function guardar()
    {
        try {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                //Almacenar al residente y devuelva el id
                $residente = new Residente($_POST);

                //Obtenemos los errores
                $errores = $residente->validar();

                //Validamos si existen errores
                if (empty($errores)) {
                    //Guardar registro
                    $respuesta = $residente->guardar();
                    $respuesta = [
                        'resultado' => $respuesta
                    ];

                    echo json_encode($respuesta['resultado']);
                } else {
                    //Mandar errores
                    echo json_encode($errores['error']);
                }
            }
        } catch (\Throwable $th) {
            echo json_encode($errores['error'] = [
                'Error' => 'Error al guardar el registro'
            ]);
        }
    }

    public static function actualizar()
    {
        try {
            $id = $_GET['id'] ?? null;
            $errores = [];

            if (!$id || !is_numeric($id)) {
                $errores = [
                    'Id' => 'no valido'
                ];
                echo json_encode($errores);
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $residente = Residente::find($id);
                $residente->sincronizar($_POST);

                //Obtenemos los errores
                $errores = $residente->validar();

                //Validamos si existen errores
                if (empty($errores)) {
                    //Actualizar registro 
                    $respuesta = $residente->guardar();
                    $respuesta = [
                        'resultado' => $respuesta
                    ];

                    echo json_encode($respuesta);
                } else {
                    //Mandar errores
                    echo json_encode($errores['error']);
                }
            }
        } catch (\Throwable $th) {
            echo json_encode($errores['error'] = [
                'Error' => 'Error al actualizar el registro'
            ]);
        }
    }


    public static function eliminar()
    {
        try {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $id = $_POST['id'];
                $residente = Residente::find($id) ?? null;

                if (!$residente) {
                    echo json_encode($errores['error'] = [
                        'Error' => 'El registro no existe'
                    ]);
                    return;
                }

                $errores = $residente->validarId();

                if (empty($errores)) {

                    $respuesta = $residente->eliminar();

                    $resultado = [
                        'resultado' =>  $respuesta
                    ];

                    echo json_encode($resultado);
                } else {
                    //Mandar errores
                    echo json_encode($errores['error']);
                }
            }
        } catch (\Throwable $th) {
            echo json_encode($errores['error'] = [
                'Error' => 'Error al eliminar el registro'
            ]);
        }
    }
}
