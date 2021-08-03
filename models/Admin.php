<?php
namespace Model;

class Admin extends ActiveRecord{

    public $id=0;
    public $email='';
    public $password='';

    protected static $tabla='usuarios';
    protected static $clase="Model\Admin";
    protected static $columnas =['id','email','password'];

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }
    public function ValidarUsuario(){
            
    }    
}