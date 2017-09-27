<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';
  
  // it will never let you open index(login) page if session is set
  if ( isset($_SESSION['user'])!="" ) {
    header("Location: home.php");
    exit;
  }
  
  $error = false;
  
  if( isset($_POST['btn-login']) ) {  
    
    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs
    
    if(empty($email)){
      $error = true;
      $emailError = "Por favor, ingresa tu Email";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Por favor ingresa una cuenta de Email Valida.";
    }
    
    if(empty($pass)){
      $error = true;
      $passError = "Por favor ingresa tu contraseña";
    }
    
    // if there's no error, continue to login
    if (!$error) {
      
      $password = hash('sha256', $pass); // password hashing using SHA256
    
      $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
      $row=mysql_fetch_array($res);
      $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
      
      if( $count == 1 && $row['userPass']==$password ) {
        $_SESSION['user'] = $row['userId'];
        header("Location: home.php");
      } else {
        $errMSG = "Datos incorrectos, Intenta otra vez...";
      }
        
    }
    
  }
?>
<?php
  ob_start();
  session_start();
  if( isset($_SESSION['user'])!="" ){
    header("Location: home.php");
  }
  include_once 'dbconnect.php';

  $error = false;

  if ( isset($_POST['btn-signup']) ) {
    
    // clean user inputs to prevent sql injections
    $name = trim($_POST['name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);
    
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    
    // basic name validation
    if (empty($name)) {
      $error = true;
      $nameError = "Please enter your full name.";
    } else if (strlen($name) < 3) {
      $error = true;
      $nameError = "Name must have atleat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
      $error = true;
      $nameError = "Name must contain alphabets and space.";
    }
    
    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Please enter valid email address.";
    } else {
      // check email exist or not
      $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
      $result = mysql_query($query);
      $count = mysql_num_rows($result);
      if($count!=0){
        $error = true;
        $emailError = "Provided Email is already in use.";
      }
    }
    // password validation
    if (empty($pass)){
      $error = true;
      $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
      $error = true;
      $passError = "Password must have atleast 6 characters.";
    }
    
    // password encrypt using SHA256();
    $password = hash('sha256', $pass);
    
    // if there's no error, continue to signup
    if( !$error ) {
      
      $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
      $res = mysql_query($query);
        
      if ($res) {
        $errTyp = "success";
        $errMSG = "Successfully registered, you may login now";
        unset($name);
        unset($email);
        unset($pass);
      } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later..."; 
      } 
        
    }
    
    
  }
?>
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
     
        <li><a href="#" role="button" data-toggle="modal" data-target="#login-empresa">Soy Empresa</a></li>
        <li><a href="#" role="button" data-toggle="modal" data-target="#register-modal">Registrarme</a></li>
        <li><a href="#" role="button" data-toggle="modal" data-target="#login-modal" class="btn-get-started">Iniciar Sesión</a></li>
        
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
              <img  id="img_logo" src="img/logo.png">
           </div>
                <!-- iNICIO DE FORMULARIO -->
                <div id="div-forms">
                 <?php
                  if ( isset($errMSG) ) {
                    
                    ?>
                    <div class="form-group">
                          <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                            </div>
                          </div>
                            <?php
                  }
                ?>
                        <!-- Begin # Login Form -->
                        <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
                          <div class="modal-body">
                            
                              Email o usuario:
                             <!--<input id="login_username" class="form-control" type="text" placeholder="Usuario" required>-->
                              <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" maxlength="40" />
                              <span class="text-danger"><?php echo $emailError; ?></span>

                            Contraseña:
                           <!-- <input id="login_password" class="form-control" type="password" placeholder="Contraseña" required>-->
                            <input type="password" name="pass" class="form-control" placeholder="Contraseña" maxlength="15" />
                            <span class="text-danger"><?php echo $passError; ?></span>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Recordar
                                </label>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary" name="btn-login">Ingresar</button>
                            </div>
                             <div>
                                <button id="login_lost_btn" type="button" class="btn btn-link">¿Has olvidado tu contraseña?
                                </button>
                                <button id="login_register_btn" type="button" class="btn btn-link">Registrar</button>
                            </div>
                          </div>
                        </form>
                        <!-- End # Login Form -->
                        
                        <!-- Begin | Olvidar contraseña Form -->
                        <form id="lost-form" style="display:none;">
                            <div class="modal-body">
                              Email:
                              <input id="lost_email" class="form-control" type="text" placeholder="Email" required>
                            </div>
                          <div class="modal-footer">
                                      <div>
                                          <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
                                      </div>
                                      <div>
                                          <button id="lost_login_btn" type="button" class="btn btn-link">Ingresar</button>
                                          <button id="lost_register_btn" type="button" class="btn btn-link">Registrar</button>
                                      </div>
                          </div>
                        </form>
                        <!-- End | Lost Password Form -->
                        <!-- Begin | Register Form -->
                        <form id="register-form" style="display:none;">
                          <div class="modal-body">
                                Nombre:
                                <input id="register_name" class="form-control" type="text"  required>
                                Email
                                <input id="register_email" class="form-control" type="text"  required>
                                Telefono fijo:
                                <input id="register_telFijo" class="form-control" type="text"  required>
                                Telefono Movil
                                <input id="register_telMovil" class="form-control" type="text"  required>
                                Usuario:
                                <input id="register_user" class="form-control" type="text"required>
                                Contraseña:
                                <input id="register_telFijo" class="form-control" type="password" required>
                          </div>
                        <div class="modal-footer">
                              <div>
                                  <button type="submit" class="btn btn-primary btn-lg btn-block">Registrar</button>
                              </div>
                        </div>
                        </form>
                        <!-- End | Register Form -->   
                </div>
          </div>
      </div>
  </div>
                <!-- End # DIV Form -->


<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header" align="center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </button>
              <img  id="img_logo" src="img/logo.png">
           </div>
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                        <!-- Begin | Register Form -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                        <?php
      if ( isset($errMSG) ) {
        
        ?>
        <div class="form-group">
              <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
              </div>
                <?php
      }
      ?>
                          <div class="modal-body">
                                Nombre:
                                <input type="text" name="name" class="form-control" placeholder="Ingresa tu nombre" maxlength="50" value="<?php echo $name ?>" required/>
                                <span class="text-danger"><?php echo $nameError; ?></span>
                                Email
                               <input type="email" name="email" class="form-control" placeholder="Ingresa tu Email" maxlength="40" value="<?php echo $email ?>" required/>
                                <span class="text-danger"><?php echo $emailError; ?></span>
                                Telefono fijo:
                                <input id="register_telFijo" class="form-control" type="text"  >
                                Telefono Movil
                                <input id="register_telMovil" class="form-control" type="text"  >
                                Usuario:
                                <input id="register_user" class="form-control" type="text">
                                Contraseña:
                                <input type="password" name="pass" class="form-control" placeholder="Ingresa tu contraseña" maxlength="15" required />
                                <span class="text-danger"><?php echo $passError; ?></span>
                          </div>
                        <div class="modal-footer">
                              <div>

                                  <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Registrar</button>
                                  <button type="submit" class="btn btn-default btn-md btn-block">Cancelar</button>
                              </div>
                        </div>
                        </form>
                        <!-- End | Register Form -->
                    
                </div>
          </div>
      </div>
  </div>

<!--==========================
  Hero Section
============================-->
  <section id="hero">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          <img class="" src="img/logo.png" alt="Imperial">
        </div>
        
        <h1>Estamos para ayudarte</h1>
        <h2>Encuentra <span class="rotating">el trabajo de tus sueños., un excelente futuro., el trabajo a tu medida.,lo que siempre buscaste., la oferta de trabajo ideal para  ti.</span></h2>
       <!-- <div class="actions">
          <a href="#about" class="btn-get-started">Iniciar Sesión</a>
          <a href="#services" class="btn-services">Registrarse</a>
        </div>-->
      </div>
    </div>
  </section>

  
<!--==========================
  Services Section
============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Nuestros servicios</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium</p>
        </div>
      </div>
        
      <div class="row">
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-users"></i></div>
          <h4 class="service-title"><a href="">La persona indicada para sus empleos</a></h4>
          <p class="service-description">200 millones de personas visitan Encuentra.lo cada mes, dándole acceso al mayor talento en cada campo.</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-laptop"></i></div>
          <h4 class="service-title"><a href="">En computadora y celular</a></h4>
          <p class="service-description">El 60% de las búsquedas de empleo se realizan a través de dispositivos móviles. Publique sus empleos en Encuentra.lo para recibir postulaciones desde cualquier dispositivo.</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-building "></i></div>
          <h4 class="service-title"><a href="">Más contrataciones de calidad</a></h4>
          <p class="service-description">Encuentra.lo es la primera fuente de contratación para miles de empresas. </p>
        </div>
    
      </div>
    </div>  
  </section>
  

  <section id="subscribe">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-8">
          <h3 class="subscribe-title">¿Listo para probar Encuentra.lo?</h3>
          <p class="subscribe-text">Join our 1000+ subscribers and get access to the latest tools, freebies, product announcements and much more!</p>
        </div>
        <div class="col-md-4 subscribe-btn-container">
          <a class="subscribe-btn" href="#">Enviar Curriculum</a>
        </div>
      </div>
    </div>
  </section>
 
<!--==========================
  Footer
============================--> 

  <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="copyright">
              &copy; Copyright 2017 <strong>Encuentra.lo</strong>. All Rights Reserved
            </div>
            <div class="credits"> 
              <a href="#"> Terminos y condiciones ·</a>
              <a href="#"> Politicas de Privacidad ·</a>
              <a href="#"> Protección de datos personales ·</a>
              <a href="#"> Noticias</a>
            </div>
          </div>
        </div>
      </div>
  </footer><!-- #footer -->
  
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