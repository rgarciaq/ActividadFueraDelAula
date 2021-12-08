<?php

include_once 'DTO/PermisoCurso.php';
include_once 'conexion.php';

class PermisoCursoDAO{
  
  function mostrarPermisoCursoPorId($id){
    $conexion=crearConexion();
    $arraypermisoCurso=array();
    try {          
        $sql = "SELECT * FROM permisocurso WHERE idPermiso=?";
        $result = $conexion->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();
        foreach($result as $row){
          array_push($arraypermisoCurso,new PermisoCurso($row[0], $row[1], $row[2]));

        }
        return $arraypermisoCurso;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

 

  

  function insertarPermisoCurso($permisoCursoDTO){
    try {
      $conexion=crearConexion();
      $stmt = $conexion->prepare("
      INSERT INTO permisocurso (idPermiso, idCurso, hora)
       VALUES (?, ?, ?)");
       $stmt->bindValue(1, $permisoCursoDTO->getIdPermiso());
       $stmt->bindValue(2, $permisoCursoDTO->getIdCurso());
       $stmt->bindValue(3, $permisoCursoDTO->getHora());
      $stmt->execute();
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  
    function modificarPermisoCurso($permisoCursoDTO){
      try{
        $conexion=crearConexion();
        $stmt = $conexion->prepare("
        UPDATE permisocurso set idPermiso=?, idCurso=?, hora=? 
        WHERE idPermiso=?");
        $stmt->bindValue(1, $permisoCursoDTO->getIdPermiso());
        $stmt->bindValue(2, $permisoCursoDTO->getIdCurso());
        $stmt->bindValue(3, $permisoCursoDTO->getHora());
        $stmt->execute();
        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }


  function eliminarPermisoCurso($permisoCursoDTO){
        try{
        $conexion=crearConexion();
        $stmt = $conexion->prepare("
        DELETE FROM permisocurso WHERE idPermiso=?");
        $stmt->bindValue(1, $permisoCursoDTO);
        $stmt->execute();
        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

}



?>