<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $totalRecords = $data = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	//Mendeklarasikan Variabel untuk pencarian
    $where = $sqlTot = $sqlRec = "";

	// Mendefinisikan pencarian feedbackTL
	if(strtolower($params['search']['value']) == 'approved'){
		$searchFeedbackTL = 1;
	}else{
		$searchFeedbackTL = $params['search']['value'];
	}

	// Mendefinisikan pencarian feedbackRPIC
	if(strtolower($params['search']['value']) == 'accepted'){
		$searchFeedbackRPIC = 1;
	}else{
		$searchFeedbackRPIC = $params['search']['value'];
	}

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
			$where .=" OR projectCode LIKE '".$params['search']['value']."%' ";
			$where .=" OR projectName LIKE '".$params['search']['value']."%' ";
			$where .=" OR teamLeader LIKE '".$params['search']['value']."%' ";
			$where .=" OR researcher LIKE '".$params['search']['value']."%' ";
			$where .=" OR feedbackTL LIKE '".$searchFeedbackTL."%' ";
			$where .=" OR feedbackRPIC LIKE '".$searchFeedbackRPIC."%' ";
			$where .=" OR dateApprovedTL LIKE '".$params['search']['value']."%' ";
			$where .=" OR dateAcceptedRPIC LIKE '".$params['search']['value']."%' ";
			$where .=" OR statusRiwayat LIKE '".$params['search']['value']."%' ";
		}
	}

    // Mengambil data dan total data yang dicari user
	$sql = "SELECT TB_PengajuanSourcing.id, sourcingNumber, materialName, dateSourcing, projectCode, projectName,
			materialCategory, materialSpesification, catalogOrCasNumber, company, website, finishDossageForm, keterangan, documentReq, 
			teamLeader, researcher, feedbackTL, feedbackRPIC, dateApprovedTL, dateAcceptedRPIC, statusRiwayat FROM dbo.TB_PengajuanSourcing
			INNER JOIN dbo.TB_Project ON dbo.TB_PengajuanSourcing.idProject = dbo.TB_Project.id";
	$sqlTot = "SELECT count(*) FROM dbo.TB_PengajuanSourcing INNER JOIN dbo.TB_Project ON dbo.TB_PengajuanSourcing.idProject = dbo.TB_Project.id";
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