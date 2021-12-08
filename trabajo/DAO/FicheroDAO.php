<?php

include_once 'DTO/Fichero.php';
include_once 'conexion.php';

class FicheroDAO{
  function mostrarFicheroPorId($id){


    
    $conexion=crearConexion();

      $arrayFichero=array();
      try {          
          $sql = "SELECT * FROM fichero where idPermiso=?";
          $result = $conexion->prepare($sql);
          $result->bindValue(1, $id);
          $result->execute();
          foreach($result as $row){
          
            array_push($arrayFichero,new Fichero($row[0], $row[1], $row[2]));

          }
        
        return $arrayFichero;
        
      } catch(PDOException $e) {
        
          echo "Error: " . $e->getMessage();
        
      }
        
  }

 



  function insertarFichero($ficheroDTO){
    try {
      $conexion=crearConexion();

      $stmt = $conexion->prepare("
      INSERT INTO fichero (id,idPermiso, nombre)
       VALUES (NULL,?, ?)");


       $stmt->bindValue(1, $ficheroDTO->getIdPermiso());

       $stmt->bindValue(2, $ficheroDTO->getNombre());

      $stmt->execute();

    } catch(PDOException $e) {

      echo "Error: " . $e->getMessage();

    }

$con = null;

  }


  function modificarFichero($ficheroDTO){
      try{
        $conexion=crearConexion();
        $stmt = $conexion->prepare("
        UPDATE permisocurso set nombre=?
        WHERE id=?");
        $stmt->bindValue(1, $ficheroDTO->getNombre());
        $stmt->bindValue(2, $ficheroDTO->getId());
        $stmt->execute();
        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }


  function eliminarFichero($ficheroDTO){
        try{
        $conexion=crearConexion();
        $stmt = $conexion->prepare("
        DELETE FROM fichero WHERE idPermiso=?");
        $stmt->bindValue(1, $ficheroDTO);
        $stmt->execute();
        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
}



?>