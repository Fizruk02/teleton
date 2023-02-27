<?php
    if(isset($_COOKIE['ushash'])){
        $hash=$_COOKIE['ushash'];
    } else {
        $hash=bin2hex(random_bytes(20));
        setcookie("ushash", $hash, time()+3600*24, '/user');
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Клиент</title>
    <meta name="viewport" content="width=device-width">
    <link href="/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
<div class="chat-section">
    <div class="chat-container">
        <div class="chat-head">
            <div class="chat-head-title">Чат виджет</div><div class="close">&#10006;</div>
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
            </div>
        </div>
    </div>
</div>
<img class="message-new" src="/files/new.png">
<div class="feedback" data-chwgtdshow="feedback">Написать</div>
<script>user={hash:"<?php echo $hash; ?>",oper:0,}</script>
<script src="/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>