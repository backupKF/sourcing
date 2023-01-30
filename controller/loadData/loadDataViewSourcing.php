<?php
    include "../../dbConfig.php";

    $params = $records = array();

    $params = $_REQUEST;

    $whereMaterialSourcing = $whereSupplier = $sqlRecMaterialSourcing = "";

    //check search value exist
	$whereMaterialSourcing = " WHERE feedbackRPIC=1 ";
	// if( !empty($params['search']['value']) ) {
	// 	$whereMaterialSourcing = " WHERE feedbackRPIC=1 AND";
	// 	$whereMaterialSourcing .=" materialName LIKE '".$params['search']['value']."%' ";    
	// 	$whereMaterialSourcing .=" OR materialCategory LIKE '".$params['search']['value']."%' ";
	// 	$whereMaterialSourcing .=" OR projectCode LIKE '".$params['search']['value']."%' ";
	// 	$whereMaterialSourcing .=" OR statusSourcing LIKE '".$params['search']['value']."%' ";
	// }

    //getting total number records without any search
	$sqlPutMaterialSourcing = "SELECT id, materialName, materialCategory, projectCode, statusSourcing FROM TB_PengajuanSourcing";
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

	foreach($queryRecords as $row ) {
		if($sqlPutSupplier = $conn->query("SELECT TB_Supplier.id, materialName, materialCategory, supplier, manufacture, projectCode, statusSourcing, dateFinalFeedbackRnd, finalFeedbackRnd, writerFinalFeedbackRnd, idMaterial FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE idMaterial=".$row['id']."ORDER BY id DESC")->fetchAll()){
			foreach($sqlPutSupplier as $supplier){
				$feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$supplier['id']}' ORDER BY ID DESC")->fetchAll();
				$feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$supplier['id']}' ORDER BY ID DESC")->fetchAll();

				$supplier['dateFeedbackRnd'] = $feedbackRnd[0]['dateFeedback'];
				$supplier['sampelFeedbackRnd'] = $feedbackRnd[0]['sampel'];
				$supplier['writerFeedbackRnd'] = $feedbackRnd[0]['writer'];

				$supplier['dateFeedbackProc'] = $feedbackProc[0]['dateFeedbackProc'];
				$supplier['feedbackProc'] = $feedbackProc[0]['feedback'];
				$supplier['writerFeedbackProc'] = $feedbackProc[0]['writer'];

				$records[] = $supplier;
			}
		}else{
			$row["supplier"] = "-";
			$row['manufacture'] = "-";

			$row['dateFeedbackRnd'] = '-';
			$row['sampelFeedbackRnd'] = '-';
			$row['writerFeedbackRnd'] = '-';

			$row['dateFeedbackProc'] = '-';
			$row['feedbackProc'] = '-';
			$row['writerFeedbackProc'] = '-';

			$row['idMaterial'] = $row['id'];

			$records[] = $row;
		}
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => $totalRecords[0][0],  
			"recordsFiltered" => $totalRecords[0][0],
			"data"            => $records// total data array
			);

	echo json_encode($json_data);  // send data as json format
?>