<?php
    if(isset($_COOKIE['ushash'])){
        $hash=$_COOKIE['ushash'];
    } else {
        $hash=bin2hex(random_bytes(20));
        setcookie("ushash", $hash, time()+3600*24, '/operator');
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Оператор</title>
    <meta name="viewport" content="width=device-width">
    <link href="/css/style.css?v=<?php echo time()?>" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="chat-section-oper">
        <div class="chat-container">
            <div class="chat-head">
                <div class="chat-head-title">Чат виджет</div><div></div>
                <span class="chat-connect"></span>
            </div>
            <div class="chat-error"></div>
            <div class="chat-area">
                <div id="chatBox" class="chat-box"> </div>
                <div class="button-line">
                    <span class="chat-process"></span>
                    <div class="bot-form">
                        <div class="textarea">
                            <div contenteditable="true" class="bot-chat-text-send"></div>
                        </div>
                        <div class="bot-btn"> </div>
                    </div>
                    <div class="chat-controls">
                        <div class="btn-control" onclick="wgc.session.end()">закрыть обращение</div>
                        <div class="btn-control" onclick="wgc.form.contacts.start()">запросить контакты</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>user={hash:"<?php echo $hash; ?>",oper:1,}</script>
<script src="/js/script.js?v=<?php echo time()?>"></script>
</body>
</html>