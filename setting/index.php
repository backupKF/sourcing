<?php
$currentPage = 'setting';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../plugin/font/css/font.css" rel="stylesheet"/>
    <link href="../plugin/bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../plugin/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../plugin/jquery/jquery.min.js"></script>

    <title>Setting</title>

    <style>
        .container{
            margin-left:450px;
            margin-top:50px;
        }
        .card{
            width:450px;
            height:500px;
        }
    </style>

</head>
<body style="overflow-x: hidden;">
    <!-- Sidebar -->
    <?php require "../sidebar.php" ?>
    
    <!-- Navbar -->
    <?php require "../navbar.php"?>
    
    <br>
    
    <div class="container">
        <div class="card shadow bg-body rounded">
            <div class="text-center fs-3 mt-2" style="font-family:'poppinsBold'">Change Password</div>
            <div class="card-body">
                <div class="text-center text-success" style="font-family:poppinsSemiBold;font-size:12px"><?php echo (!empty($_SESSION['message']['success'])?'* '.$_SESSION['message']['success']:'')?></div>
                <form action="../controller/authenticate.php" method="POST">
                    <div class="mb-3 row">
                        <div class="col">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $_SESSION['user']['name']?>">
                            <span style="font-size:15px;" class="text-danger"><?php echo (!empty($_SESSION['message']['errorUsername'])?'* '.$_SESSION['message']['errorUsername']:'')?></span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            <span style="font-size:15px;" class="text-danger"><?php echo (!empty($_SESSION['message']['errorPassword'])?'* '.$_SESSION['message']['errorPassword']:'')?></span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password">
                            <span style="font-size:15px;" class="text-danger"><?php echo (!empty($_SESSION['message']['errorNewPassword'])?'* '.$_SESSION['message']['errorNewPassword']:'')?></span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <input type="password" class="form-control" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm New Password">
                            <span style="font-size:15px;" class="text-danger"><?php echo (!empty($_SESSION['message']['errorNewPassword'])?'* '.$_SESSION['message']['errorNewPassword']:'')?></span>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" value="Submit" name="changePassword" class="btn btn-primary mb-2" style="width:400px">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    unset($_SESSION['message']);
?>