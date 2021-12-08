<?php
include_once 'DTO/Docente.php';
include_once 'conexion.php';



class DocenteDAO{
  function mostrarDocentes(){
    $conexion=crearConexion();
      $arrayDocentes=array();
      try {          
          $sql = "SELECT * FROM docente";
          $result = $conexion->prepare($sql);
          $result->execute();
          foreach($result as $row){
          array_push($arrayDocentes,new Docente($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]));
          }
        return $arrayDocentes;
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage(); 
      } 
  }

  function mostrarDocentePorId($id){
    $conexion=crearConexion();
    $docente;
    try {          
        $sql = "SELECT * FROM docente WHERE id=?";
        $result = $conexion->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();
        foreach($result as $row){
          $docente=new Docente($row[0], $row[1], $row[2], $row[3], $row[4],$row[5], $row[6]);
        }
        return $docente;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}


?>