<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $totalRecords = $data = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	//Mendeklarasikan Variabel untuk pencarian
    $where = $sqlTot = $sqlRec = "";

	if(!empty($_GET["sn"]) && empty($_GET["idMaterial"])){
		// Jika terdapat data GET Sourcing Number
		$where .= " WHERE sourcingNumber=".$_GET['sn'];
	}else if(!empty($_GET["sn"]) && !empty($_GET["idMaterial"])){
		// Jika terdapat data GET Sourcing Number dan Id Material
		$where .= " WHERE sourcingNumber=".$_GET['sn']." AND TB_PengajuanSourcing.id=".$_GET['idMaterial'];
	}else{
		// Jika selain dari kondisi di atas, check pencarian user
		if( !empty($params['search']['value']) ) {   
			$where .=" WHERE ";
			$where .=" TB_PengajuanSourcing.sourcingNumber LIKE '".$params['search']['value']."%' ";
			$where .=" OR materialName LIKE '".$params['search']['value']."%' ";
			$where .=" OR dateSourcing LIKE '".$params['search']['value']."%' ";
			$where .=" OR TB_Project.projectCode LIKE '".$params['search']['value']."%' ";
			$where .=" OR TB_Project.projectName LIKE '".$params['search']['value']."%' ";
			$where .=" OR teamLeader LIKE '".$params['search']['value']."%' ";
			$where .=" OR researcher LIKE '".$params['search']['value']."%' ";
			$where .=" OR dateApprovedTL LIKE '".$params['search']['value']."%' ";
			$where .=" OR dateAcceptedRPIC LIKE '".$params['search']['value']."%' ";
			$where .=" OR statusRiwayat LIKE '".$params['search']['value']."%' ";
		}
	}

    // Mengambil data dan total data yang dicari user
	$sql = "SELECT TB_PengajuanSourcing.id, sourcingNumber, materialName, dateSourcing, TB_Project.projectCode, TB_Project.projectName,
			materialCategory, materialSpesification, catalogOrCasNumber, company, website, finishDossageForm, keterangan, documentReq, 
			teamLeader, researcher, feedbackTL, feedbackRPIC, dateApprovedTL, dateAcceptedRPIC, statusRiwayat FROM TB_PengajuanSourcing 
			INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode";
	$sqlTot = "SELECT count(*) FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode";
	$sqlRec .= $sql;

    // Jika user melakukan pencarian data maka data diambil sesuai dengan pencarian
	if(isset($where) && $where != '') {
		$sqlRec .= $where;
		$sqlTot .= $where;
	}

	// Mengambil data sesuai dengan page yang dipilih user
    $sqlRec .=  " ORDER BY TB_PengajuanSourcing.id DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY";

	// Pengambilan Total data dari database
	$totalRecords = $conn->query($sqlTot)->fetchAll();

	// Pengambilan Data dari database
    $queryRecords = $conn->query($sqlRec)->fetchAll();

	// Menampung hasil data material kedalam array
	foreach($queryRecords as $row ) {

		// Convert Tanggal Approved Team Leader
		if($row['dateApprovedTL'] != NULL){
			$row['convertDateApprovedTL'] = date('d F Y', strtotime($row['dateApprovedTL']));
		}else{
			$row['convertDateApprovedTL'] = '-';
		}

		// Convert Tanggal Accepted RPIC
		if($row['dateAcceptedRPIC'] != NULL){
			$row['convertDateAcceptedRPIC'] = date('d F Y', strtotime($row['dateAcceptedRPIC']));
		}else{
			$row['convertDateAcceptedRPIC'] = '-';
		}

		$data[] = $row;
	}	

	// Mengampung hasil data ke dalam sebuah array
	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => $totalRecords[0][0],  
			"recordsFiltered" => $totalRecords[0][0],
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // Mengirim json format
?>