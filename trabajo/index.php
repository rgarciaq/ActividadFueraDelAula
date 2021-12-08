  <meta charset="utf-8">
   <!-- Compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

   <!-- Compiled and minified JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>          

   <style>
   .container{
          margin-top:8%;
   }
   </style>
   <?php
      include_once 'DAO/PermisoDAO.php';
      include_once 'DAO/DocenteDAO.php';
      
      
      $permisoDao=new PermisoDAO();
      $arrayPermisos=$permisoDao->mostrarPermisos();
      
      $docenteDao=new DocenteDAO();
      $arrayDocentes=$docenteDao->mostrarDocentes();
   ?>
   <body>

      
    <div class="container">
    <h2><u>Solicitud de Permiso Para Actividades Fuera del Aula</u></h2>
      
      <!-- TABLA -->   
      <div class = "row">
        <table>
          <thead>
            <tr>
                <th><u>Profesor</u></th>
                <th><u>Nombre de actividad</u></th>
                <th><u>Dia Actividad</u></th>
            </tr>
          </thead>

          <tbody>
            <?php contenidoTabla($arrayPermisos,$arrayDocentes); ?>
          </tbody>
        </table>
      </div>
      <div class = "row">
        <form action="añadir.php" method="post">
          <button class='waves-effect waves-light btn red lighten-2'
          type='submit' > Añadir nueva actividad</button>
        </form>
      </div>
    </div>
  </body>
<?php


function contenidoTabla($arrayPermisos,$arrayDocentes){
  foreach($arrayPermisos as $permiso){

    foreach($arrayDocentes as $docente){
      
      if($permiso->getIdProfesor()==$docente->getId()){
        contenidoFila($docente->getNombre(),$permiso->getNombreActividad(),$permiso->getDiaActividad(),$permiso->getId());
        
      }
    }
  }
  
}

function contenidoFila($profesor, $nombreActividad, $dia, $id){
  echo("<tr>
    <td>".$profesor."</td>
    <td>".$nombreActividad."</td>
    <td>".$dia."</td>
    
    <td>
      <form action='mostrar.php' method='post'>

        <button class='waves-effect waves-light btn  teal lighten-3' 
        type='submit' value='".$id."' name='idSelecionada'> Ver</button>
      </form>
    </td>
    <td>
      <form action='editar.php' method='post'>

        <button class='waves-effect waves-light btn' 
        type='submit' value='".$id."' name='idSelecionada'> Editar</button>
      </form>
    </td>
    <td>
      <form action='eliminar.php' method='post'>

        <button class='waves-effect waves-light btn red lighten-2'
        type='submit' value='".$id."' name='idSelecionada'> Eliminar</button>
      </form>
    </td>

    <td>
    <form action='convertirPdf.php' method='post'>

      <button class='waves-effect waves-light btn red lighten-1'
      type='submit' value='".$id."' name='idSelecionada'> Crear pdf</button>
    </form>
  </td>
  <td>
  <form action='enviarMail.php'' method='post'>
          <button class='waves-effect waves-light btn red lighten-2'
          type='submit' value='".$id."' name='idSelecionada'> Enviar un Mail</button>
        </form>
  </td>
  </tr>");

}
?>


