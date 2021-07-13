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
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function setId($id){
        $this->id = $id;
    }

    public function validar(bool $imagenObligatoria){
        $errores=[];
        $vacio=false;
        $contadorvacios=0; 
        $datos=$this->atributos();
        foreach ($datos as $key => $value) {
            if(!$value){
                $vacio = true;
                $contadorvacios++;
                $error="hay un campo vacio (TODOS LOS CAMPOS SON OBLIGATORIOS)"; 
                if($contadorvacios===1){
                    $errores[] = $error;
                }
            }else if($key=='telefono' && strlen((string)$value)!=9){
                $error="El numero telefonico debe ser de minimo 9 digitos"; 
                $errores[] = $error;
            }
        }
        return $errores;

    }
}