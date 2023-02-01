<?php
    include "../../dbConfig.php";

    $params = $records = array();

    $params = $_REQUEST;

    $whereMaterialSourcing = $sqlRecMaterialSourcing = "";

    //check search value exist
	$whereMaterialSourcing .= " WHERE statusSourcing='".$_GET['status']."' ";
	if( !empty($params['search']['value']) ) { 
		$whereMaterialSourcing .=" AND (materialName LIKE '".$params['search']['value']."%' ";    
		$whereMaterialSourcing .=" OR materialCategory LIKE '".$params['search']['value']."%' ";
		$whereMaterialSourcing .=" OR materialSpesification LIKE '".$params['search']['value']."%') ";
	}

    //getting total number records without any search
	$sqlPutMaterialSourcing = "SELECT id, materialName, materialCategory, materialSpesification FROM TB_PengajuanSourcing";
	$sqlTotMaterialSourcing = "SELECT count(*) FROM TB_PengajuanSourcing";
	$sqlRecMaterialSourcing .= $sqlPutMaterialSourcing;

    //concatenate search sql if value exist
	if(isset($whereMaterialSourcing) && $whereMaterialSourcing != '') {
		$sqlTotMaterialSourcing .= $whereMaterialSourcing;
		$sqlRecMaterialSourcing .= $whereMaterialSourcing;
	}

    $sqlRecMaterialSourcing .=  " ORDER BY id DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY";
	
    $totalRecords = $conn->query($sqlTotMaterialSourcing)->fetchAll();
	
	$queryRecords = $conn->query($sqlRecMaterialSourcing)->fetchAll();

	if(!empty($queryRecords)){
		foreach($queryRecords as $row ) {
			if($sqlPutSupplier = $conn->query("SELECT materialName, materialCategory, materialSpesification, supplier FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE idMaterial='".$row['id']."' ORDER BY TB_Supplier.id DESC")->fetchAll()){
				foreach($sqlPutSupplier as $supplier){
					$supplier['targetLaunching'] = "-";

					$records[] = $supplier;
				}
			}else{
                $row['supplier'] = "-";
                $row['targetLaunching'] = "-";

				$records[] = $row;
			}
		}	

		$json_data = array(
				"draw"            => intval( $params['draw'] ),   
				"recordsTotal"    => $totalRecords[0][0],  
				"recordsFiltered" => $totalRecords[0][0],
				"data"            => $records// total data array
				);

	}else{
		$sqlRecSupplier = $conn->query("SELECT materialName, materialCategory, materialSpesification, supplier FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE statusSourcing = '".$_GET['status']."' AND (supplier LIKE '".$params['search']['value']."%' OR manufacture LIKE '".$params['search']['value']."%') ORDER BY idMaterial DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY")->fetchAll();
		$sqlTolSupplier = $conn->query("SELECT count(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE statusSourcing = '".$_GET['status']."' AND (supplier LIKE '".$params['search']['value']."%' OR manufacture LIKE '".$params['search']['value']."%')")->fetchAll();
	
		foreach($sqlRecSupplier as $supplier){
            $supplier['targetLaunching'] = "-";

			$records[] = $supplier;
		}
		$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => $sqlTolSupplier[0][0],  
			"recordsFiltered" => $sqlTolSupplier[0][0],
			"data"            => $records// total data array
			);
	}

	echo json_encode($json_data);  // send data as json format
?>