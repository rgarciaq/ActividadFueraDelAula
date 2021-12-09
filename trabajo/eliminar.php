<?php
include_once 'DAO/PermisoDAO.php';
include_once 'DAO/DocenteDAO.php';
include_once 'DAO/CursosDAO.php';
include_once 'DAO/PermisoCursoDAO.php';
include_once 'DAO/FicheroDAO.php';

            $permiso=new PermisoDAO();
            $permisocurso= new PermisocursoDAO();
            $fichero = new FicheroDAO();
            print_r($_POST);
            $permiso->eliminarPermisos($_POST['idSelecionada']);
            $permisocurso->eliminarPermisoCurso($_POST['idSelecionada']);
            $fichero->eliminarFichero($_POST['idSelecionada']);
            header('Location:index.php');
?>
