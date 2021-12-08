<?php
function crearConexion(){
  $config = parse_ini_file('datosBD.ini');
  try {
    $conexion = new PDO("mysql:host=".$config['host'].";dbname=".$config['dbname'], $config['username'], $config['password']);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conexion;
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
}
  
?>