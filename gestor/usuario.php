<?php
include_once '../includes/db_connect.php';
include_once '../includes/funciones.php';
session_set_cookie_params(0);
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

$usuarios = getUsuariosNoAdmin($mysqli);
$materias = getMaterias($mysqli);

?>
<!DOCTYPE html>
<html >
<head>
  <title>Usuarios</title>
  <?php include_once("includes/headerlinks.html"); ?>
</head>
<body>
    <?php if($logged) { ?>
    <?php include_once("includes/navbar.php"); ?>

    <section class="table2 section-table cid-qMp0MbzhHl" id="table2-j">
    
    <div class="container-fluid">
        <div class="media-container-row align-center">
            <div class="col-12 col-md-12">
                <h2 class="mbr-section-title mbr-fonts-style mbr-black display-5">USUARIOS&nbsp;</h2>
                <div class="underline align-center pb-3">
                    <div class="line"></div>
                </div>
                
                <div class="table-wrapper pt-5" style="width: 99%;">
                    <div class="container-fluid">
                        <div class="row search">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="dataTables_filter">
                                    <label class="searchInfo mbr-fonts-style display-7">Buscar</label>
                                    <input class="form-control input-sm search" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid scroll">
                        <table class="table table-striped isSearch" cellspacing="0">
                            <thead>
                                <tr class="table-heads">
                                    <th class="head-item mbr-fonts-style display-7">NOMBRE</th>
                                    <th class="head-item mbr-fonts-style display-7">EMAIL</th>
                                    <th class="head-item mbr-fonts-style display-7">CONFIRMACIÓN</th>
                                    <th class="head-item mbr-fonts-style display-7">MATERIA</th>                                   
                                    <th class="head-item mbr-fonts-style display-7">-</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($usuarios as $usuario) { ?>
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7"><?= $usuario['nombre'] ?></td>
                                    <td class="body-item mbr-fonts-style display-7"><?= $usuario['email'] ?></td>
                                    <td class="body-item mbr-fonts-style display-7"><?php $valid = ($usuario['valid']) ?  "SI" : "NO"; echo $valid;  ?></td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <?php $materiasUser = json_decode($usuario['materias']);
                                        if(!empty($materiasUser)) {
                                            $i = 0;
                                            foreach ($materias as $mat) { 
                                                if(in_array($mat['id'], $materiasUser)) {
                                                    if($i > 0 && $i != count($materiasUser) + 1 ) echo "- ";
                                                    echo $mat['name']; 
                                                    $i ++;
                                                }
                                            ?>
                                            
                                        <?php } }else{ echo 'Ninguna';} ?>
                                    </td>                                   
                                    <td class="body-item mbr-fonts-style display-7">
                                        <a href="asignar_materias.php?id=<?=$usuario['id']?>"><button class="btn btn-default">Asignar Materias</button></a>
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
                            <span class="infoFilteredBefore">(filtradas de un total de:</span>
                            <span class="inactive infoRows"></span>
                            <span class="infoFilteredAfter">)</span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } else { ?>
    No se ha iniciado sesion
    <?php } ?>
<?php include_once("includes/footer.html") ?>
   
</body>
</html>