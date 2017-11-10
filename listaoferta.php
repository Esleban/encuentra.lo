<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Encuentra.lo</title>
  <link rel="icon" type="image/x-icon" href="img/icon.ico">
  <!-- Icono de la ventana -->
  <link href="favicon.ico" rel="shortcut icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet"> 
  
  <!-- Archivos CSS Bootstrap -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Librerias CSS -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate-css/animate.min.css" rel="stylesheet">
  
  <!-- Archivo de estilo principal -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <div id="preloader"></div>

<!--==========================
  MENU
============================-->
<header id="header" style="height: 70px;">
  <div class="container">
    <div id="logo" class="pull-left">
      <a href="index.php"><img src="img/logo.png" alt="" title="Inicio" /></img></a>
    </div>
      
    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li ><a href="#" role="button" data-toggle="modal" data-target="#login-empresa">Inicio</a></li>
        <li><a href="#" role="button" data-toggle="modal" data-target="#register-modal">Citas</a></li>
        <li><a href="#" role="button" data-toggle="modal" data-target="#login-modal" class="btn-get-started">Candidatos</a></li>
       <li><a href="#" role="button" data-toggle="modal" data-target="#login-modal" class="btn-get-started">Agregar Oferta</a></li>
        <li><a href="#" role="button" data-toggle="modal" data-target="#login-modal" class="btn-get-started">Salir</a></li>
        
      </ul>
    </nav>
  </div>
</header>

<!-- MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header" align="center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </button>
             <!-- <img  id="img_logo" src="img/logo.png">-->
           </div>
                <!-- iNICIO DE FORMULARIO -->
                <div id="div-forms">

                        <!-- Begin # Login Form -->
                        <form id="login-form" method="post"  autocomplete="on">
                          <div class="modal-body">
                            <h1>Editar Oferta</h1>
                             <b> Titulo del empleo</b>
                        
                              <input type="text" name="NombreEmpleo" class="form-control" maxlength="40" />
                              <span class="text-danger"></span>

                            <b>Habilidades</b>
                           <!-- <input id="login_password" class="form-control" type="password" placeholder="Contraseña" required>
                            <input type="text" name="pass" class="form-control" placeholder="Contraseña" maxlength="15" />-->
                            <textarea name="habilidades" class="form-control" form="login-form"></textarea>
                            <span class="text-danger"></span>

                            <b>  Titulacion requerida</b>
                           <!-- <input id="login_password" class="form-control" type="password" placeholder="Contraseña" required>
                            <input type="text" name="pass" class="form-control"  maxlength="15" />
                            <span class="text-danger"></span>-->
                            <select name="OS" class="form-control">
   <option value="1">Licenciatura</option> 
   <option value="2">Carrera Tecnica</option> 
   <option value="3">Bachillerato Terminado</option>
   <option value="10">Maestria</option> 
   <option value="11">Posgrado</option> 
   <option value="12">Otro</option> 
</select>

                              <b>Retribución</b>
                           <!-- <input id="login_password" class="form-control" type="password" placeholder="Contraseña" required>-->
                            <input type="number" name="pass" class="form-control"  maxlength="15" />
                            
        <input id="gen" type="radio" name="gender" value="male" checked style="width: 15px;height: 15px;color: white"> Semanal 
        <input id="gen" type="radio" name="gender" value="female" style="width:15px;height: 15px;color: white"> Mensual 
        <input id="gen" type="radio" name="gender" value="female" style="width:15px;height: 15px;color: white"> Anual 
       
                            <span class="text-danger"></span>

<br>
                            <b> Jornada laboral</b>
                           <!-- <input id="login_password" class="form-control" type="password" placeholder="Contraseña" required>-->
                            <input type="text" name="pass" class="form-control" maxlength="30" />
                            <span class="text-danger"></span>

                           
                          </div>
                          <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-block btn-success" name="btn-login">Guardar</button>
                                <button type="submit" class="btn btn-block btn-danger" name="btn-login">Cancelar</button>
                            </div>
                           
                          </div>
                        </form>
                        <!-- End # Login Form -->

                        
                        
                </div>
          </div>
      </div>
  </div>
                <!-- End # DIV Form -->
  
<!--==========================
  Services Section
============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Lista de Ofertas</h3>
          <div class="section-title-divider"></div>
          <p class="section-description"></p>
        </div>
      </div>
<div class="table-responsive">
<table class="table table-hover table-striped">
<tbody>
  <tr class="active">
    <th width="40" >No.</th>
    <th width="200" >Oferta</th>
    <th width="300" >Habilidades</th>
    <th width="200" >Titulación requerida</th>
    <th width="200" >Salario</th>
    <th width="160">Jornada laboral</th>
    <th width="145">Opciones</th>
   
  </tr>
  <td>1</td> <!-- No-->
    <td>Supervisor de instalaciones</td> <!-- Oferta-->
      <td>
        <li type="disc">Asegurar calidad y funcionalidad en trabajos entregados al cliente,</li>
        <li type="disc">Facilidad de palabra (Excelente comunicación Oral y Escrita).</li>
        <li type="disc">Control administrativo de proyectos y tareas asignadas </li>
        <li type="disc">Coordinar en conjunto con los líderes de proyecto la planeación de los proyectos y tareas.</li>
        <li type="disc">Excelente Actitud y presentación.</li>

      </td> <!-- Habilidades Minimas-->
    <td>Licenciatura</td><!-- Titulacion requerida-->
    <td>$17,000 - $19,000 Mensual</td><!-- Titulacion requerida-->
    <td>Horario Flexible</td><!-- Jornada Laboral-->
    <td><a type="submit" href="#"  class="btn btn-info btn-sm btn-block" role="button" data-toggle="modal"  data-target="#login-modal">
     Editar</a>
        <button type="submit"  class="btn btn-danger btn-sm btn-block">Eliminar</button>
    </td>
  </tr>

<td>2</td> <!-- No-->
    <td>SAP Netweaver DB2 Sr.</td> <!-- Oferta-->
      <td>
        <li type="disc">SAP BASIS DB2 EXPERT 4 AÑOS DE EXPERIENCIA EN ADELANTE.</li>
        <li type="disc">SAP NETWEAVER, ERP, DB2</li>
        <li type="disc">Adicional en especializacion DB2 RUNNING ON SAP SYSTEMS</li>





      </td> <!-- Habilidades Minimas-->
    <td>Licenciatura</td><!-- Titulacion requerida-->
    <td>$30,000 - $35,000 Mensual</td><!-- Titulacion requerida-->
    <td>Tiempo Completo</td><!-- Jornada Laboral-->
    <td><a type="submit"  class="btn btn-info btn-sm btn-block" role="button">Editar</a>
        <button type="submit"  class="btn btn-danger btn-sm btn-block">Eliminar</button>
    </td>
  </tr>

  <td>3</td> <!-- No-->
    <td>Administrador de Remedy ITSM</td> <!-- Oferta-->
      <td>
        <li type="disc">Administrador y/o Operador de herramientas Remedy ITSM</li>
        <li type="disc">Administración, Soporte de Herramientas Remedy ITSM</li>
        <li type="disc">Herramienta Remedy ITSM, Sistemas operativos Linux</li>
        <li type="disc">Generación de reportes de la operación</li>
        <li type="disc">Herramienta Remedy ITSM al menos 1 año </li>
   

      </td> <!-- Habilidades Minimas-->
    <td>Carrera técnica, Licenciatura</td><!-- Titulacion requerida-->
    <td>$17,000 - $19,000 Mensual</td><!-- Titulacion requerida-->
    <td>Horario Flexible</td><!-- Jornada Laboral-->
    <td><a type="submit"  class="btn btn-info btn-sm btn-block" role="button">Editar</a>
        <button type="submit"  class="btn btn-danger btn-sm btn-block">Eliminar</button>
    </td>
  </tr>
  <tr>
    <td>4</td> <!-- No-->
    <td>Reclutador de Campo</td> <!-- Oferta-->
      <td>
        <li type="disc">Responsable.</li>
        <li type="disc">Facilidad de palabra (Excelente comunicación Oral y Escrita).</li>
        <li type="disc">Organizado. </li>
        <li type="disc">Puntual.</li>
        <li type="disc">Excelente Actitud y presentación.</li>
      </td> <!-- Habilidades Minimas-->
    <td>Bachillerato terminado</td><!-- Titulacion requerida-->
    <td>$ 4.000,00 (Mensual)</td><!-- Titulacion requerida-->
    <td>Horario Flexible</td><!-- Jornada Laboral-->
    <td><a type="submit"  class="btn btn-info btn-sm btn-block" role="button">Editar</a>
        <button type="submit"  class="btn btn-danger btn-sm btn-block">Eliminar</button>
    </td>
  </tr>
  

  </tbody>
</table>
</div>


 

  
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    
  <!-- Required JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/morphext/morphext.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/stickyjs/sticky.js"></script>
  <script src="lib/easing/easing.js"></script>
  
  <!-- Template Specisifc Custom Javascript File -->
  <script src="js/custom.js"></script>
  
  <script src="contactform/contactform.js"></script>
  
    
</body>
</html>
<?php ob_end_flush(); ?>