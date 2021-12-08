
<?php
include_once 'DAO/PermisoDAO.php';
include_once 'DAO/DocenteDAO.php';
include_once 'DAO/CursosDAO.php';
include_once 'DAO/FicheroDAO.php';
include_once 'DAO/PermisoCursoDAO.php';

    if(isset($_POST['modificar'])){
      $id=$_POST['modificar'];
        insercion($id);
        

    }
    
    
    
    $docenteDao=new DocenteDAO();
    $arrayDocentes=$docenteDao->mostrarDocentes();
    $cursosDao=new CursosDAO();
    $arrayCursos=$cursosDao->mostrarCursos();

    
    function insercion($id){
      $faltanDatos="no";
      $cadenaError="";

      $profesor="";
      if(isset($_POST['profesores'])){
          $profesor=$_POST['profesores'];
      }else{
          $faltanDatos="si";
          $cadenaError.="<p style='color:red;'>no has puesto profesor</p>";
      }
      
      $nActividad="";
      if(!empty($_POST['nActividad'])){
          $nActividad=$_POST['nActividad'];
      }else{
          $faltanDatos="si";
          $cadenaError.="<p style='color:red;'>no has puesto nombre a la actividad</p>";
      }
      
      $dia="";
      if(!empty($_POST['dia'])){
          $dia=$_POST['dia'];
      }else{
          $faltanDatos="si";
          $cadenaError.="<p style='color:red;'>no has puesto dia</p>";
      }
      $horario=$_POST['horario'];
      
      $cursos = array();
      if(isset($_POST['cursos'])){
        foreach($_POST['cursos'] as $selected){
          
            array_push($cursos, $selected);
        }
      }else{
          $faltanDatos="si";
          $cadenaError.="<p style='color:red;'>no has puesto cursos</p>";
      }
      
      $horas = array();
      if(!empty($_POST['horas'])){
          foreach($_POST['horas'] as $selected){
              array_push($horas, $selected);
          }
      }else{
          $faltanDatos="si";
          $cadenaError.="<p style='color:red;'>no has puesto horas</p>";
      }
      //print_r($_POST['fichero']);

      
      

      if($faltanDatos=="no"){   ///aqui tiene que ser la consulta


        
        
        $permiso=new PermisoDAO();
        $permiso->modificarPermisos(new Permiso($id,$profesor,$nActividad,$dia,$horario));

        $permisoCursoDao=new PermisoCursoDAO();
        $permisoCursoDao->eliminarPermisoCurso($id);

        foreach($horas as $hora){
          
          foreach($cursos as $curso){
            $permisoCursoDao->insertarPermisoCurso(new PermisoCurso($id,$curso , $hora));
          }
        }

        $ficheroDao=new FicheroDAO();
        $arrayFicheros=guardarFicheros();
        $ficheroDao->eliminarFichero($id);

        foreach($arrayFicheros as $fichero){
          if($fichero!=null){
            $ficheroDao->insertarFIchero(new Fichero("null", $id, $fichero));
          }
        }
        

        



          header('Location:index.php');
      }else{
          echo($cadenaError);
      }
        
        
    }

    function guardarFicheros(){
      $arrayFicheros= array();
      foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
        $nombre=$_FILES['archivo']['name'][$key];
        $guardado=$_FILES['archivo']['tmp_name'][$key];

        if(!file_exists('archivos')){
            mkdir('archivos',0777,true);
            
        }

        move_uploaded_file($guardado, 'archivos/'.$nombre);
           
        array_push($arrayFicheros,$nombre);
        
        

      }
      return $arrayFicheros;
      
    }
 ?>
 <meta charset="utf-8">
   <!-- Compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

   <!-- Compiled and minified JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>        
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  

   <body>
    <div class="container">

      <form method="post" action="editar.php" enctype="multipart/form-data">
      <!-- T�TULOS -->
      <div class="row">
        <h3 class="header left teal-text">PERMISO PARA ACTIVIDADES FUERA DEL AULA</h3>
      </div>

        <form class="col s12">
           <div id="datosProfesor">
                <div class="row">
                    <h5 class="header left teal-text">Profesor:</h5>
                </div>

                <div class = "row">
                    <select name="profesores">
                         <option value = "" disabled selected>Seleccione un profesor</option>
                         <?php
                            foreach($arrayDocentes as $docentes){
                                echo("<option value = '".$docentes->getId()."'>".$docentes->getDni()."</option>");
                            }
                         
                         ?>
                    </select>               
                </div>
           </div>

              <div id="actividad">
               <div class="row">
                    <h5 class="header left teal-text">Actividad:</h5>
               </div>
               <div class="row">
                <div class="input-field col s6">
                  <textarea name="nActividad" class="materialize-textarea"></textarea>
                  <label for="nActividad">Actividad a realizar</label>
                </div>
                <div class="input-field col s6">
                  <input name="dia" type="date" class="validate">
                  <label for="dia">Fecha</label>
                </div>             
              </div>
              </div>

              <div class="row">
                <h5 class="header left teal-text">Horario:</h5>
            </div>
            <div class="row">
                
               
              <p>
                <p>
                    <label>
                      <input name="horario" type="radio" value="diurno"  checked />
                      <span>Diurno</span>
                    </label>
                 
                    <label>
                      <input name="horario" type="radio" value="nocturno" />
                      <span>Nocturno</span>
                    </label>
                  </p>
              </p>
            </div>
            <div class="row">
                <h5 class="header left teal-text">Cursos:</h5>
            </div>
            <div class="row">
                
               
            <select class="selectpicker" id="cursos" name="cursos[]"  multiple>
            <?php
              foreach($arrayCursos as $cursos){
                  echo("<option  value = '".$cursos->getId()."'  >".$cursos->getNombre()."</option>");
              }
            
            ?>
            
          </select>

            </div>


              <div class="row">
                    <h5 class="header left teal-text">Horas:</h5>
               </div>
            <div class="row">
              <p>
                <label>
                  <input type="checkbox" name="horas[]" value="1" />
                  <span>1º hora</span>
                </label>
                <br>
                <label>
                  <input type="checkbox" name="horas[]" value="2"/>
                  <span>2º hora</span>
                </label>
                <br>
                <label>
                  <input type="checkbox" name="horas[]" value="3"/>
                  <span>3º hora</span>
                </label>
                <br>
                <label>
                  <input type="checkbox" name="horas[]" value="4"/>
                  <span>4º hora</span>
                </label>
                <br>
                <label>
                  <input type="checkbox" name="horas[]" value="5"/>
                  <span>5º hora</span>
                </label>
                <br>
                <label>
                  <input type="checkbox" name="horas[]" value="6"/>
                  <span>6º hora</span>
                </label>
              </p>

            </div>
            

            <div class = "row">
                <label>Documentación a adjuntar:</label> 
                 
                <input type="file" class="form-control" id="archivo" name="archivo[]" multiple="">

            </div>
            

            <div class = "row">
                <button class="waves-effect waves-light btn" type="submit" name='modificar' value='<?php echo($_POST['idSelecionada']); ?>' > modificar</button>
            </div>
            <a href="index.php">Volver</a>
            

   </div>   
   <script>
  //Evento para el select
    document.addEventListener('DOMContentLoaded', function() {
   var elems = document.querySelectorAll('select');
   var options = document.querySelectorAll('option');
   var instances = M.FormSelect.init(elems, options); })


   //Evento para los campos fecha
   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    
  });
 
 

 </script>


<script>
  

  $(document).ready(function() {






    $.ajax({
      url:"datosParaInsertar.php",
      method:"POST",
      data:{ idSeleccionada: "<?php echo($_POST["idSelecionada"]) ?>"},
      dataType:"JSON",
      success:cargar
    }); 

  });
  function cargar(data){
    console.log(data[0])
    document.getElementsByName('profesores')[0].value=data[1];
    document.getElementsByName('nActividad')[0].value=data[2];
    document.getElementsByName("dia")[0].value = data[3];
    if(data[4]=="diurno"){
      document.getElementsByName("horario")[0].checked = true;
    }else{
      document.getElementsByName("horario")[1].checked = true;
    }
    $('#cursos').val(data[5]);

    data[6].forEach(e=>{
      document.getElementsByName("horas[]")[e-1].checked = true;
    });




  }
 
   

 
  
  </script>


