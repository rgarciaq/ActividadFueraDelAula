<?php
include_once 'DTO/Cursos.php';
include_once 'conexion.php';



class CursosDAO{
  function mostrarCursos(){
    $conexion=crearConexion();
      $arrayCursos=array();
      try {          
          $sql = "SELECT * FROM cursos";
          $result = $conexion->prepare($sql);
          $result->execute();
          foreach($result as $row){
          array_push($arrayCursos,new Cursos($row[0], $row[1]));
          }
        return $arrayCursos;
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage(); 
      } 
  }

  function mostrarCursosPorId($id){
    $conexion=crearConexion();
    $curso;
    try {          
        $sql = "SELECT * FROM cursos WHERE id=?";
        $result = $conexion->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();
        foreach($result as $row){
          $curso=new Cursos($row[0], $row[1]);
        }
        return $curso;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}


?>