<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <!-- Sidebar -->
        <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-white bg-dark position-fixed" style="width: 235px;z-index:10;">
            <!-- Title -->
            <h3 class="d-flex justify-content-center m-0">Kimia Farma</h3>
            <h6 class="d-flex justify-content-center">Digitalisasi Sourcing</h6>
            <hr class="m-0">
            
        <!-- Navigation -->
        <ul class="nav nav-pills flex-column mb-auto mt-5">
            <!-- Opsi Pengajuan Sourcing -->
            <li class="nav-items">
                <a href="../pengajuan/index.php" class="nav-link text-white <?php if($currentPage =='pengajuan'){echo 'active';}?>" aria-current="page">
                    <i class="fa fa-plus-square"></i>
                    <span class="ms-2">Pengajuan Sourcing</span>
                </a>
            </li>
            <!-- Opsi Riwayat Sourcing -->
            <li class="nav-items">
                <a href="/sourcing/riwayat/index.php" class="nav-link text-white <?php if($currentPage =='riwayat'){echo 'active';}?>" aria-current="page">
                    <i class="fa fa-history"></i>
                    <span class="ms-2">Riwayat Sourcing</span>
                </a>
            </li>
            <!-- Opsi List Sourcing -->
            <li class="nav-items">
                <a href="/sourcing/listProc/index.php" class="nav-link text-white <?php if($currentPage =='list'){echo 'active';}?>" aria-current="page">
                    <i class="fa fa-list"></i>
                    <span class="ms-2">List Sourcing</span>
                </a>
            </li>
            <!-- Opsi List Sourcing -->
            <li class="nav-items d-none">
                <a href="/sourcing/list/index.php" class="nav-link text-white <?php if($currentPage =='list'){echo 'active';}?>" aria-current="page">
                    <i class="fa fa-list"></i>
                    <span class="ms-2">List Sourcing</span>
                </a>
            </li>
        </ul>
    </div>
    
  </body>
</html>