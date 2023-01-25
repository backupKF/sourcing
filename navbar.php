<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: dashboard/index.php');
        exit();
    };
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-light shadow" style="background-color:#e3fbff">
    <div class="container-fluid">
        <div></div>
        <div class="nav navbar-nav navbar-right">
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <!-- Informasi jumlah notif yang baru dan belum dibaca -->
                <span class="bg-danger text-light text-center position-absolute d-none count" style="border-radius:100%;min-width:20px;min-height:20px;font-size:13px;font-family:poppinsMedium;z-index:20;right:40px;bottom:25px"></span>
                <!-- -- -->
                
                <ul class="navbar-nav" style="z-index:20">
                    <li class="nav-item">
                        <!-- Button icon lonceng -->
                        <a id="bell_notif" class="btn toggle">
                            <svg style="width:18px;height:18px;" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M10 21H14C14 22.1 13.1 23 12 23S10 22.1 10 21M21 19V20H3V19L5 17V11C5 7.9 7 5.2 10 4.3V4C10 2.9 10.9 2 12 2S14 2.9 14 4V4.3C17 5.2 19 7.9 19 11V17L21 19M17 11C17 8.2 14.8 6 12 6S7 8.2 7 11V18H17V11Z" />
                            </svg>
                        </a>
                        <!-- -- -->
                        
                        <!-- Content Notif yang diambil dari file /component/notifikasi melalui fungsi jquery load_unseen_notification -->
                        <div style="display:none" class="alert_list">
                            <div class="content-notif"></div>
                        </div>
                        <!-- -- -->
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    .popover-body {
        height: 400px;
        width: 300px;
        overflow-y: auto;
    }
</style>

<script>
    $(document).ready(function(){
        // Fungsi untuk mengelola informasi notifikasi
        function load_unseen_notification(view = '', idNotif = ''){
            $.ajax({
                url: '../component/notification.php',
                method: 'POST',
                data: {view: view, idNotif: idNotif},
                dataType: 'json',
                success: function(data){

                    $('.content-notif').html(data.notification);

                    $("#bell_notif").popover({
                        'title' : 'Notifikasi', 
                        'html' : true,
                        'placement' : 'bottom',
                        'content' : $(".alert_list").html()
                    });
                    
                    if(data.unseen_notification > 0){
                        $('.count').html(data.unseen_notification);
                        $('.count').removeClass('d-none')
                    }
                }
            })
        }

        // Memanggil fungsi load_unseen_notification
        load_unseen_notification()

        // Fungsi jquery untuk melakukan action ketika icon lonceng di click
        $(document).on('click', '.toggle', function(){
            $('.count').html('');
            $('.count').addClass('d-none')
            load_unseen_notification('yes','<?php echo $_GET['rs']?>')
        });

        // Fungsi untuk mereload data notif setiap 3 detik
        setInterval(() => {
            load_unseen_notification();
        }, 10000);

    })
</script>