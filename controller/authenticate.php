<?php
    include "../dbConfig.php";
    session_start();

    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!empty($username) && !empty($password)){
            if($account = $conn->query("SELECT * FROM TB_Admin WHERE username='".$username."'")->fetchAll()){;
                if(password_verify($password, $account[0]['password'])){
                    // SET SESSION
                    $_SESSION['login'] = true;
                    $_SESSION['user']['id'] = $account[0]['id'];
                    $_SESSION['user']['name'] = $account[0]['username'];
                    $_SESSION['user']['level'] = $account[0]['level'];
                    $_SESSION['user']['teamLeader'] = $account[0]['teamLeader'];
                    header("Location: ../dashboard/index.php");
                }else{
                    $_SESSION['message'] = "Username atau Password Salah";
                    header("Location: ../login.php");
                }
            }else{
                $_SESSION['message'] = "Username atau Password Salah";
                header("Location: ../login.php");
            }
        }
    
        if(empty($username) || empty($password)){
            $_SESSION['message'] = "Silahkan masukan username dan password anda";
            header("Location: ../login.php");
        }
    }

    if(isset($_POST['changePassword'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword']; 

        if($username != $_SESSION['user']['name']){
            $account = $conn->query("SELECT username, password FROM TB_Admin WHERE username='".$username."'")->fetchAll();
            if($username != $account['user']['name']){
                $verify = password_verify($password, $account[0]['password']);
                if($verify == true){
                    if($newPassword == $confirmNewPassword){
                        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

                        $sql = "UPDATE TB_Admin SET username = ?, password = ?, WHERE id = ?";
                        $query = $conn->prepare($sql);
                        $update = $query->execute(array($username, $hash, $_SESSION['user']['id']));

                        if($update == true){
                            unset($_SESSION['user']['name']);
                            $_SESSION['user']['name'] = $username;
                            $_SESSION['message']['success'] = "Username dan Password berhasil diubah!";
                            header("Location: ../setting/index.php");
                        }
                    }else{
                        $_SESSION['message']['errorNewPassword'] = "Konfirmasi password baru tidak sesuai!!";
                        header("Location: ../setting/index.php");
                    }
                }else{
                    $_SESSION['message']['errorPassword'] = "Password tidak sesuai, silahkan coba lagi!!";
                    header("Location: ../setting/index.php");
                }
            }else{
                $_SESSION['message']['errorUsername'] = "Username sudah digunakan, silahkan coba lagi!!";
                header("Location: ../setting/index.php");
            }
        }else{
            $account = $conn->query("SELECT password FROM TB_Admin WHERE username='".$username."'")->fetchAll();
            $verify = password_verify($password, $account[0]['password']);

            if($verify == true){
                if($newPassword == $confirmNewPassword){
                    $hash = password_hash($newPassword, PASSWORD_DEFAULT);

                    $sql = "UPDATE TB_Admin SET password = ? WHERE id = ?";
                    $query = $conn->prepare($sql);
                    $update = $query->execute(array($hash, $_SESSION['user']['id']));

                    if($update == true){
                        $_SESSION['message']['success'] = "Password berhasil diubah!";
                        header("Location: ../setting/index.php");
                    }
                }else{
                    $_SESSION['message']['errorNewPassword'] = "Konfirmasi password baru tidak sesuai!!";
                    header("Location: ../setting/index.php");
                }
            }else{
                $_SESSION['message']['errorPassword'] = "Password tidak sesuai, silahkan coba lagi!!";
                header("Location: ../setting/index.php");
            }
        }
    }
?>