<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $totalRecords = $data = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	//Mendeklarasikan Variabel untuk pencarian
    $where = $sqlTot = $sqlRec = "";

	// if(!empty($_GET["sn"]) && empty($_GET["idMaterial"])){
	// 	// Jika terdapat data GET Sourcing Number
	// 	$where .= " WHERE sourcingNumber=".$_GET['sn'];
	// }else if(!empty($_GET["sn"]) && !empty($_GET["idMaterial"])){
	// 	// Jika terdapat data GET Sourcing Number dan Id Material
	// 	$where .= " WHERE sourcingNumber=".$_GET['sn']." AND TB_PengajuanSourcing.id=".$_GET['idMaterial'];
	// }else{
		// Jika selain dari kondisi di atas, check pencarian user
		if( !empty($params['search']['value']) ) {   
			$where .=" WHERE ";
			$where .=" supplier LIKE '".$params['search']['value']."%' ";
			$where .=" OR manufacture LIKE '".$params['search']['value']."%' ";
			$where .=" OR originCountry LIKE '".$params['search']['value']."%' ";
			$where .=" OR leadTime LIKE '".$params['search']['value']."%' ";
			$where .=" OR catalogOrCasNumber LIKE '".$params['search']['value']."%' ";
			$where .=" OR gradeOrReference LIKE '".$params['search']['value']."%' ";
            $where .=" OR documentInfo LIKE '".$params['search']['value']."%' ";
		}
	// }

    // Mengambil data dan total data yang dicari user
	$sql = "SELECT id, supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo, feedbackRndPriceReview, dateFinalFeedbackRnd
            finalFeedbackRnd, writerFinalFeedbackRnd FROM TB_Supplier WHERE idMaterial =".$_GET['idMaterial'];
	$sqlTot = "SELECT count(*) FROM TB_Supplier WHERE idMaterial =".$_GET['idMaterial'];
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
        // Get Feedback Doc Req
        $feedbackDocReq = $conn->query("SELECT * FROM TB_FeedbackDocReq WHERE idSupplier='{$row['id']}'")->fetchAll();
        $row['id-feedbackDocReq'] = $feedbackDocReq[0]['id'];
        $row['doc-CoA'] = $feedbackDocReq[0]['CoA'];
        $row['doc-MSDS'] = $feedbackDocReq[0]['MSDS'];
        $row['doc-MoA'] = $feedbackDocReq[0]['MoA'];
        $row['doc-Halal'] = $feedbackDocReq[0]['Halal'];
        $row['doc-DMF'] = $feedbackDocReq[0]['DMF'];
        $row['doc-GMP'] = $feedbackDocReq[0]['GMP'];

        // Get Feedback Rnd
        $feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll();
        $row['id-feedbackRnd'] = $feedbackRnd[0]['id'];
        $row['dateFeedbackRnd'] = $feedbackRnd[0]['dateFeedback'];
        $row['sampelFeedbackRnd'] = $feedbackRnd[0]['sampel'];
        $row['writerFeedbackRnd'] = $feedbackRnd[0]['writer'];
        
        // Get Feedback Proc
        $feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll();
        $row['id-feedbackProc'] = $feedbackProc[0]['id'];
        $row['dateFeedbackProc'] = $feedbackProc[0]['dateFeedbackProc'];
        $row['feedbackProc'] = $feedbackProc[0]['feedback'];
        $row['writerFeedbackProc'] = $feedbackProc[0]['writer'];

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