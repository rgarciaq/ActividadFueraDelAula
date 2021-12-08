<?php

include_once 'DTO/Permiso.php';
include_once 'conexion.php';

class PermisoDAO{
  function mostrarPermisos(){
    $conexion=crearConexion();
    $arrayPermisos=array();
    try {          
      $sql = "SELECT * FROM permiso";
      $result = $conexion->prepare($sql);
      $result->execute();
      foreach($result as $row){
        array_push($arrayPermisos,new Permiso($row[0], $row[1], $row[2], $row[3], $row[4]));
      }
      return $arrayPermisos;
    } catch(PDOException $e) { 
      echo "Error: " . $e->getMessage();
    }
        
  }
  function mostrarPermisoPorId($id){
    $conexion=crearConexion();
    $permiso;
    try {          
        $sql = "SELECT * FROM permiso WHERE id=?";
        $result = $conexion->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();
        foreach($result as $row){
          $permiso=new Permiso($row[0], $row[1], $row[2], $row[3], $row[4]);
        }
        return $permiso;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  function insertarPermisos($permisoDTO){
    try {
      $conexion=crearConexion();
      $stmt = $conexion->prepare("
      INSERT INTO permiso (id, idprofesor, nombreAcitivdad, diaActividad, Horario)
       VALUES (NULL, ?, ?, ?, ?)");
       $stmt->bindValue(1, $permisoDTO->getIdProfesor());
       $stmt->bindValue(2, $permisoDTO->getNombreActividad());
       $stmt->bindValue(3, $permisoDTO->getDiaActividad());
       $stmt->bindValue(4, $permisoDTO->getHorario());
       
      $stmt->execute();
      $id = $conexion->lastInsertId();
       return $id;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

    function modificarPermisos($permisoDTO){
      try{
        $conexion=crearConexion();
        $stmt = $conexion->prepare("
        UPDATE permiso set nombreAcitivdad=?, diaActividad=?, Horario=?, idprofesor=?
        WHERE id=?");
        $stmt->bindValue(1, $permisoDTO->getNombreActividad());
        $stmt->bindValue(2, $permisoDTO->getDiaActividad());
        $stmt->bindValue(3, $permisoDTO->getHorario());
         $stmt->bindValue(4, $permisoDTO->getIdProfesor());
        $stmt->bindValue(5, $permisoDTO->getId());
        $stmt->execute();
        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }


  function eliminarPermisos($permisoDTO){
        try{
        $conexion=crearConexion();
        $stmt = $conexion->prepare("
        DELETE FROM permiso WHERE id=?");
        $stmt->bindValue(1, $permisoDTO);
        $stmt->execute();
        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

}



?>