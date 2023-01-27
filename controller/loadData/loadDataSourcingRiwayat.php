<?php
    include "../../dbConfig.php";

    $params = $columns = $totalRecords = $data = array();

    $params = $_REQUEST;

    $where = $sqlTot = $sqlRec = "";

    // check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" materialCategory LIKE '".$params['search']['value']."%' ";    
		$where .=" OR materialName LIKE '".$params['search']['value']."%' ";
	}

    // getting total number records without any search
	$sql = "SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode";
	$sqlTot = "SELECT count(*) FROM TB_PengajuanSourcing";
	$sqlRec .= $sql;

    //concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}

    $sqlRec .=  " ORDER BY id DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY";


	$totalRecords = $conn->query($sqlTot)->fetchAll();

    $queryRecords = $conn->query($sqlRec)->fetchAll();

	//iterate on results row and create new index array of data
	foreach($queryRecords as $row ) { 
		$data[] = $row;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => $totalRecords[0][0],  
			"recordsFiltered" => $totalRecords[0][0],
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>