<?php
// me-redirect saat user masuk kehalaman ini
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Location: dashboard/index.php');
    exit();
};

$serverName = "localhost";
$database = "rcproject";
$uid = 'SA';
$pwd = '@kimiaFarma';

try {
    $conn = new PDO(
        "sqlsrv:server=$serverName;Database=$database;TrustServerCertificate=1",
        $uid,
        $pwd,
        array(
            //PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
     $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
}
catch(PDOException $e) {
    die("Error connecting to SQL Server: " . $e->getMessage());
}
?>