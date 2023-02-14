<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $records = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	// Mendeklarasikan Variabel untuk pencarian
    $whereMaterialSourcing = "";

    // Pengelolaan data yang dicari user
	$whereMaterialSourcing .= " WHERE feedbackRPIC=1 ";
	if( !empty($params['search']['value']) ) { 
		$whereMaterialSourcing .=" AND (materialName LIKE '".$params['search']['value']."%' ";    
		$whereMaterialSourcing .=" OR materialCategory LIKE '".$params['search']['value']."%' ";
		$whereMaterialSourcing .=" OR TB_Project.projectName LIKE '".$params['search']['value']."%' ";
		$whereMaterialSourcing .=" OR statusSourcing LIKE '".$params['search']['value']."%') ";
	}

    // Mengambil data dan total data yang dicari user
	$sqlRecMaterialSourcing = "SELECT TB_PengajuanSourcing.id, materialName, materialCategory, projectName, statusSourcing FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode";
	$sqlTotMaterialSourcing = "SELECT count(*) FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode";

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
			if($sqlPutSupplier = $conn->query("SELECT TB_Supplier.id, materialName, materialCategory, supplier, manufacture, statusSourcing, dateFinalFeedbackRnd, finalFeedbackRnd, writerFinalFeedbackRnd, idMaterial FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE idMaterial=".$row['id']." ORDER BY id DESC")->fetchAll()){
				foreach($sqlPutSupplier as $supplier){
					$feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$supplier['id']}' ORDER BY ID DESC")->fetchAll();
					$feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$supplier['id']}' ORDER BY ID DESC")->fetchAll();

					if($feedbackRnd[0]['dateFeedback'] != NULL){
						$supplier['dateFeedbackRnd'] = date('d F Y',strtotime($feedbackRnd[0]['dateFeedback']));
					}else{
						$supplier['dateFeedbackRnd'] = "-";
					}
					$supplier['sampelFeedbackRnd'] = $feedbackRnd[0]['sampel'];
					$supplier['writerFeedbackRnd'] = $feedbackRnd[0]['writer'];

					if($feedbackProc[0]['dateFeedbackProc'] != NULL){
						$supplier['dateFeedbackProc'] = date('d F Y',strtotime($feedbackProc[0]['dateFeedbackProc']));
					}else{
						$supplier['dateFeedbackProc'] = "-";
					}
					$supplier['feedbackProc'] = $feedbackProc[0]['feedback'];
					$supplier['writerFeedbackProc'] = $feedbackProc[0]['writer'];

					// Convert tanggal final feedback
					if($supplier['dateFinalFeedbackRnd'] != NULL){
						$supplier['convertDateFinalFeedbackRnd'] = date('d F Y', strtotime($supplier['dateFinalFeedbackRnd']));
					}else{
						$supplier['convertDateFinalFeedbackRnd'] = '-';
					}

					$supplier['projectName'] = $row['projectName'];

					$records[] = $supplier;
				}
			}else{
				// Jika material tidak memiliki supplier
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

		// Mengampung data ke dalam sebuah array
		$json_data = array(
				"draw"            => intval( $params['draw'] ),   
				"recordsTotal"    => $totalRecords[0][0],  
				"recordsFiltered" => $totalRecords[0][0],
				"data"            => $records// total data array
				);

	}else{
		// Jika variabel $queryRecords tidak ditemukan maka;
		$sqlRecSupplier = $conn->query("SELECT TB_Supplier.id, materialName, materialCategory, supplier, manufacture, statusSourcing, dateFinalFeedbackRnd, finalFeedbackRnd, writerFinalFeedbackRnd, projectCode, idMaterial FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND (supplier LIKE '".$params['search']['value']."%' OR manufacture LIKE '".$params['search']['value']."%') ORDER BY idMaterial DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY")->fetchAll();
		$sqlTolSupplier = $conn->query("SELECT count(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND (supplier LIKE '".$params['search']['value']."%' OR manufacture LIKE '".$params['search']['value']."%')")->fetchAll();
	
		foreach($sqlRecSupplier as $supplier){
			$projectName = $conn->query("SELECT projectName FROM TB_Project WHERE projectCode='".$supplier['projectCode']."'")->fetchAll();
			$feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$supplier['id']}' ORDER BY ID DESC")->fetchAll();
			$feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$supplier['id']}' ORDER BY ID DESC")->fetchAll();

			if($feedbackRnd[0]['dateFeedback'] != NULL){
				$supplier['dateFeedbackRnd'] = date('d F Y',strtotime($feedbackRnd[0]['dateFeedback']));
			}else{
				$supplier['dateFeedbackRnd'] = "-";
			}
			$supplier['sampelFeedbackRnd'] = $feedbackRnd[0]['sampel'];
			$supplier['writerFeedbackRnd'] = $feedbackRnd[0]['writer'];

			if($feedbackProc[0]['dateFeedbackProc'] != NULL){
				$supplier['dateFeedbackProc'] = date('d F Y',strtotime($feedbackProc[0]['dateFeedbackProc']));
			}else{
				$supplier['dateFeedbackProc'] = "-";
			}
			$supplier['feedbackProc'] = $feedbackProc[0]['feedback'];
			$supplier['writerFeedbackProc'] = $feedbackProc[0]['writer'];

			// Convert tanggal final feedback
			if($supplier['dateFinalFeedbackRnd'] != NULL){
				$supplier['convertDateFinalFeedbackRnd'] = date('d F Y', strtotime($supplier['dateFinalFeedbackRnd']));
			}else{
				$supplier['convertDateFinalFeedbackRnd'] = '-';
			}

			$supplier['projectName'] = $projectName[0]['projectName'];

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

	echo json_encode($json_data);  // Mengirim json format
?>