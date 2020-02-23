<?php

try {

	$getCuenta = $_GET['cuenta'];
	$dirpath = '../audio/'.$getCuenta;
	if (is_dir($dirpath)) {

		$isDirEmpty = new DirectoryIterator($dirpath);
		
		if ($isDirEmpty->valid()) {			

			$sorted_keys = array();
			date_default_timezone_set('America/Costa_Rica');
			$hoy = date_create('now')->format('Y-m-d');
		
			foreach (new DirectoryIterator($dirpath) as $fileinfo ) {
		
				if (!$fileinfo->isDot()) {
					$fechaArchivo = date("Y-m-d", $fileinfo->getCTime());
					$horaArchivo = date("H:i:s", $fileinfo->getCTime());
					$fechaMostrar = "";
					if ($fechaArchivo==$hoy){
							$fechaMostrar = $horaArchivo;
						}
						else {
							$fechaMostrar = date("m-d H:i:s", $fileinfo->getCTime());
					}
					
					$pathFile = "audio/". $getCuenta. "/".$fileinfo->getFilename();								
					$elements = array(
									"MTime" => $fileinfo->getMTime(), 
									"fechaMostrar" => $fechaMostrar,
									"path" => $pathFile,
									"name" => $fileinfo->getBasename('.ogg')
								);
					array_push($sorted_keys, $elements);				
				}
			}

			foreach ($sorted_keys as $key => $part) {
				$sort[$key] = strtotime($part['MTime']);
			}
			
			array_multisort($sort, SORT_DESC, $sorted_keys); 
			echo json_encode($sorted_keys);
		}
		else {
			echo "0";
		} 
	}
	else {
		echo "0";
	}
} 
catch (PDOException $e) {		
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}
?>
