<?php

namespace app;

class ActiveRecord{

    protected static $clase='';
    protected static $tabla='';
    protected static $DB;
    protected static $columnas =[];
    protected static $errores=[];
    
    public function validar(bool $imagenObligatoria){
        return self::$errores;
    }

    public function SetArguments($args=[]){
        foreach ($args as $key => $value) {
            if(property_exists($this,$key) && !is_null($value))
                $this->$key = $value;
        }
    }

    public static function SetDB($database){
        self::$DB = $database;
    }

    public static function all(){
       $query="SELECT * FROM"." ".static::$tabla;
       return self::consultarSQL($query,static::$clase);
    }

    public static function SelectWhere(int $id){
        $query="SELECT * FROM ".static::$tabla." "."WHERE id="."$id";
        $resultado=self::consultarSQL($query,static::$clase);
        return $resultado[0];
    }

    public static function consultarSQL($query){
        $resultado=self::$DB->query($query);
        $rows=[];
        while ($registro=$resultado->fetch_assoc()) {
           $new = new static::$clase();
           $object=(object)$registro;
           foreach($object as $property => &$value)
           {
               $new->$property = &$value;
               unset($object->$property);
           }
           $rows[]=$new;
        }
        $resultado->free();
        return $rows;
    }

    public function guardar(){
        $atributos = $this->sanitizarDatos();
        $stringKeys = join(', ',array_keys($atributos));
        $stringvalues = join("', '",array_values($atributos));

        $query  = "INSERT INTO " .static::$tabla. " ( $stringKeys )";
        $query .= "VALUES(' ";
        $query .= $stringvalues;
        $query .= " ') ";


        $resultado= self::$DB->query($query);
        return $resultado;

    }

    public function borrar(){
        $query="DELETE FROM ".static::$tabla." WHERE id=$this->id";
        $resultado= self::$DB->query($query);
        return $resultado;
    }

    public function actualizar(){
        $atributos = $this->sanitizarDatos();

        $i=0;
        $query  = "UPDATE " .static::$tabla. " SET ";
        
        foreach ($atributos as $key => $value) {
            $i++;  
            $query .= $key."=";
            $query .= "'".$value."'";
            if($i<count($atributos)){
                $query .= " , ";
            }
        }
        $query .=" WHERE id="."$this->id";
        $resultado= self::$DB->query($query);
        return $resultado;
    }

    public function atributos(){
        $atributos=[];
        foreach(static::$columnas as $columna){
            if($columna==='id')continue;
            $atributos[$columna]=$this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos=$this->atributos();
                    
        $sanitizado=[];

        foreach($atributos as $key=>$value){
            $sanitizado[$key]=self::$DB->escape_string($value);
        }


        return $sanitizado;
    }

    public function SetImagen($imagen){
        if($imagen){
            $this->nombreImagen=$imagen;
        } 
    }
 
}