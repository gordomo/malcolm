<?php
include_once 'includes/db_connect.php';
include_once 'includes/funciones.php';

sec_session_start();
$logged = false;
$user = '';
$id = 0;
if (login_check($mysqli) == true) {
  $logged = true;
  $user = $_SESSION['user'];
  $materiasUser = $_SESSION['materias'];
  $id = isset($_GET['id']) ? $_GET['id'] : 'noId';
  
  if(array_search($id, $materiasUser) === false) {
    header('Location: index.php'); 
  }
}


$materia = getMateria($mysqli, $id);
$anios = getAniosFromMat($mysqli, $id);

?>

<!DOCTYPE html>
<head>

  <?php include("includes/headerlinks.html"); ?>
  
  
</head>
<body>
  <?php include("includes/navbar.php"); ?><section class="mbr-section content5 cid-qLDDOMy31V mbr-parallax-background" id="content5-w">



    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(35, 35, 35);">
    </div>

    <div class="container">
      <div class="media-container-row">
        <div class="title col-12 col-md-8">
          <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-2">
            <br><?=$materia['name']?>
          </h2>
        </div>
      </div>
    </div>
  </section>

  <section class="mbr-gallery mbr-slider-carousel cid-qLDEtY4YE1" id="gallery2-x">



    <div class="container">
      <div>
        <!-- Filter -->
        <div class="mbr-gallery-filter container gallery-filter-active">
          <ul buttons="0">
            <li class="mbr-gallery-filter-all">
              <a class="btn btn-md btn-primary-outline active display-7" href="">TODOS</a>
            </li>
          </ul>
        </div>

        <!-- Gallery -->
        <div class="mbr-gallery-row">
          <div class="mbr-gallery-layout-default">
            <div>
              <div>
                <?php if($anios) {
                foreach ($anios as $anio) { 

                  $apunte = getApuntesFromAnioMateria($mysqli,$anio['id'], $id);
                  
                  if($apunte) {
                  ?>

                    <a href="gestor/<?=str_replace('../', '', $apunte['file'])?>" target="_BLANCK">
                      <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="<?=$anio['name']?>">
                        <div href="#lb-gallery2-x" data-slide-to="0" data-toggle="modal">
                          <img src="assets/images/apunte-1-455x146-455x146.png" alt="">
                          
                            <span class="icon-focus"></span>
                          
                          <span class="mbr-gallery-title mbr-fonts-style display-7"><?=$apunte['name']?></span>
                        </div>
                      </div>
                    </a>  
                <?php }
                  }
                }  else {
                  echo "No existen apuntes para esta materia";
                }
              ?>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        
      </div>
    </div>

  </section>

  <?php include("includes/footer.html") ?>


</body>
</html>