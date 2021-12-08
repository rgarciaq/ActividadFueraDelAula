<?php
include_once 'DTO/Dto.php';
include_once 'conexion.php';



class DtoDAO{
  function mostrarDto(){
    $conexion=crearConexion();
      $arrayDtos=array();
      try {          
          $sql = "SELECT * FROM dto";
          $result = $conexion->prepare($sql);
          $result->execute();
          foreach($result as $row){
          array_push($arrayDtos,new Dto($row[0], $row[1]));
          }
        return $arrayDtos;
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage(); 
      } 
  }

  function mostrarDtoPorId($id){
    $conexion=crearConexion();
    $dto;
    try {          
        $sql = "SELECT * FROM dto WHERE id=?";
        $result = $conexion->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();
        foreach($result as $row){
          $dto=new Dto($row[0], $row[1]);
        }
        return $dto;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}


?>