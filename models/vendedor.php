<?php

namespace Model;


class Vendedor extends ActiveRecord{

    protected static $tabla = 'vendedores';
    protected static $columnasDB =['id','nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    //Atributos
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }


    public function validar() {
        
        if(!$this->nombre){
            self::$errores[] = 'El Nombre es obligatorio';
        }

        if(!$this->apellido){
            self::$errores[] = 'El Apellido es obligatorio';
        }

        if(!$this->telefono){
            self::$errores[] = 'El Telefono es obligatorio';
        }

        //EXPRESION REGULARA PARA COMPROBAR QUE SON TELEFONOS
        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = 'El Formato no es valido';
        }

        return self::$errores;
    }
}