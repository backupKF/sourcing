<?php
    session_start();

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
        <link href="plugin/bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="plugin/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="plugin/jquery/jquery.min.js"></script>

        <title>Login</title>

    </head>
    <body class="bg-dark bg-opacity-10">
        <div style="height:100vh position-relative">
            <div class="card position-absolute top-50 start-50 translate-middle" style="width:450px;height:300px">
                <div class="text-center fs-3 mt-2">Login</div>
                <div class="card-body">
                    <form action="controller/authenticate.php" method="POST">
                        <div class="mb-3 row">
                            <div class="col">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Submit" name="submit" class="btn btn-primary mb-2" style="width:400px">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>