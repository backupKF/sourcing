<?php
    include "../dbConfig.php";
    $dataRiwayat = $conn->query("SELECT * FROM TB_RiwayatSourcing INNER JOIN TB_Project ON TB_RiwayatSourcing.projectCode = TB_Project.projectCode")->fetchAll();
    if(isset($_POST['feedbackRPIC'])){
        $dateAcceptedRPIC = date("Y-m-d");
        $setID = $_POST['setID'];
        $setFeedback = $_POST['feedbackRPIC'];
        
        $data = [
            'dateAcceptedRPIC' => $dateAcceptedRPIC, 
            'feedbackRPIC' => $setFeedback,
            'id' => $setID,
        ];

        $sql = "UPDATE TB_RiwayatSourcing SET feedbackRPIC=:feedbackRPIC, dateAcceptedRPIC=:dateAcceptedRPIC WHERE id=:id";
        $conn->prepare($sql)->execute($data);

        header("Location: index.php");
    };

    if(isset($_POST['feedbackTL'])){
        $dateApprovedTL = date("Y-m-d");
        $setID = $_POST['setID'];
        $setFeedback = $_POST['feedbackTL'];
        
        $data = [
            'dateApprovedTL' => $dateApprovedTL, 
            'feedbackTL' => $setFeedback,
            'id' => $setID,
        ];

        $sql = "UPDATE TB_RiwayatSourcing SET feedbackTL=:feedbackTL, dateApprovedTL=:dateApprovedTL WHERE id=:id";
        $conn->prepare($sql)->execute($data);

        header("Location: index.php");
    };

    if(isset($_POST['status'])){
        $setID = $_POST['setID'];
        $status = $_POST['status'];
        
        $data = [
            'status' => $status,
            'id' => $setID,
        ];

        $sql = "UPDATE TB_RiwayatSourcing SET status=:status WHERE id=:id";
        $conn->prepare($sql)->execute($data);

        header("Location: index.php");
    };
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container position-relative" style="margin-left:275px;z-index:1;">
        <div class="container overflow-scroll" style="width:150%">
            <table class="table" style="width:200%">
                <thead>
                    <tr class="bg-danger bg-opacity-75">
                        <th scope="col" style="font-size: 15px;width:1%" class="text-center">No</th>
                        <th scope="col" style="font-size: 15px;width:5%" class="text-center mx-0">Date Sourcing</th>
                        <th scope="col" style="font-size: 15px;width:10%" class="text-center">Project Code</th>
                        <th scope="col" style="font-size: 15px;width:8%" class="text-center">Project Name</th>
                        <th scope="col" style="font-size: 15px;width:5%" class="text-center">Team Leader</th>
                        <th scope="col" style="font-size: 15px;width:5%" class="text-center">Researcher</th>
                        <th scope="col" style="font-size: 15px;width:4%" class="text-center">Feedback TL</th>
                        <th scope="col" style="font-size: 15px;width:4%" class="text-center">Feedback RPIC</th>
                        <th scope="col" style="font-size: 15px;width:5%" class="text-center">Date Approved TL</th>
                        <th scope="col" style="font-size: 15px;width:5%" class="text-center">Date Accepted RPIC</th>
                        <th scope="col" style="font-size: 15px;width:4%" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($dataRiwayat as $riwayat) { $count++
                    ?>
                    <tr class="bg-light">
                        <td style="font-size:18px;" class="text-center"><?php echo $count ?></td>
                        <td style="font-size:18px;" class="text-center"><?php echo $riwayat['dateSourcing'] ?></td>
                        <td style="font-size:18px;" class="text-center"><?php echo $riwayat['projectCode'] ?></td>
                        <td style="font-size:18px;" class="text-center"><?php echo $riwayat['projectName'] ?></td>
                        <td style="font-size:18px;" class="text-center"><?php echo $riwayat['teamLeader'] ?></td>
                        <td style="font-size:18px;" class="text-center"><?php echo $riwayat['researcher'] ?></td>
                        <td style="font-size:18px;" class="text-center">
                            <form action="" method="POST">
                                <input type="hidden" name="setID" value="<?php echo $riwayat['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="feedbackTL">
                                    <option <?php if($riwayat['feedbackTL'] == 0){echo "selected";};?> value=0>No Action</option>
                                    <option <?php if($riwayat['feedbackTL'] == 1){echo "selected";};?> value=1>Approved</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size:18px;" class="text-center">
                            <form action="" method="POST">
                                <input type="hidden" name="setID" value="<?php echo $riwayat['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="feedbackRPIC">
                                    <option <?php if($riwayat['feedbackRPIC'] == 0){echo "selected";};?> value=0>No Action</option>
                                    <option <?php if($riwayat['feedbackRPIC'] == 1){echo "selected";};?> value=1>Accepted</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size:18px;" class="text-center"><?php echo $riwayat['dateApprovedTL'] ?></td>
                        <td style="font-size:18px;" class="text-center"><?php echo $riwayat['dateAcceptedRPIC'] ?></td>
                        <td style="font-size:18px;" class="text-center">
                        <form action="" method="POST">
                                <input type="hidden" name="setID" value="<?php echo $riwayat['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="status">
                                    <option <?php if($riwayat['status'] == "ON PROSES"){echo "selected";};?> value="ON PROSES">ON PROSES</option>
                                    <option <?php if($riwayat['status'] == "HOLD"){echo "selected";};?> value="HOLD">HOLD</option>
                                    <option <?php if($riwayat['status'] == "CANCEL"){echo "selected";};?> value="CANCEL">CANCEL</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </body>
</html>