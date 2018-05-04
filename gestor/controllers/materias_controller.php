<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/funciones.php';

switch ($_REQUEST["action"]) {
	case 'nuevaMateria':

		$name = $_POST['name'];
		
		if ($stmt = $mysqli->prepare("INSERT INTO materias (`name`) VALUES (?)")) {
			$stmt->bind_param('s', $name);
			if (!$stmt->execute()) {
				header('Location: ../materias.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../materias.php?status=0');
		} else {
			header('Location: ../materias.php?status=1');
		}
	break;
	case "editarMateria":
		$id = $_GET['id'];
		$val = $_GET['val'];

		if ($stmt = $mysqli->prepare("UPDATE materias set `name` = ? WHERE `id` = ?")) {
			$stmt->bind_param('si', $val, $id);
			if (!$stmt->execute()) {
				header('Location: ../materias.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../materias.php?status=0');
		} else {
			$message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
			header('Location: ../materias.php?mensaje='.$message);
		}
		
	break;

	case "borrarMateria":
		$id = $_GET['id'];
		
		if ($stmt = $mysqli->prepare("DELETE FROM materias WHERE `id` = ?")) {
			$stmt->bind_param('i', $id);
			if (!$stmt->execute()) {
				header('Location: ../materias.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../materias.php?status=0');
		} else {
			$message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
			header('Location: ../materias.php?mensaje='.$message);
		}
	break;

	case "nuevoAnio":
		$name = $_POST['name'];
		$matId = $_POST['matId'];
                
		if ($stmt = $mysqli->prepare("INSERT INTO anios (`name`, `mat_id`) VALUES (?, ?)")) {
			$stmt->bind_param('si', $name, $matId);
			if (!$stmt->execute()) {
				header('Location: ../anios.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../anios.php?status=0');
		} else {
			header('Location: ../anios.php?status=1');
		}
	break;

	case "editarAnio":
		$val = $_GET['val'];
		$matId = $_GET['matId'];
		$id = $_GET['id'];
		
		if ($stmt = $mysqli->prepare("UPDATE anios set `name` = ? , `mat_id` = ? WHERE `id` = ?")) {
			$stmt->bind_param('sii', $val, $matId, $id);
			if (!$stmt->execute()) {
				header('Location: ../anios.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../anios.php?status=0');
		} else {
			header('Location: ../anios.php?status=1');
		}
	break;

	case "borrarAnio":
		$id = $_GET['id'];
		
		if ($stmt = $mysqli->prepare("DELETE FROM anios WHERE `id` = ?")) {
			$stmt->bind_param('i', $id);
			if (!$stmt->execute()) {
				header('Location: ../anios.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../anios.php?status=3');
		} else {
			$message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
			header('Location: ../anios.php?mensaje='.$message);
		}
	break;
        
        case "agragarSubSubCategoria":
		$name = $_POST['name'];
		$catId = $_POST['catId'];
                $subcatId = $_POST['subcatId'];
                
                //die("name: ".$name. " catId: ".$catId." subcatId: ".$subcatId);

		if ($stmt = $mysqli->prepare("INSERT INTO subsubcategorias (`name`, `cat_id`, `sub_cat_id`) VALUES (?, ?, ?)")) {
			$stmt->bind_param('sii', $name, $catId, $subcatId);
			if (!$stmt->execute()) {
				header('Location: ../subsub.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../subsub.php?status=0');
		} else {
			header('Location: ../subsub.php?status=1');
		}
	break;
        
        case "editarSubSubCategoria":
		$name = $_GET['name'];
		$catId = $_GET['catId'];
                $subcatId = $_GET['subcatId'];
		$id = str_replace("cat-", '', $_GET['id']);
                
                //die("name: ".$name. " catId: ".$catId." subcatId: ".$subcatId. " id: ".$id);
		
		if ($stmt = $mysqli->prepare("UPDATE subsubcategorias set `name` = ? , `cat_id` = ? , `sub_cat_id` = ? WHERE `id` = ?")) {
			$stmt->bind_param('siii', $name, $catId, $subcatId, $id);
			if (!$stmt->execute()) {
				header('Location: ../subsub.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../subsub.php?status=0');
		} else {
			header('Location: ../subsub.php?status=1');
		}
	break;
        
        case "borrarSubSubCategoria":
		$id = str_replace("cat-", '', $_GET['id']);
		
		if ($stmt = $mysqli->prepare("DELETE FROM subsubcategorias WHERE `id` = ?")) {
			$stmt->bind_param('i', $id);
			if (!$stmt->execute()) {
				header('Location: ../subsub.php?status=2');        	
			}
			$stmt->close();
			header('Location: ../subsub.php?status=3');
		} else {
			$message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
			header('Location: ../subsub.php?mensaje='.$message);
		}
	break;
	
}