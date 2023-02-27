<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $totalRecords = $data = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	//Mendeklarasikan Variabel untuk pencarian
    $where = $sqlTot = $sqlRec = "";

    $where .= "  WHERE idProject='".$_GET['idProject']."' AND feedbackRPIC=1 ";
	// Jika selain dari kondisi di atas, check pencarian user
	if( !empty($params['search']['value']) ) {
		$where .=" AND (materialCategory LIKE '".$params['search']['value']."%' ";
		$where .=" OR materialName LIKE '".$params['search']['value']."%' ";
		$where .=" OR priority LIKE '".$params['search']['value']."%' ";
		$where .=" OR materialSpesification LIKE '".$params['search']['value']."%' ";
		$where .=" OR catalogOrCasNumber LIKE '".$params['search']['value']."%' ";
		$where .=" OR company LIKE '".$params['search']['value']."%' ";
		$where .=" OR website LIKE '".$params['search']['value']."%' ";
		$where .=" OR finishDossageForm LIKE '".$params['search']['value']."%' ";
		$where .=" OR keterangan LIKE '".$params['search']['value']."%' ";
		$where .=" OR teamLeader LIKE '".$params['search']['value']."%' ";
		$where .=" OR vendorAERO LIKE '".$params['search']['value']."%' ";
		$where .=" OR documentReq LIKE '".$params['search']['value']."%' ";
		$where .=" OR statusSourcing LIKE '".$params['search']['value']."%') ";
	}

    // Mengambil data dan total data yang dicari user
	$sql = "SELECT * FROM dbo.TB_PengajuanSourcing";
	$sqlTot = "SELECT count(*) FROM dbo.TB_PengajuanSourcing";
	$sqlRec .= $sql;

    // Jika user melakukan pencarian data maka data diambil sesuai dengan pencarian
	if(isset($where) && $where != '') {
		$sqlRec .= $where;
		$sqlTot .= $where;
	}

	// Mengambil data sesuai dengan page yang dipilih user
    $sqlRec .=  " ORDER BY id DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY";

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