<?php

require __DIR__ . '/../vendor/autoload.php';

$json = file_get_contents('php://input');
if(!$json) exit;
foreach(['Db', 'TG'] as $s) require $_SERVER['DOCUMENT_ROOT'] . '/app/'.$s.'.php'; //, 'Models', 'TG'
use app\Db;
use app\TG;
ini_set('display_errors', true);
$obj = json_decode($json, true);

$tg = new TG;
$db = new Db;
$db-> connect();
//file_put_contents(__DIR__.'/'.uniqid().'.txt', print_r($obj,1));



if(isset($obj['message']['is_automatic_forward'])) {
    
    $from_message_id=$obj['message']['forward_from_message_id'];
    $from_chat_id=$obj['message']['forward_from_chat']['id'];
    
    $chat_id=$obj['message']['chat']['id'];
    $message_id=$obj['message']['message_id'];
    
    $db-> update('UPDATE `sessions` SET `comment_channel_id`=?, comment_message_id=? WHERE `channel_id`=? AND `message_id`=?',
                [ $chat_id, $message_id, $from_chat_id, $from_message_id ]);
                
                
    
}


if(isset($obj['callback_query'])) {
    $cb=json_decode($obj['callback_query']['data'],1);
    
    $dt=$obj['callback_query']['message']['reply_to_message'];

    $chat_id=$dt['forward_from_chat']['id'];
    $message_id=$dt['forward_from_message_id'];

    $user=$obj['callback_query']['from'];

    $userId=getUserId( $user );
    $session=getSession($chat_id, $message_id);
    setStatus( $session );

    if(!$session) return;

    switch($cb['mtd']) {
        case 'getContacts':
            $p=[
                    'type' => 'command',
                    'mess' => 'getContacts',
                    'payload'=> [],
                    'sessionId'=> $session['id'],
                    'userId'=> $userId
                ];
            
        
            send( $p );
            $tg-> sendMessage( [
                'chat_id'=> $session['comment_channel_id'],
                'text'=> 'Запрошены контакты',
                'reply_to_message_id'=> $session['comment_message_id']
            ] );
        break;
        
        
        case 'setProccess':
            $p=[
                    'type' => 'notify',
                    'mess' => 'proccess',
                    'payload'=> [],
                    'sessionId'=> $session['id'],
                    'userId'=> $userId
                ];
            send( $p );
        break;
        
        
    }
    


    $tg->answerCallbackQuery('', $obj['callback_query']['id']);
}


if(isset($obj['message']['reply_to_message'])) {
    
    $dt=$obj['message']['reply_to_message'];
    $chat_id=$dt['forward_from_chat']['id'];
    $message_id=$dt['forward_from_message_id'];

    $user=$obj['message']['from'];
    $userId=getUserId( $user );
    $session=getSession($chat_id, $message_id);
    setStatus( $session );
    if(!$session) return;
    
    $p=[
            'type' => 'tgmessage',
            'mess' => $obj['message']['text'],
            'sessionId'=> $session['id'],
            'userId'=> $userId
        ];
    

    send( $p );
    
}

function send( $par ){
    try {
        
        \Ratchet\Client\connect('wss://admin-testchat.host2bot.ru/ws/chat')->then(function($conn) use($par) {
            $conn->send(json_encode($par));
            $conn->close();
        }, function ($e) {
            $msg = "Could not connect: {$e->getMessage()}\n";
            echo $msg;
        });

    } catch (\Exception $e) {
        file_put_contents(__DIR__.'/err.txt', "ERROR: ".$e->getMessage().PHP_EOL, FILE_APPEND);
        echo $e->getMessage().PHP_EOL;
    }
}

function getSession($chat_id, $message_id){
    global $db;
    return $db-> single('SELECT * FROM `sessions` WHERE channel_id=? AND message_id=?', [ $chat_id, $message_id ]);
}

function setStatus( $session ){
    global $tg;
    $text='СЕССИЯ '.$session['id'].PHP_EOL.PHP_EOL.
    'Статус: ответ получен ✅️';
    
    $tg->edit_message($text, false, $session['channel_id'], $session['message_id']);
}

function getUserId( $user ){
    global $db;
    if(!$userData=$db-> single('SELECT * FROM `users` WHERE telegram_id=?', [ $user['id'] ])){
        $userId = $db-> insert('INSERT INTO `users` (`hash`, `operator`, `name`, `online`, `telegram_id`, `username`, `first_name`) VALUES ("",1,?,1,?,?,?)', 
            [ $user['first_name'], $user['id'], $user['username']??"", $user['first_name'] ]);
    } else {
        $userId=$userData['id'];
    }
    return $userId;
}

function qwe($d){
    file_put_contents(__DIR__.'/log.txt', is_array($d)?print_r($d,1):$d);
}












