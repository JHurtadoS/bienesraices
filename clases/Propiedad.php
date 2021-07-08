<?php
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

    public static function SetDB($database){
        self::$DB = $database;
    }

    public function guardar(){
        $atributos = $this->sanitizarDatos();
        $stringKeys = join(', ',array_keys($atributos));
        $stringvalues = join("', '",array_values($atributos));

        $query  = "INSERT INTO propiedades ( $stringKeys )";
        $query .= "VALUES(' ";
        $query .= $stringvalues;
        $query .= " ') ";
        echo"<pre>";
        echo $query;
        echo"</pre>";
        $resultado= self::$DB->query($query);

        echo"<pre>";
        var_dump($resultado);
        echo"</pre>";

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