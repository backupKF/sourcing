<div class="row">
 
  <div class="col">
    <!-- Card Graph -->
    <div class="card" style="width:700px">
      <div class="card body">
        <div id="myChart" style="width:100%; max-width:750px; height:220px;"></div>
      </div>
    </div>
    <!--  -->
  </div>
  
  <div class="col">
      <!-- Total Sourcing -->
      <div class="card" style="width:300px;height:105px">
        <!-- Title -->
        <div class="text-center fs-6 p-1 border-bottom" style="background-color:#f7f7eb">Total Sourcing</div>
        <!-- Result -->
        <div class="d-flex align-items-center position-relative border-bottom" style="height:120px;background-color:#bbd0fc">
          <span class="position-absolute top-50 start-50 translate-middle fs-4">
            <?php
              $countSourcing= $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1")->fetchAll();
              echo $countSourcing[0][0] 
            ?>
          </span>
        </div>
        <!-- Action -->
        <div>
          <a href="../list/index.php" class="btn btn-success btn-sm" style="width:100%">List Sourcing</a>
        </div>
      </div>
      <!-- Pending Sumary Report -->
      <div class="card" style="width:300px;height:105px;margin-top:15px">
        <!-- Title -->
        <div class="text-center fs-6 p-1 border-bottom" style="background-color:#f7f7eb">Pending Sumary Report</div>
        <!-- Result -->
        <div class="d-flex align-items-center position-relative border-bottom" style="height:120px;background-color:#bbfcd6">
          <span class="position-absolute top-50 start-50 translate-middle fs-4">
            <?php
              $countSumaryReport= $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE sumaryReport IS NULL")->fetchAll();
              echo $countSumaryReport[0][0] 
            ?>
          </span>
        </div>
        <!-- Action -->
        <div>
          <a href="../list/index.php" class="btn btn-success btn-sm" style="width:100%">List Sourcing</a>
        </div>
      </div>
  </div>

</div>

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['Status', '', { role: 'style' }],
  ['Done',<?php
    $countStatusDone = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusPengajuan='DONE'")->fetchAll();
    echo $countStatusDone[0][0] 
  ?>,'#14F384'],
  ['Open',<?php
    $countStatusOpen = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusPengajuan='OPEN'")->fetchAll();
    echo $countStatusOpen[0][0] 
  ?>, '#000099'],
  ['Re-Open',<?php
    $countStatusReopen = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusPengajuan='RE-OPEN'")->fetchAll();
    echo $countStatusReopen[0][0] 
  ?>, '#009999'],
  ['Drop',<?php
    $countStatusDrop = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusPengajuan='DROP'")->fetchAll();
    echo $countStatusDrop[0][0] 
  ?>, '#FFFF00'],
  ['Not Yet',<?php
    $countStatusNotYet = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusPengajuan='NOT YET'")->fetchAll();
    echo $countStatusNotYet[0][0] 
  ?>, '#CC0000']
]);

var options = {
  title:'Sourcing Progress'
};

var chart = new google.visualization.BarChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>