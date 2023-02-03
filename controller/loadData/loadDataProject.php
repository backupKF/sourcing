<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $totalRecords = $data = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	//Mendeklarasikan Variabel untuk pencarian
    $where = $sqlTot = $sqlRec = "";

    $where .=" WHERE feedbackRPIC=1";
	// Jika selain dari kondisi di atas, check pencarian user
	if( !empty($params['search']['value']) ) {   
		$where .=" AND (projectCode LIKE '".$params['search']['value']."%' ";
		$where .=" OR projectName LIKE '".$params['search']['value']."%') ";
	}

    // Mengambil data dan total data yang dicari user
	$sql = "SELECT DISTINCT TB_Project.id, TB_Project.projectCode, TB_Project.projectName FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode";
	$sqlTot = "SELECT DISTINCT TB_Project.id, TB_Project.projectCode FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode";
	$sqlRec .= $sql;

    // Jika user melakukan pencarian data maka data diambil sesuai dengan pencarian
	if(isset($where) && $where != '') {
		$sqlRec .= $where;
		$sqlTot .= $where;
	}

	//Mengambil data sesuai dengan page yang dipilih user
    $sqlRec .=  " ORDER BY TB_Project.id DESC OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY";

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
			"recordsTotal"    => count($totalRecords),  
			"recordsFiltered" => count($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // Mengirim json format
?>