<?php

namespace Model;

class Residente extends ActiveRecord
{

    //Base de datos
    protected static $tabla = 'residente';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'telefono', 'correo', 'edad', 'direccion', 'comida_entregable', 'observacion'];

    //Atributos de la clase
    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $correo;
    public $edad;
    public $direccion;
    public $comida_entregable;
    public $observacion;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->edad = $args['edad'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->comida_entregable = $args['comida_entregable'] ?? '';
        $this->observacion = $args['observacion'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] =  "El nombre es obligatorio";
        }

        if (!$this->apellidos) {
            self::$alertas['error'][] =  "El apellidos son obligatorio";
        }

        if (!$this->correo) {
            self::$alertas['error'][] =  "El correo es obligatorio";
        }

        if (!$this->edad) {
            self::$alertas['error'][] =  "La edad es obligatoria";
        }

        if (!$this->direccion) {
            self::$alertas['error'][] =  "La direccion es obligatoria";
        }

        if (!is_numeric($this->comida_entregable)) {
            self::$alertas['error'][] =  "Formato incorrecto para comida_entregable";
        }


        if (!$this->observacion) {
            self::$alertas['error'][] =  "La observacion es obligatoria";
        }


        //Revisar
        if (!preg_match("/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/", $this->correo)) {
            self::$alertas['error'][] = "Formato no valido para el correo";
        }

        return self::$alertas;
    }


    public function validarId()
    {
        if (!$this->id) {
            self::$alertas['error'][] =  "El ID es obligatorio";
        }

        if (!is_numeric($this->id)) {
            self::$alertas['error'][] =  "El id debe ser un numero";
        }

        return self::$alertas;
    }
}
