<?php




include_once 'DAO/PermisoDAO.php';
include_once 'DAO/DocenteDAO.php';
include_once 'DAO/PermisoCursoDAO.php';
include_once 'DAO/CursosDAO.php';
include_once 'DAO/FicheroDAO.php';
$id=$_POST["idSeleccionada"];
$permisoDao=new PermisoDAO();
$permiso=$permisoDao->mostrarPermisoPorId($id);
$docenteDao=new DocenteDAO();
$docente=$docenteDao->mostrarDocentePorId($permiso->getIdProfesor());

$permisocursoDao=new PermisoCursoDAO();
$permisocurso=$permisocursoDao->mostrarPermisoCursoPorId($permiso->getId());



$arrayCursos=array();
foreach($permisocurso as $perm){
    array_push($arrayCursos,$perm->getIdCurso());
}
$arrayCursos=array_values(array_unique($arrayCursos));



$arrayHoras=array();
foreach($permisocurso as $perm){ 
    array_push($arrayHoras,$perm->getHora());
}
$arrayHoras=array_values(array_unique($arrayHoras));




$arr = array($id,$permiso->getIdProfesor(),  $permiso->getNombreActividad(),  $permiso->getDiaActividad(),
 $permiso->getHorario() ,  $arrayCursos,  $arrayHoras);
//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => );

echo json_encode($arr);
?>