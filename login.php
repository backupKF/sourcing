<?php
    session_start();

    // me-redirent ke opsi dashboard ketika user sudah login
    if(isset($_SESSION['login'])){
        header("Location: dashboard/index.php");
        exit();
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="plugin/font/css/font.css" rel="stylesheet"/>
        <link href="plugin/bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="plugin/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="plugin/jquery/jquery.min.js"></script>

        <title>Login</title>

    </head>
    <body class="bg-dark bg-opacity-10">
        <div class="card position-absolute top-50 start-50 translate-middle" style="width:450px;height:300px">
             <!-- Title -->
            <div class="text-center fs-3 mt-2" style="font-family:'poppinsBold'">Login</div>
            <div class="card-body">
                <!-- Form Login -->
                <form action="controller/authenticate.php" method="POST" autocomplete="off">
                    <div class="mb-3 row">
                        <!-- Input Username -->
                        <div class="col">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                            <span style="font-size:15px;" class="text-danger"><?php echo (!empty($_SESSION['message'])?'* '.$_SESSION['message']:'')?></span>
                        </div>
                    </div>
                        
                    <div class="mb-3 row">
                        <!-- Input Password -->
                        <div class="col">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <span style="font-size:15px;" class="text-danger"><?php echo (!empty($_SESSION['message'])?'* '.$_SESSION['message']:'')?></span>
                        </div>
                    </div>
                </div>
                <!-- Button Submit -->
                <div class="text-center">
                    <input type="submit" value="Submit" name="login" class="btn btn-primary mb-2" style="width:400px">
                </div>
            </form>
        </div>
    </body>
</html>
<?php
    // Menghapus session message
    unset($_SESSION['message']);
?>