<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
   <!-- Compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

   <!-- Compiled and minified JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>     
 
</head>
<body>

  <?php
      include_once 'DAO/PermisoDAO.php';
      include_once 'DAO/DocenteDAO.php';
      include_once 'DAO/DtoDAO.php';
      include_once 'DAO/PermisoCursoDAO.php';
      include_once 'DAO/CursosDAO.php';
      include_once 'DAO/FicheroDAO.php';
      
      
      $permisoDao=new PermisoDAO();
      $arrayPermisos=$permisoDao->mostrarPermisos();
      
      $docenteDao=new DocenteDAO();
      $arrayDocentes=$docenteDao->mostrarDocentes();
   ?>
  <div class="container">

      
<div class="row">
        <h3 class="header left teal-text">PERMISO PARA ACTIVIDADES FUERA DEL AULA</h3>
      </div>

           <div id="datosProfesor">
                <div class="row">
                    <h5 class="header left teal-text">Profesor:</h5>
                </div>
                <div class = "row">
                    <?php
                    $permisoDao=new PermisoDAO();
                    $permiso=$permisoDao->mostrarPermisoPorId($_POST['idSelecionada']);

                    $docenteDao=new DocenteDAO();
                    $docente=$docenteDao->mostrarDocentePorId($permiso->getIdProfesor());

                    $dtoDao=new DtoDAO();
                    
                    $dto=$dtoDao->mostrarDtoPorId($docente->getDto());

                    $permisocursoDao=new PermisoCursoDAO();
                    $permisocurso=$permisocursoDao->mostrarPermisoCursoPorId($_POST['idSelecionada']);

                   

                    echo("Don/Do&ntilde;a ".$docente->getNombre());
                    echo(" con DNI ".$docente->getDni());
                    echo(" y N.R.P ".$docente->getNrp());
                    echo(" con domicilio en ".$docente->getDomicilio());
                    echo(" y tel&eacute;fono de contacto ".$docente->getTelefono().".");
                    echo("<br>");
                    echo(" Profesor/a de  ".$dto->getNombre());
                    echo(" en el IES August&oacute;briga de Navalmoral de la Mata.")
 
                    ?>
                </div>

                <div id="actividad">
               <div class="row">
                    <h5 class="header left teal-text">Actividad:</h5>
               </div>
               <div class="row">
                <div class="input-field col s12">
                  <?php
                  echo("Se va a realizar la actividad ".$permiso->getNombreActividad());
                  echo(" el pr&oacute;ximo d&iacute;a: ".$permiso->getDiaActividad());
                  ?>
                </div>
               </div>
              </div>
              <div class="row">
                <h5 class="header left teal-text">Horario:</h5>
            </div>
            <div class="row">
                      <?php
                      echo("Horario: ".$permiso->getHorario());
                      ?>
            </div>
             <div class="row">
                
            <?php
            echo("Cursos: ");
            $arrayCursos=array();
             foreach($permisocurso as $perm){
                    
                   
                    array_push($arrayCursos,$perm->getIdCurso());
              }
              $arrayCursos=array_unique($arrayCursos);
              foreach($arrayCursos as $curso){
                    
                $cursosDao=new CursosDAO();
                $cursos=$cursosDao->mostrarCursosPorId($curso);
                echo($cursos->getNombre()." ");
               
              }
               
            
            ?>
            

            </div>

              <div class="row">
                    <h5 class="header left teal-text">Horas:</h5>
               </div>
            <div class="row">
              
            
            <?php
            echo("Horas: ");

            $arrayCursosHoras=array();
             foreach($permisocurso as $perm){
                  
                  
                  array_push($arrayCursosHoras,$perm->getHora());
            }
            $arrayCursosHoras=array_unique($arrayCursosHoras);
            foreach($arrayCursosHoras as $hora){
                  
              echo($hora." ");
              
            }


            
            ?>
            
            </div>
            <div class = "row">
            <h5 class="header left teal-text">Documentaci&oacute;n Adjuntada:</h5>
            </div>
             <div class = "row">
                <form action="abrirArchivo.php" method="post">
                <?php
                $ficheroDao=new FicheroDAO();
                    $fichero=$ficheroDao->mostrarFicheroPorId($permiso->getId());
                    //print_r($fichero);
                    foreach($fichero as $f){   
                    echo($f->getNombre()." ");
                    }
                ?>
                </form>
            </div>
            
            </div>
            
           

    </div>

</body>
</html>

      

