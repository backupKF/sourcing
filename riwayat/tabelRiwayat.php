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
    <div class="container position-relative" style="margin-left:275px">
            <table class="table" style="width:200%" id="table-riwayat">
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
                        <th scope="col" style="font-size: 15px;width:4%" class="text-center">Edit Material</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </div>

    <script>
        $(document).ready(function() {
            var tableRiwayat = $('#table-riwayat').DataTable({
                ajax: "controller/viewRiwayat.php",
                scrollX: true,
                columns: [
                    {
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.dateSourcing+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.projectCode+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.projectName+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.teamLeader+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.researcher+'</p>')
                        }
                    },
                    {
                        data: null
                    },
                    {
                        data: null
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.dateApprovedTL+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.dateAcceptedRPIC+'</p>')
                        }
                    },
                    {
                        data: null
                    },
                    {
                        data: null
                    },
                ]
            })
        });
    </script>
  </body>
</html>