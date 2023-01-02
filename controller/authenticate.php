<?php
    include "../dbConfig.php";
    session_start();

    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!empty($username) && !empty($password)){
            if($account = $conn->query("SELECT * FROM TB_Admin WHERE username='".$username."' AND password='".$password."'")->fetchAll()){
                // echo "Selamat Datang ".$account[0]['username'];

                // SET SESSION
                $_SESSION['login'] = true;
                $_SESSION['user']['id'] = $account[0]['id'];
                header("Location: ../dashboard/index.php");
            }else{
                echo "Username atau Password Salah..";
            }
        }
    
        if(empty($username) || empty($password)){
            echo "Silahkah masukan username dan password anda";
        }
    }
?>