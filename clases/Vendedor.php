<?php

namespace App;

use app\ActiveRecord;

Class Vendedor extends ActiveRecord{
    protected static $tabla='vendedores';
    protected static $clase='App\Vendedor';
    protected static $columnas =['id','nombre','apellido','telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '0';
        $this->telefono = $args['telefono'] ?? '';
    }
}