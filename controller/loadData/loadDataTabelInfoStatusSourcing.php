<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $records = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	//Mendeklarasikan Variabel untuk pencarian
    $whereMaterialSourcing = $sqlRecMaterialSourcing = "";

    // Pengelolaan data yang dicari user
	$whereMaterialSourcing .= " WHERE feedbackRPIC=1 AND statusSourcing='".$_GET['status']."' ";
	if( !empty($params['search']['value']) ) { 
		$whereMaterialSourcing .=" AND (materialName LIKE '".$params['search']['value']."%' ";    
		$whereMaterialSourcing .=" OR materialCategory LIKE '".$params['search']['value']."%' ";
		$whereMaterialSourcing .=" OR materialSpesification LIKE '".$params['search']['value']."%') ";
	}

    // Mengambil data dan total data
	$sqlRecMaterialSourcing = "SELECT id, materialName, materialCategory, materialSpesification FROM dbo.TB_PengajuanSourcing";
	$sqlTotMaterialSourcing = "SELECT count(*) FROM dbo.TB_PengajuanSourcing";

    // Jika user melakukan pencarian data maka data diambil sesuai dengan pencarian
	if(isset($whereMaterialSourcing) && $whereMaterialSourcing != '') {
		$sqlRecMaterialSourcing .= $whereMaterialSourcing;
		$sqlTotMaterialSourcing .= $whereMaterialSourcing;
	}

	// Mengambil data sesuai dengan page yang dipilih user
    $sqlRecMaterialSourcing .=  " ORDER BY id DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY";
	
	// Pengambilan Total data dari database
    $totalRecords = $conn->query($sqlTotMaterialSourcing)->fetchAll();
	
	// Pengambilan Data dari database
	$queryRecords = $conn->query($sqlRecMaterialSourcing)->fetchAll();

	// Jika variabel $queryRecords Ditemukan maka;
	if(!empty($queryRecords)){
		foreach($queryRecords as $row ) {
			// Jika material memiliki supplier
			if($sqlPutSupplier = $conn->query("SELECT materialName, materialCategory, materialSpesification, supplier 
											   FROM TB_Supplier 
											   INNER JOIN TB_PengajuanSourcing 
											   ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id 
											   WHERE idMaterial='".$row['id']."' ORDER BY TB_Supplier.id DESC")->fetchAll()){
				foreach($sqlPutSupplier as $supplier){
					$supplier['targetLaunching'] = "-";

					$records[] = $supplier;
				}
			}else{
				// Jika material tidak memiliki supplier
                $row['supplier'] = "-";
                $row['targetLaunching'] = "-";

				$records[] = $row;
			}
		}	

		// Mengampung hasil data ke dalam sebuah array
		$json_data = array(
				"draw"            => intval( $params['draw'] ),   
				"recordsTotal"    => $totalRecords[0][0],  
				"recordsFiltered" => $totalRecords[0][0],
				"data"            => $records// total data array
				);

	}else{
		// Jika variabel $queryRecords tidak ditemukan maka;
		// Ini dipanggil ketika user mencari data supplier
		$sqlRecSupplier = $conn->query("SELECT materialName, materialCategory, materialSpesification, supplier 
										FROM TB_Supplier 
										INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id 
										WHERE feedbackRPIC=1 AND statusSourcing = '".$_GET['status']."' AND (supplier LIKE '".$params['search']['value']."%' OR manufacture LIKE '".$params['search']['value']."%') 
										ORDER BY idMaterial DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY")->fetchAll();

		$sqlTolSupplier = $conn->query("SELECT count(*) 
										FROM TB_Supplier 
										INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id 
										WHERE feedbackRPIC=1 AND statusSourcing = '".$_GET['status']."' AND (supplier LIKE '".$params['search']['value']."%' OR manufacture LIKE '".$params['search']['value']."%')")->fetchAll();
	
		foreach($sqlRecSupplier as $supplier){
            $supplier['targetLaunching'] = "-";

			$records[] = $supplier;
		}

		// Mengampung data ke dalam sebuah array
		$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => $sqlTolSupplier[0][0],  
			"recordsFiltered" => $sqlTolSupplier[0][0],
			"data"            => $records// total data array
			);
	}

	echo json_encode($json_data, JSON_UNESCAPED_UNICODE);  // Mengirim json format
?>