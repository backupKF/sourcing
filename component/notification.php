<?php
    include "../dbConfig.php";

    session_start();

    if(empty($_POST) && empty($_GET)){
        header('Location: ../dashboard/index.php');
    }

    if(isset($_POST['view'])){
        if($_POST['view'] != ''){
            $sql = "UPDATE TB_Notifications SET status = 1 WHERE status = 0";
            $query = $conn->prepare($sql);
            $update = $query->execute();
        }

        $notifications = $conn->query("SELECT * FROM TB_Notifications ORDER BY id DESC")->fetchAll();
        foreach($notifications as $data){
                $checkNotif = $conn->query("SELECT readingStatus FROM TB_StatusNotifications INNER JOIN TB_Notifications ON TB_StatusNotifications.idNotification = TB_Notifications.id WHERE idUser=".$_SESSION['user']['id']." AND idNotification=".$data['id'])->fetchAll();
                if(empty($checkNotif) || $checkNotif[0]['readingStatus'] == 0){
                    $output .= '
                        <div class="my-1">
                            <strong>'.$data['person'].'</strong>
                            <em>'.$data['message'].'<small><b>'.$data['subject'].'</b></small></em><br>
                            <sub class="m-0"><i> ~ '.time_elapsed_string($data['created']).'</i></sub><br>
                            <a href="../viewSourcing/detailSourcing.php?id='.$data['id'].'&idMaterial='.$data['idMaterial'].'&idSupplier='.$data['idSupplier'].'"><small>Lihat Selengkapnya...</small></a>
                        </div>
                        <hr>
                    ';
                }
        }

        if(empty($output)){
            $output .= '<li><a href="#" class="text-bold text-italic">Not Found</a></li>';
        }

        $status_notifications = $conn->query("SELECT * FROM TB_Notifications WHERE status = 0")->fetchAll();
        $count = count($status_notifications);

        $data = array(
            'notification' => $output,
            'unseen_notification' => $count,
        );

        echo json_encode($data);
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
?>
