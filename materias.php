<?php
include_once 'includes/db_connect.php';
include_once 'includes/funciones.php';

sec_session_start();
$logged = false;
$user = '';
if (login_check($mysqli) == true) {
  $logged = true;
  $user = $_SESSION['user'];
  $materiasJson = isset($_SESSION['materias']) ? $_SESSION['materias'] : 0;
}

// die(var_dump($_SESSION));

$materias = getMateriasDelUsuario($mysqli, $materiasJson);


?>

<!DOCTYPE html>
<head>

  <?php include("includes/headerlinks.html"); ?>
  
  
</head>
<body>
  <?php include("includes/navbar.php"); ?>

  <section class="mbr-section content5 cid-qLmCTrxKoK mbr-parallax-background" id="content5-9">



    <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(35, 35, 35);">
    </div>

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-2">
                    <br>APUNTES</h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5">Selecciona el apunte que necesites</h3>


                </div>
            </div>
        </div>
    </section>

    <section class="cid-qLmDL3yygN" id="pricing-tables1-a">
        <div class="container">
            <div class="media-container-row">
                <?php 
                if($materias) {
                    foreach ($materias as $materia) { ?>
                        <div class="plan col-3 justify-content-center " style="margin: 2px">
                            <div class="plan-header text-center" style="padding: 1rem 0 0 0;">
                                <h3 class="plan-title mbr-fonts-style display-7">
                                    <?=$materia['name']?><br><br></h3>
                                    <div class="plan-price">
                                        <span class="price-value mbr-fonts-style display-5"></span>
                                        <span class="price-figure mbr-fonts-style display-1"></span>
                                        <small class="price-term mbr-fonts-style display-7"></small>
                                    </div>
                                </div>
                                <div class="plan-body" style="padding-bottom: 1rem;">
                                    <div class="plan-list align-center">
                                        <ul class="list-group list-group-flush mbr-fonts-style display-7"></ul>
                                    </div>
                                    <div class="mbr-section-btn text-center pt-4">
                                        <a href="apuntes.php?id=<?=$materia['id']?>" class="btn btn-black display-4">Ver</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    <?php } else { ?>
                        <h3 style="text-align: center; color: #fff; background: #5a5b5a;">No tiene materias asignadas. Pongase en contacto con el administrador </h3>
                    <?php } ?>
                </div>
            </div>

        </section>
        <?php include("includes/footer.html") ?>

    </body>
    </html>