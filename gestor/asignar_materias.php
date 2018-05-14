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

$id = (isset($_GET['id'])) ? $_GET['id'] : 'no-id';

if (is_numeric($id)) {  
    $usuario = getUsuario($mysqli,$id);
    $materias = getMaterias($mysqli);
    
    $materiasUser = json_decode($usuario['materias']);
} else {
  header('Location: usuario.php'); 
} 

?>
<!DOCTYPE html>
<html >
<head>
  <title>Asignar Materias</title>
  <?php include_once("includes/headerlinks.html"); ?>
</head>
<body>
    <?php if($logged) { ?>
    <?php include_once("includes/navbar.php"); ?>

    <section class="table2 section-table cid-qMp0MbzhHl" id="table2-j">
    
    <div class="container-fluid">
        <div class="media-container-row align-center">
            <div class="col-12 col-md-12">
                <h2 class="mbr-section-title mbr-fonts-style mbr-black display-5">ASIGNAR MATERIAS&nbsp;</h2>
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
                                    <th class="head-item mbr-fonts-style display-7">MATERIAS ASIGNADAS</th>
                                    <th class="head-item mbr-fonts-style display-7">MATERIAS</th>
                                    <th class="head-item mbr-fonts-style display-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="body-item mbr-fonts-style display-7"><?= $usuario['nombre'] ?></td>
                                    <td class="body-item mbr-fonts-style display-7" id="materias-asignadas">
                                        <?php if(!empty($materiasUser)){ foreach ($materias as $mat) { ?>
                                            <?php foreach($materiasUser as $matUser) { ?>
                                                   <?php if($mat['id'] == $matUser) { ?>
                                                         <button class="btn btn-primary delete-materia" value="<?=$mat['id']?>"><?= $mat['name']?><span class="mbr-iconfont mbri-close" style="color: red;"></span></button>    
                                                   <?php } ?>
                                            <?php }  ?>
                                        <?php } }else{ echo 'Ninguna';} ?>
                                    </td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <select multiple class="form-control" name="materia" required="true" id="materia">
                                        <?php foreach ($materias as $mat) { ?>
                                        <option value="<?=$mat['id']?>"><?=$mat['name']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                    <td class="body-item mbr-fonts-style display-7">
                                        <button class="btn btn-primary btn-form display-4 add-materia" id="<?= $id ?>"><span class="mbr-iconfont mbri-plus"></span></button>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                        <a href="usuario.php"><button class="btn btn-default">Volver a Usuarios</button></a>
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
    
<script>
        
    $(".add-materia").click(function(){
        
        var idmat = $('#materia').val();
        var iduser = $(".add-materia").attr('id');
        var materias = [];
        
        $("#materia option").each(function(){     
           materias.push(  $(this).val()+'-'+$(this).text());     
        });
      
        $.ajax({
          method: "POST",
          url: "controllers/usuarios_controller.php",
          data: { idMat: idmat, idUser: iduser, action: "asignarMateria" },
          dataType: "json"
        })
        .done(function( msg ) { 
            $('#materias-asignadas').html('');
            $(materias).each(function(index, value){   
                var materia = value.split('-');   
                $(msg).each(function(index2 , value2){     
                    if(materia[0] == value2){    
                        $('#materias-asignadas').append('<button class="btn btn-primary delete-materia" value="'+value2+'">'+ materia[1] +'<span class="mbr-iconfont mbri-close" style="color: red;"></span></button>');
                    }
                });
            });
        });
    });
    
    $("#materias-asignadas").on("click",".delete-materia", function(){
    
        var idmat = $(this).val();
        var iduser = $(".add-materia").attr('id');
        var materias = [];
        
        $("#materia option").each(function(){     
           materias.push(  $(this).val()+'-'+$(this).text());     
        });
        

        $.ajax({
          method: "POST",
          url: "controllers/usuarios_controller.php",
          data: { idMat: idmat, idUser: iduser, action: "borrarMateriaUser" },
          dataType: "json"
        })
        .done(function( msg ) {
            $('#materias-asignadas').html('');
            if(msg.length === 0){
                $('#materias-asignadas').append('Ninguna');
            }else{    
                $(materias).each(function(index, value){   
                    var materia= value.split('-');   
                    $(msg).each(function(index2 , value2){ 
                        if(materia[0] == value2){    
                            $('#materias-asignadas').append('<button class="btn btn-primary delete-materia" value="'+value2+'">'+ materia[1] +'<span class="mbr-iconfont mbri-close" style="color: red;"></span></button>');
                        }
                        if(msg.length === 0){
                           $('#materias-asignadas').append('Ninguna');
                        }    
                    });
                });
            } 
        });        
    });
   
</script>      
   
</body>
</html>