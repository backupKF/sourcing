<?php
    session_start();

    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: dashboard/index.php');
        exit();
    };
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <style>
    .sidebar{
        width: 217px;
        z-index:9999;
        background-color:#002b33;
        transition: 0.5s;
        transition-property: left;
    }
    .toggle-sidebar{
        width:35px;
        height:35px;
        background-color:#002b33;
        position:fixed;
        left:199px;
        border-radius:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        color:white;
        z-index:99999;
    }

    label #sidebar-btn:hover{
        color: #004852;
    }

    #check:checked ~ .sidebar{
        width: 70px;
    }

    #check:checked ~ .sidebar div.title-sidebar{
        display: none;
    }

    #check:checked ~ .sidebar span{
        display: none;
    }

    #check:checked ~ .sidebar a{
        padding: 10px;
        
    }

    #check:checked ~ .sidebar li{
        margin-right:100px;
    }

    #check:checked ~ .sidebar div#information-user{
        display: none;
    }

    #check:checked ~ .sidebar div a#action-logout{
        display:absolute;
        left:20px;
    }
    

  </style>

  <body>
    <input type="checkbox" id="check" class="d-none">

    <div class="toggle-sidebar">
        <label class="toggle-icon" for="check">
            <svg style="width:24px;height:24px" id="sidebar-btn" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
            </svg>
        </label>
    </div>


    <!-- Sidebar -->
    <div class="d-flex flex-column vh-100 text-white position-fixed sidebar">

        <!-- Title -->
        <div class="m-3 title-sidebar">
            <h4 class="d-flex justify-content-center" style="font-family:'poppinsSemiBold'">Kimia Farma</h4>
            <h6 class="d-flex justify-content-center" style="font-family:'poppinsMedium'">E-SOURCE</h6>
            <hr>
        </div>
        <!-- Navigation -->
        <ul class="nav nav-pills flex-column m-3 mb-auto mt-3">
            <!-- Opsi Dashboard -->
            <li class="nav-items">
                <a href="/sourcing/dashboard/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='dashboard'){echo 'active';}?>" aria-current="page">
                    <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                    </svg>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            <?php
                if($_SESSION['user']['level'] != 4){
                // User Proc tidak bisa mengakses halaman ini
            ?>
                <!-- Opsi Pengajuan Sourcing -->
                <li class="nav-items">
                    <a href="/sourcing/pengajuan/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='pengajuan'){echo 'active';}?>" aria-current="page">
                        <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3Z" />
                        </svg>
                        <span class="ms-2">Pengajuan Sourcing</span>
                    </a>
                </li>
            <?php
                }
                if($_SESSION['user']['level'] != 4){
                // User Proc tidak bisa mengakses halaman ini
            ?>
            <!-- Opsi Riwayat Sourcing -->
            <li class="nav-items">
                <a href="/sourcing/riwayat/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='riwayat'){echo 'active';}?>" aria-current="page">
                    <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13.5,8H12V13L16.28,15.54L17,14.33L13.5,12.25V8M13,3A9,9 0 0,0 4,12H1L4.96,16.03L9,12H6A7,7 0 0,1 13,5A7,7 0 0,1 20,12A7,7 0 0,1 13,19C11.07,19 9.32,18.21 8.06,16.94L6.64,18.36C8.27,20 10.5,21 13,21A9,9 0 0,0 22,12A9,9 0 0,0 13,3" />
                    </svg>
                    <span class="ms-2">Riwayat Sourcing</span>
                </a>
            </li>
            <?php
                }
            ?>
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
            <!-- Opsi Setting -->
            <li class="nav-items">
                <a href="/sourcing/setting/index.php" style="font-size:14px" class="nav-link text-white <?php if($currentPage =='setting'){echo 'active';}?>" aria-current="page">
                <svg style="width:16px;height:16px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8M12,10A2,2 0 0,0 10,12A2,2 0 0,0 12,14A2,2 0 0,0 14,12A2,2 0 0,0 12,10M10,22C9.75,22 9.54,21.82 9.5,21.58L9.13,18.93C8.5,18.68 7.96,18.34 7.44,17.94L4.95,18.95C4.73,19.03 4.46,18.95 4.34,18.73L2.34,15.27C2.21,15.05 2.27,14.78 2.46,14.63L4.57,12.97L4.5,12L4.57,11L2.46,9.37C2.27,9.22 2.21,8.95 2.34,8.73L4.34,5.27C4.46,5.05 4.73,4.96 4.95,5.05L7.44,6.05C7.96,5.66 8.5,5.32 9.13,5.07L9.5,2.42C9.54,2.18 9.75,2 10,2H14C14.25,2 14.46,2.18 14.5,2.42L14.87,5.07C15.5,5.32 16.04,5.66 16.56,6.05L19.05,5.05C19.27,4.96 19.54,5.05 19.66,5.27L21.66,8.73C21.79,8.95 21.73,9.22 21.54,9.37L19.43,11L19.5,12L19.43,13L21.54,14.63C21.73,14.78 21.79,15.05 21.66,15.27L19.66,18.73C19.54,18.95 19.27,19.04 19.05,18.95L16.56,17.95C16.04,18.34 15.5,18.68 14.87,18.93L14.5,21.58C14.46,21.82 14.25,22 14,22H10M11.25,4L10.88,6.61C9.68,6.86 8.62,7.5 7.85,8.39L5.44,7.35L4.69,8.65L6.8,10.2C6.4,11.37 6.4,12.64 6.8,13.8L4.68,15.36L5.43,16.66L7.86,15.62C8.63,16.5 9.68,17.14 10.87,17.38L11.24,20H12.76L13.13,17.39C14.32,17.14 15.37,16.5 16.14,15.62L18.57,16.66L19.32,15.36L17.2,13.81C17.6,12.64 17.6,11.37 17.2,10.2L19.31,8.65L18.56,7.35L16.15,8.39C15.38,7.5 14.32,6.86 13.12,6.62L12.75,4H11.25Z" />
                </svg>
                    <span class="ms-2">Setting</span>
                </a>
            </li>
        </ul>

        <!-- Information Account -->
        <hr class="m-0">

        <div class="my-3">
            <div class="row">
                <div class="col-10 ps-5" id="information-user">
                    <div class="text-center" style="font-family:'poppinsSemiBold';font-size:18px;"><?php echo $_SESSION['user']['name']?></div>
                    <div class="text-center" style="font-family:'poppinsThin';font-size:14px;"><?php echo $_SESSION['user']['teamLeader']?></div>
                </div>
                <!-- Action Logout -->
                <div class="col-2 p-0 d-flex align-items-center">
                    <a href="../controller/logout.php" class="text-white" id="action-logout">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
    
  </body>
</html>