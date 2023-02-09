<?php
    include "../../dbConfig.php";

	// Mendeklarasikan Variabel Array
    $params = $totalRecords = $data = $scripts = array();

	// Mengisi variabel $params dengan Request dari Client
    $params = $_REQUEST;

	//Mendeklarasikan Variabel untuk pencarian
    $where = $sqlTot = $sqlRec = "";

	
	if(!empty($_GET["idMaterial"]) && !empty($_GET["idSupplier"])){
		// Jika terdapat data GET Sourcing Number dan Id Material
		$where .= " WHERE id =".$_GET['idSupplier']." AND idMaterial=".$_GET['idMaterial'];
	}
	if(!empty($_GET["idMaterial"]) && empty($_GET["idSupplier"])){
		// Jika selain dari kondisi di atas, check pencarian user
		$where .= " WHERE idMaterial =".$_GET['idMaterial'];
		if( !empty($params['search']['value']) ) {
			$where .=" AND (supplier LIKE '".$params['search']['value']."%' ";
			$where .=" OR manufacture LIKE '".$params['search']['value']."%' ";
			$where .=" OR originCountry LIKE '".$params['search']['value']."%' ";
			$where .=" OR leadTime LIKE '".$params['search']['value']."%' ";
			$where .=" OR catalogOrCasNumber LIKE '".$params['search']['value']."%' ";
			$where .=" OR gradeOrReference LIKE '".$params['search']['value']."%' ";
            $where .=" OR documentInfo LIKE '".$params['search']['value']."%') ";
		}
	}

    // Mengambil data dan total data yang dicari user
	$sql = "SELECT id, supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo, feedbackRndPriceReview, dateFinalFeedbackRnd,
            finalFeedbackRnd, writerFinalFeedbackRnd FROM TB_Supplier";
	$sqlTot = "SELECT count(*) FROM TB_Supplier";
	$sqlRec .= $sql;

	// // Mengambil data dan total data yang dicari user
	// $sql = "SELECT id, supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo, feedbackRndPriceReview, dateFinalFeedbackRnd
    //         finalFeedbackRnd, writerFinalFeedbackRnd FROM TB_Supplier WHERE idMaterial = 214402";
	// $sqlTot = "SELECT count(*) FROM TB_Supplier WHERE idMaterial = 214402";
	// $sqlRec .= $sql;

    // Jika user melakukan pencarian data maka data diambil sesuai dengan pencarian
	if(isset($where) && $where != '') {
		$sqlRec .= $where;
		$sqlTot .= $where;
	}

	//Mengambil data sesuai dengan page yang dipilih user
    $sqlRec .=  " ORDER BY id DESC  OFFSET ".$params['start']." ROWS FETCH FIRST ".$params['length']." ROWS ONLY";

	// $sqlRec .=  " ORDER BY id DESC  OFFSET 0 ROWS FETCH FIRST 5 ROWS ONLY";

	// Pengambilan Total data dari database
	$totalRecords = $conn->query($sqlTot)->fetchAll();

	// Pengambilan Data dari database
    $queryRecords = $conn->query($sqlRec)->fetchAll();

	// Menampung hasil data material kedalam array
	foreach($queryRecords as $row ) {

		$outputDetailSupplier = $outputFeedbackRnd = $outputFeedbackProc = $outputViewDoc = $script = '';

		// Get Detail Supplier
		if($detailSupplier = $conn->query("SELECT * FROM TB_DetailSupplier WHERE idSupplier=".$row['id'])->fetchAll()){
			foreach($detailSupplier as $dataDetailSupplier){
				$outputDetailSupplier .= '
					<tr style="font-size:12px;font-family:poppinsRegular;">
						<td class="text-center p-0" style="width:60px">'.$dataDetailSupplier['MoQ'].'</td>
						<td class="text-center p-0" style="width:60px">'.$dataDetailSupplier['UoM'].'</td>
						<td class="text-center p-0" style="width:60px">'.$dataDetailSupplier['price'].'</td>
						<td class="text-center p-0" style="width:60px">
                        	<button type="button" style="width:50px;height:20px;font-size:10px;font-family:poppinsSemiBold" class="btn btn-danger d-inline ms-1 p-0" onclick="funcDeleteDetailInfo('.$dataDetailSupplier['idDetailSupplier'].','.$dataDetailSupplier['idSupplier'].')">Delete</a>
                        </td>
					</tr>
				';
			}
			$row['outputDetailSupplier'] = $outputDetailSupplier;
		}else{
			$row['outputDetailSupplier'] = '-';
		}

		// Get Data Feedback Rnd 
		if($dataDetailFeedbackRnd = $conn->query("SELECT * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll()){
			foreach($dataDetailFeedbackRnd as $dataFeedbackRnd){
				$outputFeedbackRnd .= '
					<div class="ms-1 my-2">
						<!-- Tanggal Feedback Rnd -->
						<div class="bg-success bg-opacity-75" style="width:110px;font-size:11px;font-family:poppinsBold;">Date: '.$dataFeedbackRnd['dateFeedback'].'</div>
						<!-- Isi Feedback Rnd -->
						<div class="text-wrap" style="font-size:14px;font-family:poppinsMedium;">'.$dataFeedbackRnd['sampel'].'</div>
						<!-- Penulis -->
						<div style="font-size:10px;font-family:poppinsBold;">By: '.$dataFeedbackRnd['writer'].'</div>
					</div>
			
					<hr>
				';
			}
			$row['outputFeedbackRnd'] = $outputFeedbackRnd;
		}else{
			$row['outputFeedbackRnd'] = '-';
		}

        // Mengambil data feedback proc
        if($dataDetailFeedbackProc = $conn->query("SELECT * FROM TB_FeedbackProc WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll()){
			foreach($dataDetailFeedbackProc as $dataFeedbackProc){
				$outputFeedbackProc .= '
				<div class="ms-1 my-2">
					<!-- Tanggal Feedback Proc -->
					<div class="bg-success bg-opacity-75" style="width:110px;font-size:11px;font-family:poppinsBold;">Date: '.$dataFeedbackProc['dateFeedbackProc'].'</div>
					<!-- Isi Feedback Proc -->
					<div class="text-wrap" style="font-size:14px;font-family:poppinsMedium;">'.$dataFeedbackProc['feedback'].'</div>
					<!-- Penulis -->
					<div style="font-size:10px;font-family:poppinsBold;">By: '.$dataFeedbackProc['writer'].'</div>
				</div>

				<hr class="m-0">
				';
			}
			$row['outputFeedbackProc'] = $outputFeedbackProc;
		}else{
			$row['outputFeedbackProc'] = '-';
		}

		// Mengambil Daftar Document
        if($file = $conn->query("SELECT * FROM TB_File WHERE idSupplier='{$row['id']}'")->fetchAll()){
            foreach($file as $dataFile){
				$outputViewDoc .= '
					<tbody>
						<td style="font-size:15px;font-family:poppinsItalic">'.$dataFile['fileName'].'</td>
						<td><a class="text-decoration-none btn btn-success d-inline ms-1" style="width:80px;height:25px;font-size:13px;font-family:poppinsSemiBold;padding:3px" href="../assets/uploads/'.$dataFile['fileHash'].'" target="_blank">View</a></td>
						<td><button type="button" style="width:50px;height:25px;font-size:13px;font-family:poppinsSemiBold" class="btn btn-danger d-inline ms-1 p-0" onclick="deleteFile('.$dataFile['id'].','.$row['id'].')">Delete</button></td>
					</tbody>
				';
            }
			$row['outputViewDoc'] = $outputViewDoc;
        }else{
			// Jika Tidak ada
			$row['outputViewDoc'] = '
				<tbody>
					<td></td>
					<td>Not Found</td>
					<td></td>
				</tbody>
			';
        }


        // Get Feedback Doc Req
        if($feedbackDocReq = $conn->query("SELECT * FROM TB_FeedbackDocReq WHERE idSupplier='{$row['id']}'")->fetchAll()){
			$row['idfeedbackDocReq'] = $feedbackDocReq[0]['id'];
			$row['docCoA'] = $feedbackDocReq[0]['CoA'];
			$row['docMSDS'] = $feedbackDocReq[0]['MSDS'];
			$row['docMoA'] = $feedbackDocReq[0]['MoA'];
			$row['docHalal'] = $feedbackDocReq[0]['Halal'];
			$row['docDMF'] = $feedbackDocReq[0]['DMF'];
			$row['docGMP'] = $feedbackDocReq[0]['GMP'];
		}else{
			$row['idfeedbackDocReq'] = "";
			$row['docCoA'] = "";
			$row['docMSDS'] = "";
			$row['docMoA'] = "";
			$row['docHalal'] = "";
			$row['docDMF'] = "";
			$row['docGMP'] = "";
		}

        // Get Feedback Rnd
        if($feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll()){
			$row['idfeedbackRnd'] = $feedbackRnd[0]['id'];
			$row['dateFeedbackRnd'] = $feedbackRnd[0]['dateFeedback'];
			$row['sampelFeedbackRnd'] = $feedbackRnd[0]['sampel'];
			$row['writerFeedbackRnd'] = $feedbackRnd[0]['writer'];
		}else{
			$row['idfeedbackRnd'] = "";
			$row['dateFeedbackRnd'] = "";
			$row['sampelFeedbackRnd'] = "";
			$row['writerFeedbackRnd'] = "";
		}
        
        // Get Feedback Proc
        if($feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll()){
			$row['idfeedbackProc'] = $feedbackProc[0]['id'];
			$row['dateFeedbackProc'] = $feedbackProc[0]['dateFeedbackProc'];
			$row['feedbackProc'] = $feedbackProc[0]['feedback'];
			$row['writerFeedbackProc'] = $feedbackProc[0]['writer'];
		}else{
			$row['idfeedbackProc'] = "";
			$row['dateFeedbackProc'] = "";
			$row['feedbackProc'] = "";
			$row['writerFeedbackProc'] = "";
		}

		$script .= '
			<script>
				$("#tabel-vendorUpdateSupplier'.$row['id'].'").DataTable({
					lengthChange:false,
                    pageLength:5,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "../controller/loadData/loadDataMasterVendor.php",
                    },
					columns: [
						{
							data: function(dataVendor){
								return (
									`<div class="py-0 column-project-value" style="width:250px">`+
										`<!-- Column Project Name -->`+
										`<div class="d-flex align-items-center"style="height:30px">`+
                                            dataVendor.vendorName +
                                        `</div>`+
                                    `</div>`
								)
							}
						},
						{
							data: function(dataVendor){
								return (
									`<!-- Action Button -->`+
									`<div class="py-0" style="width:50px">`+
										`<form id="formSetVendorUpdateSupplier`+dataVendor.id+`">`+
											`<button type="button" class="btn btn-success btn-sm p-0 px-1" style="height:22px" name="setValue" value="`+dataVendor.vendorName+`" onclick="funcSetVendor('.$row['id'].',\``+dataVendor.vendorName+`\`, \`formSetVendorUpdateSupplier\`)">`+
												`<span style="font-size:11px;font-family:poppinsBold">Pilih</span>`+
											`</button>`+
										`</form>`+
									`</div>`
								)
							}
						}
					]
				})
			</script>
		';		
		
		$scripts[] = $script;

		$data[] = $row;
	}

	// Mengampung hasil data ke dalam sebuah array
	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => $totalRecords[0][0],  
			"recordsFiltered" => $totalRecords[0][0],
			"data"            => $data,   // total data array
			"script"		  => $scripts
			);

	echo json_encode($json_data);  // Mengirim json format
?>