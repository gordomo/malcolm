<?php
include_once '../includes/db_connect.php';
include_once '../includes/funciones.php';

sec_session_start();
$logged = false;
$user = '';
if (login_check($mysqli) == true && $_SESSION['grup'] == 1) {
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
    <?php include('includes/headerlinks.html'); ?>
    <title>Home</title>
</head>
<body>
<?php include('includes/navbar.php'); ?>

<?php if(!$logged) { ?>
    <section class="mbr-section content5 cid-qLmTN2VO6H mbr-parallax-background" id="content5-0">
        <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);"></div>

        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 col-md-8">
                    <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-5">
                        <br><br>ERROR DE LOGUEO, USUARIO/PASS INCORRECTO O NO TIENE PERMISOS</h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5"></h3>
                </div>
            </div>
        </div>
    </section>
<?php } else { ?>
<section class="mbr-section content5 cid-qLmTN2VO6H mbr-parallax-background" id="content5-0">
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);"></div>

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-5">
                    <br><br>PANEL DE ADMINISTRACIÓN</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5"></h3>
            </div>
        </div>
    </div>
</section>

<section class="features1 cid-qLmTNE6ulW" id="features1-1">

    <div class="container">
        <div class="media-container-row">

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-img pb-3">
                    <a href="page5.html"><span class="mbr-iconfont mbri-pages" style="color: rgb(0, 0, 0);"></span></a>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-5">Apuntes</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-img pb-3">
                    <a href="usuario.php"><span class="mbr-iconfont mbri-user" style="color: rgb(0, 0, 0);"></span></a>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-5">Usuarios</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-img pb-3">
                    <a href="materias.php"><span class="mbr-iconfont mbri-bulleted-list" style="color: rgb(35, 35, 35);"></span></a>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-5">
                        Materias</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
            </div>

            

        </div>

    </div>

</section>

<section class="features1 cid-qLmTNTL7Lg" id="features1-2">
    
    <div class="container">
        <div class="media-container-row">

            <div class="card p-3 col-12 col-md-6">
                <div class="card-img pb-3">
                    <a href="anios.php"><span class="mbr-iconfont mbri-bootstrap" style="color: rgb(35, 35, 35);"></span></a>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-5">Años</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6">
                <div class="card-img pb-3">
                    <a href="page8.html"><span class="mbr-iconfont mbri-opened-folder" style="color: rgb(35, 35, 35);"></span></a>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-5">Sub Sub Categorías</h4>
                    <p class="mbr-text mbr-fonts-style display-7"></p>
                </div>
            </div>
        </div>

    </div>

</section>
<?php } ?>

<?php include('includes/footer.html'); ?>
  
</body>
</html>