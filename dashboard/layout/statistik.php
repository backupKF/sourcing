<?php
  // me-redirect saat user masuk kehalaman ini
  if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Location: ../../dashboard/index.php');
    exit(); 
  };
?>

<div class="statistik">
  <h2 style="font-family:'poppinsBold'" class="mt-5 mb-3">Selamat Datang, <?php echo $_SESSION['user']['name']?></h2>

  <div class="row">
    <div class="row p-0">
      <!-- Card Status Done -->
      <div class="col-2">
        <a href="tabelInfo.php?status=Done" style="text-decoration:none;color:black">
          <div class="card shadow mb-3 bg-body rounded" style="height:105px">
            <div class="card-body p-0">
              <!-- Title -->
              <h6 class="text-center p-1" style="background-color:#9cff9d;font-family:'poppinsRegular'">Done</h6>
              <!-- Count Result -->
              <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                <span class="position-absolute top-50 start-50 translate-middle">
                  <?php
                    $countStatusDoneMaterial = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 AND statusSourcing='DONE'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusDoneMaterial[0][0]." Material</span><br>";
                    $countStatusDoneSupplier = $conn->query("SELECT COUNT(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND statusSourcing='DONE'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusDoneSupplier[0][0]." Supplier</span><br>";
                   ?>
                </span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- Card Status Open -->
      <div class="col-2">
        <a href="tabelInfo.php?status=Open" style="text-decoration:none;color:black">
          <div class="card shadow mb-3 bg-body rounded" style="height:105px">
            <div class="card-body p-0">
              <!-- Title -->
              <h6 class="text-center p-1" style="background-color:#7380fa;font-family:'poppinsRegular'">Open</h6>
              <!-- Count Result -->
              <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                <span class="position-absolute top-50 start-50 translate-middle">
                  <?php
                    $countStatusOpenMaterial = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 AND statusSourcing='OPEN'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusOpenMaterial[0][0]." Material</span><br>";
                    $countStatusOpenSupplier = $conn->query("SELECT COUNT(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND statusSourcing='OPEN'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusOpenSupplier[0][0]." Supplier</span><br>";
                   ?>
                </span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- Status Re-Open -->
      <div class="col-2">
        <a href="tabelInfo.php?status=Re-Open" style="text-decoration:none;color:black">
          <div class="card shadow mb-3 bg-body rounded" style="height:105px">
            <div class="card-body p-0">
              <!-- Title -->
              <h6 class="text-center p-1" style="background-color:#a1ecff;font-family:'poppinsRegular'">Re-Open</h6>
              <!-- Count Result -->
              <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                <span class="position-absolute top-50 start-50 translate-middle">
                  <?php
                    $countStatusReopenMaterial = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 AND statusSourcing='RE-OPEN'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusReopenMaterial[0][0]." Material</span><br>";
                    $countStatusReopenSupplier = $conn->query("SELECT COUNT(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND statusSourcing='RE-OPEN'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusReopenSupplier[0][0]." Supplier</span><br>"; 
                   ?>
                </span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- Status Drop -->
      <div class="col-2">
        <a href="tabelInfo.php?status=Drop" style="text-decoration:none;color:black">
          <div class="card shadow mb-3 bg-body rounded" style="height:105px">
            <div class="card-body p-0">
              <!-- Title -->
              <h6 class="text-center p-1" style="background-color:#bd7aff;font-family:'poppinsRegular'">Drop</h6>
              <!-- Count Result -->
              <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                <span class="position-absolute top-50 start-50 translate-middle">
                  <?php
                    $countStatusDropMaterial = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 AND statusSourcing='DROP'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusDropMaterial[0][0]." Material</span><br>";
                    $countStatusDropSupplier = $conn->query("SELECT COUNT(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND statusSourcing='DROP'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusDropSupplier[0][0]." Supplier</span><br>"; 
                   ?>
                </span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- Status Not Yet -->
      <div class="col-2">
        <a href="tabelInfo.php?status=Not Yet" style="text-decoration:none;color:black">
          <div class="card shadow mb-3 bg-body rounded" style="height:105px">
            <div class="card-body p-0">
              <!-- Title -->
              <h6 class="text-center p-1" style="background-color:#ff6040;font-family:'poppinsRegular'">Not Yet</h6>
              <!-- Count Result -->
              <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                <span class="position-absolute top-50 start-50 translate-middle">
                  <?php
                    $countStatusNotYetMaterial = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 AND statusSourcing='NOT YET'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusNotYetMaterial[0][0]." Material</span><br>";
                    $countStatusNotYetSupplier = $conn->query("SELECT COUNT(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND statusSourcing='NOT YET'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusNotYetSupplier[0][0]." Supplier</span><br>";  
                   ?>
                </span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!-- Status Hold -->
      <div class="col-2">
        <a href="tabelInfo.php?status=Hold" style="text-decoration:none;color:black">
          <div class="card shadow mb-3 bg-body rounded" style="height:105px">
            <div class="card-body p-0">
              <!-- Title -->
              <h6 class="text-center p-1" style="background-color:#f72a34;font-family:'poppinsRegular'">Hold</h6>
              <!-- Count Result -->
              <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                <span class="position-absolute top-50 start-50 translate-middle">
                  <?php
                    $countStatusHoldMaterial = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 AND statusSourcing='HOLD'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusHoldMaterial[0][0]." Material</span><br>";
                    $countStatusHoldSupplier = $conn->query("SELECT COUNT(*) FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE feedbackRPIC=1 AND statusSourcing='HOLD'")->fetchAll();
                    echo "<span style='font-size:13px;font-family:poppinsMedium'>".$countStatusHoldSupplier[0][0]." Material</span><br>"; 
                   ?>
                </span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!--  -->
    </div>
  </div>

  <div class="row">
    <!-- Baris Statistik, Card Total Sourcing dan Card Pending Sumary Report -->

      <div class="col-8 p-0">
        <!-- Card Graph -->
          <div class="card shadow" style="width:100%">
              <div id="myChart" style="width:100%;height:250px;"></div>
          </div>
        <!--  -->
      </div>

      <div class="col-4">
        <div class="row">
           <!-- Card Total Sourcing -->
          <div class="col p-0">
            <a href="#" style="text-decoration:none;color:black">
              <div class="card shadow mb-3 ms-3 bg-body rounded card-sourcing-sumary">
                <div class="card-body p-0">
                  <!-- Title -->
                  <h6 class="text-center p-1" style="background-color:#e6ffed;font-family:'poppinsRegular'">Total Sourcing</h6>
                  <!-- Count Result -->
                  <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                    <span class="position-absolute top-50 start-50 translate-middle">
                      <?php
                        $countTotalSourcing= $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE feedbackRPIC=1")->fetchAll();
                        echo "<span style='font-size:15px;font-family:poppinsMedium'>".$countTotalSourcing[0][0]." Sourcing</span><br>"; 
                      ?>
                    </span>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!--  -->
        </div>

        <div class="row">
          <!-- Card Pending Sumary Report -->
          <div class="col p-0">
          <a href="#" style="text-decoration:none;color:black">
            <div class="card shadow mb-3 ms-3 bg-body rounded card-sourcing-sumary">
              <div class="card-body p-0">
                <!-- Title -->
                <h6 class="text-center p-1" style="background-color:#ffa1a1;font-family:'poppinsRegular'">Pending Sumary Report</h6>
                <!-- Count Result -->
                <div class="d-flex align-items-center position-relative" style="height:75px;background-color:#fdfff5">
                  <span class="position-absolute top-50 start-50 translate-middle">
                    <?php
                      $countSumaryReport= $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE sumaryReport LIKE '' AND feedbackRPIC=1")->fetchAll();
                      echo "<span style='font-size:15px;font-family:poppinsMedium'>".$countSumaryReport[0][0]." Sourcing</span><br>"; 
                    ?>
                  </span>
                </div>
              </div>
            </div>
          </a>
          </div>
          <!--  -->
        </div>
      </div>
  </div>
</div>

<style>
  .card{
    box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
    transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
    cursor: pointer;
  }

  .card:hover{
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
  }
</style>

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['Status', 'Result', { role: 'style' }],
  ['Done',<?php
    $countStatusDone = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusSourcing='DONE'")->fetchAll();
    $result = ($countStatusDone[0][0]/$countTotalSourcing[0][0])*100;
    echo $result; 
  ?>,'#9cff9d'],
  ['Open',<?php
    $countStatusOpen = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusSourcing='OPEN'")->fetchAll();
    $result = ($countStatusOpen[0][0]/$countTotalSourcing[0][0])*100;
    echo $result;
  ?>, '#7380fa'],
  ['Re-Open',<?php
    $countStatusReopen = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusSourcing='RE-OPEN'")->fetchAll();
    $result = ($countStatusReopen[0][0]/$countTotalSourcing[0][0])*100;
    echo $result;
  ?>, '#a1ecff'],
  ['Drop',<?php
    $countStatusDrop = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusSourcing='DROP'")->fetchAll();
    $result = ($countStatusDrop[0][0]/$countTotalSourcing[0][0])*100;
    echo $result;
  ?>, '#bd7aff'],
  ['Not Yet',<?php
    $countStatusNotYet = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusSourcing='NOT YET'")->fetchAll();
    $result = ($countStatusNotYet[0][0]/$countTotalSourcing[0][0])*100;
    echo $result;
  ?>, '#ff6040'],
  ['Hold',<?php
    $countStatusHold = $conn->query("SELECT COUNT(*) FROM TB_PengajuanSourcing WHERE statusSourcing='HOLD'")->fetchAll();
    $result = ($countStatusHold[0][0]/$countTotalSourcing[0][0])*100;
    echo $result; 
  ?>, '#f72a34']
]);

var options = {
  title:'Sourcing Progress (%)'
};

var chart = new google.visualization.BarChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>