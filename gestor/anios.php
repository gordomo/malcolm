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
$mensaje = getMensaje($state, $user);

$materias = getMaterias($mysqli);
$anios    = getAnios($mysqli);

?>
<!DOCTYPE html>
<html >
<head>
  <title>Años</title>
  <?php include('includes/headerlinks.html'); ?>  
</head>
<body>
  <?php if($logged) { ?>
        <?php include('includes/navbar.php'); ?>

<section class="mbr-section form1 cid-qMp4QNo9gG" id="form1-q">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-5">AGREGAR AÑO</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5"></h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" data-form-type="formoid">
                    <div data-form-alert="" hidden="">Thanks for filling out the form!</div>
            
                    <form class="mbr-form" action="controllers/materias_controller.php" method="post">
                        <input type="hidden" name="action" value="nuevoAnio">
                        <div class="row row-sm-offset">
                            <div class="col-md-4 multi-horizontal" data-for="name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="name-form1-q">Nombre</label>
                                    <input type="text" class="form-control" name="name" data-form-field="Name" required="" id="name-form1-q">
                                </div>
                            </div>
                            <div class="col-md-4 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="email-form1-q">Materia</label>
                                    <select class="form-control" name="matId" required id="matId">
                                    <?php foreach ($materias as $mat) { ?>
                                    <option value="<?=$mat['id']?>"><?=$mat['name']?></option>
                                    <?php } ?>
                                  </select>
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

<section class="table2 section-table cid-qMp578rsCo" id="table2-r">

    <div class="container-fluid">
        <div class="media-container-row align-center">
            <div class="col-12 col-md-12">
                <h2 class="mbr-section-title mbr-fonts-style mbr-black display-5">AÑOS</h2>
                <div class="underline align-center pb-3">
                    <div class="line"></div>
                </div>
                
                <div class="table-wrapper pt-5" style="width: 97%;">
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
                                    <th class="head-item mbr-fonts-style display-7">NOMBRE</th>
                                    <th class="head-item mbr-fonts-style display-7">MATERIA</th>
                                    <th class="head-item mbr-fonts-style display-5">-</th>
                                    <th class="head-item mbr-fonts-style display-5">-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($anios as $anio) {?>
                                        <tr>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <input type="text" id="<?=$anio['id']?>" value="<?=$anio['name']?>">
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <select id="mat-edit-<?=$anio['id']?>">
                                                  <option>sin categoria</option>
                                                  <?php foreach ($materias as $mat) { ?>
                                                    <option value="<?=$mat['id']?>" <?=($mat['id'] == $anio['mat_id']) ? 'selected' : ''?>><?=$mat['name']?></option>
                                                  <?php } ?>
                                                </select>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <button onclick="javascript:sendToEdit(<?=$anio['id']?>);" class="btn btn-default">editar</button>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7">
                                                <a class="btn btn-default" href="controllers/materias_controller.php?action=borrarAnio&id=<?=$anio['id']?>">borrar</a>
                                            </td>
                                        </tr>
                                <?php } ?>  
                           </tbody>
                        </table>
                    </div>
                    <div class="container-fluid table-info-container">
                        <div class="row info mbr-fonts-style display-7">
                            <div class="dataTables_info">
                                <span class="infoBefore">Mostrando</span>
                                <span class="inactive infoRows"></span>
                                <span class="infoAfter">registros</span>
                                <span class="infoFilteredBefore">(filtrados de</span>
                                <span class="inactive infoRows"></span>
                                <span class="infoFilteredAfter"> totales)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php } else { ?>
    No se ha iniciado Sección
    <?php } ?> 
<?php include('includes/footer.html'); ?>
    
<script>
      function sendToEdit(id) {
          location.href= "controllers/materias_controller.php?action=editarAnio&val=" + $('#'+id).val() + "&matId=" + $('#mat-edit-'+id).val() + "&id="+id;
      }
</script>    

</body>
</html>