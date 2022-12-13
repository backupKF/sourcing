<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Login</title>
    </head>
    <body class="bg-dark bg-opacity-10">
        <div style="height:100vh position-relative">
            <div class="card position-absolute top-50 start-50 translate-middle" style="width:450px;height:300px">
                <div class="text-center fs-3 mt-2">Login</div>
                <div class="card-body">
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
                <button class="btn btn-primary text-center position-absolute bottom-0 start-50 translate-middle-x mb-3" style="width:350px">
                    Login
                </button>
            </div>
        </div>
    </body>
</html>