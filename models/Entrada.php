<?php

namespace Model;

class Entrada extends ActiveRecord {

    protected static $tabla = 'entradas_blog';
    protected static $columnasDB = ['id', 'titulo', 'contenido', 'imagen', 'fecha_publicacion', 'autor', 'resumen'];

    public $id;
    public $titulo;
    public $contenido;
    public $imagen;
    public $fecha_publicacion;
    public $autor;
    public $resumen;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->fecha_publicacion = $args['fecha_publicacion'] ?? date('Y-m-d');
        $this->autor = $args['autor'] ?? 'Admin';
        $this->resumen = $args['resumen'] ?? '';
    }

    public static function get($limite = null) {
    $query = "SELECT * FROM " . static::$tabla;

    if ($limite) {
        $query .= " LIMIT " . intval($limite);
    }

    $resultado = self::consultarSQL($query);

    return $resultado;
}



    public function validar() {
        if (!$this->titulo) {
            self::$errores[] = 'El título es obligatorio';
        }

        if (!$this->resumen) {
            self::$errores[] = 'El resumen es obligatorio';
        }

        if (!$this->contenido) {
            self::$errores[] = 'El contenido es obligatorio';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;
    }
}
