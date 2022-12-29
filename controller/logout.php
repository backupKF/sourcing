<?php
    header("HTTP/1.1 403 Forbidden" );

    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: ../login.php")

?>