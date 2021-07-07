<?php
require 'inc/app.php';


$email = "correco@correo.com";
$pasword = "123456";
$paswordhash = password_hash($pasword,PASSWORD_BCRYPT);

$query ="INSERT INTO usuarios (email,password) VALUES ('$email','$paswordhash')";

mysqli_query($db,$query);