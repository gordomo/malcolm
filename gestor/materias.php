<?php
include_once '../includes/db_connect.php';
include_once '../includes/funciones.php';

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
$materias = getMaterias($mysqli);

?>

<!DOCTYPE html>
<html >
<head>
  <title>MATERIAS</title>
  <?php include('includes/headerlinks.html'); ?>
  
  
  
</head>
<body>
    <?php if($logged) { ?>
        <?php include('includes/navbar.php'); ?>

    <section class="mbr-section form1 cid-qMp1PBz299" id="form1-k">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-5">
                        AGREGAR MATERIA</h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5"></h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8">
                        <form class="mbr-form" action="controllers/materias_controller.php" method="post">
                        <input type="hidden" name="action" value="nuevaMateria">
                            <div class="row row-sm-offset">
                                <div class="col-md-4 multi-horizontal" data-for="name">
                                    <div class="form-group">
                                        <label class="form-control-label mbr-fonts-style display-7" >NOMBRE</label>
                                        <input type="text" class="form-control" name="name" required="true">
                                    </div>
                                </div>
                            </div>
                            <span class="input-group-btn">
                                <button href="" type="submit" class="btn btn-primary btn-form display-4">AGREGAR</button>
                            </span>
                        </form>
                </div>
            </div>
        </div>
    </section>

    <section class="table2 section-table cid-qMpgoW3FeW" id="table2-w">

        

        
        <div class="container-fluid">
            <div class="media-container-row align-center">
                <div class="col-12 col-md-12">
                    <h2 class="mbr-section-title mbr-fonts-style mbr-black display-5">MATERIAS</h2>
                    <div class="underline align-center pb-3">
                        <div class="line"></div>
                    </div>
                    
                    <div class="table-wrapper pt-5" style="width: 88%;">
                        <div class="container-fluid">
                            <div class="row search">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="dataTables_filter">
                                        <label class="searchInfo mbr-fonts-style display-7">BUSCAR</label>
                                        <input class="form-control input-sm" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid scroll">
                            <table class="table table-striped isSearch" cellspacing="0">
                                <thead>
                                    <tr class="table-heads">
                                        <th class="head-item mbr-fonts-style display-4">NOMBRE</th>
                                        <th class="head-item mbr-fonts-style display-4"></th>
                                        <th class="head-item mbr-fonts-style display-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($materias as $materia) {?>
                                        <tr>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <input type="text" id="<?=$materia['id']?>" value="<?=$materia['name']?>">
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <button onclick="javascript:sendToEdit(<?=$materia['id']?>);" class="btn btn-default">editar</button>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <a class="btn btn-default" href="controllers/materias_controller.php?action=borrarMateria&id=<?=$materia['id']?>">borrar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        </div>
                        <div class="container-fluid table-info-container">
                            <div class="row info mbr-fonts-style display-7">
                                <div class="dataTables_info"><br></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } else { ?>
    fuck off
    <?php } ?> 
<?php include('includes/footer.html'); ?>
  
  <script>
      function sendToEdit(id) {
          location.href= "controllers/materias_controller.php?action=editarMateria&val=" + $('#'+id).val() + "&id="+id;
      }
  </script>
  
</body>
</html>