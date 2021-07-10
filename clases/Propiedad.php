<?php
//declare(strict_types=1);
namespace App;


Class Propiedad{

    protected static $DB;
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

    public function SetArguments($args=[]){
        foreach ($args as $key => $value) {
            if(property_exists($this,$key) && !is_null($value))
                $this->$key = $value;
        }
    }

    public static function SetDB($database){
        self::$DB = $database;
    }
    public static function all(string $tabla ){
       $query="SELECT * FROM"." ".$tabla;
       return self::consultarSQL($query);
    }

    public static function SelectWhere(string $tabla,int $id){
        $query="SELECT * FROM ".$tabla." "."WHERE id="."$id";
        $resultado=self::consultarSQL($query);
        return $resultado[0];
    }

    public static function consultarSQL($query){
        $resultado=self::$DB->query($query);
        $rows=[];
        while ($registro=$resultado->fetch_assoc()) {
            $clase="App\Propiedad";
           $new = new $clase();
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

        $query  = "INSERT INTO propiedades ( $stringKeys )";
        $query .= "VALUES(' ";
        $query .= $stringvalues;
        $query .= " ') ";

        $resultado= self::$DB->query($query);

        return $resultado;

    }

    public function actualizar(){
        $atributos = $this->sanitizarDatos();

        $i=0;
        $query  = "UPDATE propiedades SET ";
        
        foreach ($atributos as $key => $value) {
            $i++;  
            $query .= $key."=";
            $query .= "'".$value."'";
            if($i<count($atributos)){
                $query .= " , ";
            }
           
        }
        $query .=" WHERE id=".$this->$atributos['id'];
        echo "$query";
        $resultado= self::$DB->query($query);
        return $resultado;
    }

    public function atributos(){
        $atributos=[];
        foreach(self::$columnas as $columna){
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