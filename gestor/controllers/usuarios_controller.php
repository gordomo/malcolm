<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/funciones.php';

switch ($_REQUEST["action"]) {
	case 'asignarMateria':

            $iduser = $_POST['idUser'];
            $idmat= json_encode($_POST['idMat']);

            $usuario = getUsuario($mysqli,$iduser);

            if(!empty($usuario['materias'])){                   
                
                $materias = json_decode($usuario['materias']);
                $matAgregar = array_diff($_POST['idMat'],$materias);   

                if(!empty($matAgregar)){
                    $idmat = json_encode(array_merge($materias,$matAgregar));                     
                }else{   
                    echo $usuario['materias'];
                    exit();    
                }               
            }            

            if ($stmt = $mysqli->prepare("UPDATE usuarios set `materias` = ? WHERE `id` = ?")) {
                        $stmt->bind_param('si',$idmat, $iduser);
                        if (!$stmt->execute()) {
                                exit();        	
                        }
                        $stmt->close();
                        $usuario = getUsuario($mysqli,$iduser);
                        echo $usuario['materias'];
                        exit();
                } else {
                        exit();
                }
	break;
	case "borrarMateriaUser":
            
		$iduser = $_POST['idUser'];
                $idmat= $_POST['idMat'];
                               
                $usuario = getUsuario($mysqli,$iduser)['materias'];
                $materiasUser = json_decode($usuario);

                $nuevasMaterias = [];
                
                foreach ($materiasUser as $matUser) { 
                    if($matUser != $idmat){    
                       $nuevasMaterias[]= $matUser;
                    }
                }
                $nuevasMaterias = json_encode($nuevasMaterias);
       
		if ($stmt = $mysqli->prepare("UPDATE usuarios set `materias` = ? WHERE `id` = ?")) {
                        $stmt->bind_param('si',$nuevasMaterias, $iduser);
                        if (!$stmt->execute()) {
                                exit();        	
                        }
                        $stmt->close();
                        $usuario = getUsuario($mysqli,$iduser);
                        echo $usuario['materias'];
                        exit();
                } else {
                        exit();
                }

	break;
	
}