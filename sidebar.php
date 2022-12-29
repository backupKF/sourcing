<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <!-- Sidebar -->
    <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-white bg-dark position-fixed" style="width: 217px;z-index:9999;">
        <!-- Title -->
        <h3 class="d-flex justify-content-center m-0">Kimia Farma</h3>
        <h6 class="d-flex justify-content-center">Digitalisasi Sourcing</h6>
        <hr>
        <!-- Navigation -->
        <ul class="nav nav-pills flex-column mb-auto mt-3">
            <!-- Opsi Pengajuan Sourcing -->
            <li class="nav-items">
                <a href="../dashboard/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='dashboard'){echo 'active';}?>" aria-current="page">
                    <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                    </svg>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            <!-- Opsi Pengajuan Sourcing -->
            <li class="nav-items">
                <a href="../pengajuan/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='pengajuan'){echo 'active';}?>" aria-current="page">
                    <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3Z" />
                    </svg>
                    <span class="ms-2">Pengajuan Sourcing</span>
                </a>
            </li>
            <!-- Opsi Riwayat Sourcing -->
            <li class="nav-items">
                <a href="/sourcing/riwayat/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='riwayat'){echo 'active';}?>" aria-current="page">
                    <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13.5,8H12V13L16.28,15.54L17,14.33L13.5,12.25V8M13,3A9,9 0 0,0 4,12H1L4.96,16.03L9,12H6A7,7 0 0,1 13,5A7,7 0 0,1 20,12A7,7 0 0,1 13,19C11.07,19 9.32,18.21 8.06,16.94L6.64,18.36C8.27,20 10.5,21 13,21A9,9 0 0,0 22,12A9,9 0 0,0 13,3" />
                    </svg>
                    <span class="ms-2">Riwayat Sourcing</span>
                </a>
            </li>
            <!-- Opsi View Sourcing -->
            <li class="nav-items">
                <a href="/sourcing/viewSourcing/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='view'){echo 'active';}?>" aria-current="page">
                    <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                    </svg>
                    <span class="ms-2">View Sourcing</span>
                </a>
            </li>
            <!-- Opsi List Sourcing -->
            <li class="nav-items">
                <a href="/sourcing/list/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='list'){echo 'active';}?>" aria-current="page">
                    <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3,4H7V8H3V4M9,5V7H21V5H9M3,10H7V14H3V10M9,11V13H21V11H9M3,16H7V20H3V16M9,17V19H21V17H9" />
                    </svg>
                    <span class="ms-2">List Sourcing</span>
                </a>
            </li>
        </ul>
    </div>
    
  </body>
</html>