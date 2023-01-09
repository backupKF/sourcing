<?php
    include "../dbConfig.php";
    session_start();

    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    if(isset($_POST['login'])){
        $username = trim(strip_tags($_POST['username']));
        $password = trim(strip_tags($_POST['password']));
        if(!empty($username) && !empty($password)){
            if($account = $conn->query("SELECT * FROM TB_Admin WHERE username='".$username."'")->fetchAll()){
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
        $username = trim(strip_tags($_POST['username']));
        $password = trim(strip_tags($_POST['password']));
        $newPassword = trim(strip_tags($_POST['newPassword']));
        $confirmNewPassword = trim(strip_tags($_POST['confirmNewPassword']));

        if($username != $_SESSION['user']['name']){
            $checkAccount = $conn->query("SELECT username, password FROM TB_Admin WHERE username='".$username."'")->fetchAll();
            $passwordAccount = $conn->query("SELECT password FROM TB_Admin WHERE id=".$_SESSION['user']['id'])->fetchAll();
            if($username != $checkAccount[0]['username']){
                $verify = password_verify($password, $passwordAccount[0]['password']);
                if($verify == true){
                    if($newPassword == $confirmNewPassword){

                        if($newPassword == "" || $confirmNewPassword == ""){
                            $_SESSION['message']['errorNewPassword'] = "Password dan Confirm password kosong";
                            header("Location: ../setting/index.php");
                        }else{
                            $hash = password_hash($newPassword, PASSWORD_DEFAULT);

                            $sql = "UPDATE TB_Admin SET username = ?, password = ? WHERE id = ?";
                            $query = $conn->prepare($sql);
                            $update = $query->execute(array($username, $hash, $_SESSION['user']['id']));

                            if($update == true){
                                unset($_SESSION['user']['name']);
                                $_SESSION['user']['name'] = $username;
                                $_SESSION['message']['success'] = "Username dan Password berhasil diubah!";
                                header("Location: ../setting/index.php");
                            }
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
            $passwordAccount = $conn->query("SELECT password FROM TB_Admin WHERE username='".$username."'")->fetchAll();
            $verify = password_verify($password, $passwordAccount[0]['password']);

            if($verify == true){
                if($newPassword == "" || $confirmNewPassword == ""){
                    $_SESSION['message']['errorNewPassword'] = "Password dan Confirm password kosong";
                    header("Location: ../setting/index.php");
                }else{
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
                }
            }else{
                $_SESSION['message']['errorPassword'] = "Password tidak sesuai, silahkan coba lagi!!";
                header("Location: ../setting/index.php");
            }
        }
    }
?>