<?php
include_once 'includes/db_connect.php';
include_once 'includes/funciones.php';

sec_session_start();
$logged = false;
$user = '';
if (login_check($mysqli) == true) {
  $logged = true;
  $user = $_SESSION['user'];
}

$state = 0;

if (isset($_SESSION['state'])) {
  $state = $_SESSION['state'];
  unset($_SESSION['state']);
}

$mensaje = '';

// if(isset($_SESSION['message'])) die(var_dump($_SESSION['message']));

$mensaje = getMensaje($state, $user);
// die(var_dump($mensaje));

?>

<!DOCTYPE html>
<html >
<head>

  <?php include("includes/headerlinks.html"); ?>
  
  
</head>
<body>
  <?php include("includes/navbar.php"); ?>

<section class="cid-qLmxJD3etN mbr-fullscreen mbr-parallax-background" id="header2-4" style="margin-top:15px">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><?=$mensaje?></h1>
                <p class="mbr-text pb-3 mbr-fonts-style display-5">Espacio Malcolm</p>
                <p class="mbr-text pb-3 mbr-fonts-style display-5">"Un espacio para que busques tus apuntes"</p>
                <?php if(!$logged) { ?>
                    <div class="mbr-section-btn"><a class="registrarme btn btn-md btn-primary display-4" href="#">REGISTRARME</a></div>
                <?php } ?>    
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="mbri-down mbr-iconfont"></i>
        </a>
    </div>
</section>

<section class="counters1 counters cid-qLmA8NCKiH" id="counters1-5">





    <div class="container">
        <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-5">¿COMO FUNCIONA?</h2>
        <h3 class="mbr-section-subtitle mbr-fonts-style display-7"></h3>

        <div class="container pt-4 mt-2">
            <div class="media-container-row">
                <div class="card p-3 align-center col-12 col-md-6 col-lg-4">
                    <div class="panel-item p-3">
                        <div class="card-img pb-3">
                            <span class="mbr-iconfont mbri-user" style="color: rgb(35, 35, 35);"></span>
                        </div>

                        <div class="card-text">
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Primer Paso</h4>
                            <p class="mbr-content-text mbr-fonts-style display-7">Registrate</p>
                        </div>
                    </div>
                </div>


                <div class="card p-3 align-center col-12 col-md-6 col-lg-4">
                    <div class="panel-item p-3">
                        <div class="card-img pb-3">
                            <span class="mbr-iconfont mbri-credit-card" style="color: rgb(35, 35, 35);"></span>
                        </div>
                        <div class="card-text">
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Segundo Paso</h4>
                            <p class="mbr-content-text mbr-fonts-style display-7">Selecciona tu Materia</p>
                        </div>
                    </div>
                </div>

                <div class="card p-3 align-center col-12 col-md-6 col-lg-4">
                    <div class="panel-item p-3">
                        <div class="card-img pb-3">
                            <span class="mbr-iconfont mbri-cursor-click" style="color: rgb(35, 35, 35);"></span>
                        </div>
                        <div class="card-text">
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Tercer Paso</h4>
                            <p class="mbr-content-text mbr-fonts-style display-7">
                            Selecciona y descarga el apunte</p>
                        </div>
                    </div>
                </div>


                
            </div>
        </div>
    </div>
</section>

<section class="mbr-section form1 cid-qLsCZQoouT" id="form1-s">




    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-5">PARA CONTACTARNOS</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-7">
                SI TENÉS ALGUNA DUDA O CONSULTA COMUNICATE CON NOSOTROS</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" data-form-type="formoid">
            <div class="result alert ">

            </div>
            
            <div class="row row-sm-offset">
              <div class="col-md-4 multi-horizontal" data-for="name">
                <div class="form-group">
                  <label class="form-control-label mbr-fonts-style display-7" for="name-form1-4g">Nombre</label>
                  <input type="text" class="form-control" name="name" data-form-field="Name" required="" id="nombre">
                </div>
              </div>
              <div class="col-md-4 multi-horizontal" data-for="emailContacto">
                <div class="form-group">
                  <label class="form-control-label mbr-fonts-style display-7" for="email-form1-4g">Email</label>
                  <input type="email" class="form-control" name="emailContacto" data-form-field="emailContacto" required="" id="emailContacto">
                </div>
              </div>
              <div class="col-md-4 multi-horizontal" data-for="phone">
                <div class="form-group">
                  <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-4g">Telefono</label>
                  <input type="tel" class="form-control" name="phone" data-form-field="Phone" id="phone">
                </div>
              </div>
            </div>
            <div class="form-group" data-for="message">
              <label class="form-control-label mbr-fonts-style display-7" for="message-form1-4g">Mensaje</label>
              <textarea type="text" class="form-control" name="message" rows="7" data-form-field="Message" id="message"></textarea>
            </div>
            
            <span class="input-group-btn">
              <button id="enviar" class="btn btn-form btn-black display-4">ENVIAR</button>
            </span>
          </div>
        </div>
    </div>
</section>

<?php include("includes/footer.html") ?>


</body>
</html>