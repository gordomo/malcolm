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
$apuntes = getApuntes($mysqli);
?>
<!DOCTYPE html>
<html >
<head>
  <title>APUNTES</title>
  <?php include('includes/headerlinks.html'); ?>
</head>
<body>
  <?php if($logged) { ?>
        <?php include('includes/navbar.php'); ?>
    <section class="mbr-section form1 cid-qMp2Ox8w3Q" id="form1-l">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-5">NUEVO APUNTE</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5"></h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" data-form-type="formoid">
                    <div data-form-alert="" hidden="">
                        Thanks for filling out the form!
                    </div>
            
                    <form class="mbr-form" action="controllers/apuntes_controller.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="nuevoApunte" name="action">
                        <div class="row row-sm-offset">
                            <div class="col-md-4 multi-horizontal" data-for="name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="name-form1-l">Nombre</label>
                                    <input type="text" class="form-control" name="name" data-form-field="Name" required="" id="name-form1-l">
                                </div>
                            </div>
                            <div class="col-md-4 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="email-form1-l">Materia</label>
                                    <select class="form-control" name="materia" required="true" id="materia">
                                        <option value="">Sin Materia</option>
                                        <?php foreach ($materias as $mat) { ?>
                                        <option value="<?=$mat['id']?>"><?=$mat['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 multi-horizontal" data-for="phone">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="phone-form1-l">Año</label>
                                    <select class="form-control" name="anios" required="true" id="anios">
                                        <option value="">Sin Año</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-for="message">
                            <label class="form-control-label mbr-fonts-style display-7" for="message-form1-5m">Apunte .PDF</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" required="true">
                        </div>
                        <span class="input-group-btn"><button href="" type="submit" class="btn btn-primary btn-form display-4">AGREGAR</button></span>
                    </form>
            </div>
        </div>
    </div>
</section>

<section class="table2 section-table cid-qMp3nztUPW" id="table2-m">

    

    
    <div class="container-fluid">
        <div class="media-container-row align-center">
            <div class="col-12 col-md-12">
                <h2 class="mbr-section-title mbr-fonts-style mbr-black display-5">APUNTES</h2>
                <div class="underline align-center pb-3">
                    <div class="line"></div>
                </div>
                
                <div class="table-wrapper pt-5" style="width: 96%;">
                    <div class="container-fluid">
                        <div class="row search">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="dataTables_filter">
                                    <label class="searchInfo mbr-fonts-style display-7">Search:</label>
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
                                    <th class="head-item mbr-fonts-style display-7">AÑO</th>
                                    <th class="head-item mbr-fonts-style display-7">ARCHIVO</th>
                                    <th class="head-item mbr-fonts-style display-7">-</th>
                                    <th class="head-item mbr-fonts-style display-7">-</th>
                                </tr>
                            </thead>

                            <tbody>                                  
                                <?php foreach ($apuntes as $apunte) { ?>
                                <tr>                                 
                                  <td class="body-item mbr-fonts-style display-7">
                                      <input type="text" id="name-edit-<?=$apunte['id']?>"  value="<?=$apunte['name']?>">
                                  </td>
                                  <td class="body-item mbr-fonts-style display-7">
                                    <select id="mat-edit-<?=$apunte['id']?>" class="mat-edit" data-apunte-id="<?=$apunte['id']?>">
                                      <option value="0">Sin materia</option>
                                      <?php foreach ($materias as $mat) { ?>
                                        <option value="<?=$mat['id']?>" <?=($mat['id'] == $apunte['mat_id']) ? 'selected' : ''?>><?=$mat['name']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                  <td class="body-item mbr-fonts-style display-7">
                                    <select id="anio-edit-<?=$apunte['id']?>">
                                      <option value="0">Sin Año</option>
                                      <?php $anio = getAnioFromMat($mysqli, $apunte['mat_id']);
                                        if($anio) {
                                      ?>
                                        <option value="<?=$anio['id']?>" <?=($anio['id'] == $apunte['anio_id']) ? 'selected' : ''?>><?=$anio['name']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                  <td class="body-item mbr-fonts-style display-9" >
                                    <span><?=substr(strrchr($apunte['file'], "/"), 1);?></span>
                                    <input type="file" name="fileToUpload" required="true" id="file-apunte-<?=$apunte['id']?>">
                                  </td>
                                  <td class="body-item mbr-fonts-style display-7">
                                    <a href="" id="<?=$apunte['id']?>" class="btn btn-default editApunte" style="font-size: 25px; margin:0; padding: 0;">
                                        <span class="mbri-edit mbr-iconfont mbr-iconfont-btn" ></span>
                                    </a>
                                  </td>
                                  <td class="body-item mbr-fonts-style display-7">
                                    <a class="btn btn-default" href="controllers/apuntes_controller.php?action=borrarApunte&id=<?=$apunte['id']?>" style="font-size: 25px; margin:0; padding: 0;">
                                        <span class="mbri-close mbr-iconfont mbr-iconfont-btn" ></span>
                                    </a>
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
    
    $(".editApunte").click(function(){
        
        var id = $(this).attr("id");                  
        var name = $("#name-edit-"+id).val();
        var mat_id = $("#mat-edit-"+id).val();
        var mat_name = $("#mat-edit-"+ id + " option:selected").text();
        var anio_id = $("#anio-edit-"+id).val();
        var anio_name = $("#anio-edit-"+ id + " option:selected").text();
        var file_data = $("#file-apunte-"+id).prop("files")[0]; // Getting the properties of file from file field

        var form_data = new FormData(); // Creating object of FormData class
        form_data.append("action", "editarApunte") // Adding extra parameters to form_data
        form_data.append("id", id) // Adding extra parameters to form_data
        form_data.append("name", name) // Adding extra parameters to form_data
        form_data.append("mat_id", mat_id) // Adding extra parameters to form_data
        form_data.append("anio_id", anio_id) // Adding extra parameters to form_data           
        form_data.append("mat_name", mat_name) // Adding extra parameters to form_data
        form_data.append("anio_name", anio_name) // Adding extra parameters to form_data
        form_data.append("file", file_data) // Appending parameter named file w

        $.ajax({
            url: "controllers/apuntes_controller.php", // Upload Script
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post',
            dataType: "json",
            success: function(data) {
              location.href = "apuntes.php?status=" + data.status + "/#table1-63";
              location.reload();
            }
          });
 
    });         
      
    $("#materia").change(function(){
        $.ajax({
          method: "POST",
          url: "controllers/apuntes_controller.php",
          data: { idMat: $(this).val(), action: "getAnioFromMat" },
          dataType: "json"
        })
        .done(function( msg ) {
            $('#anios').html('<option value="">Sin Año</option>')
            $(msg).each(function(){
                $('#anios').append('<option value="'+this.id+'">'+this.name+'</option>');
            });
        });
    });
    
    $(".mat-edit").change(function(){
        var apunteId = $(this).data("apunte-id");
        
        $.ajax({
          method: "POST",
          url: "controllers/apuntes_controller.php",
          data: { idMat: $(this).val(), action: "getAnioFromMat" },
          dataType: "json"
        })
        .done(function( msg ) {
            $('#anio-edit-'+apunteId).html('<option value="">Sin Año</option>')
            $(msg).each(function(){
                $('#anio-edit-'+apunteId).append('<option value="'+this.id+'">'+this.name+'</option>');
            });
        });
    });
</script>  
  
</body>
</html>