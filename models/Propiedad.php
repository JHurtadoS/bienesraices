<?php

namespace Model;

use Model\ActiveRecord;

Class Propiedad extends ActiveRecord{

     protected static $tabla='propiedades';
     protected static $clase="Model\Propiedad";
     protected static $columnas =['id','titulo','precio','nombreImagen','descripcion','habitaciones','wc','estacionamientos',
     'creado','vendedorId' ];

    public $id;
    public $titulo;
    public $precio;
    public $nombreImagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedorId;
    
    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '0';
        $this->nombreImagen = $args['nombreImagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
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
            }else{
                $vacio=false;
            }
            if($key=='descripcion'){
                if(strlen($value)<50 && $vacio!=true){
                    $error ="la descripcion debe tener minimo 50 caracteres";
                    $errores[] =$error;
                }
            }
        }

        if($imagenObligatoria){
            if($this->nombreImagen == ''){
                $errores[] = 'La imagen es obligatoria';
            }

        }
        return $errores;
    }

}