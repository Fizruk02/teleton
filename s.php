<?php

phpinfo();
exit;

$runtime = new \parallel\Runtime();

$future = $runtime->run(function(){
    for ($i = 0; $i < 500; $i++)
        echo "*";

    return "easy";
});

for ($i = 0; $i < 500; $i++) {
    echo ".";
}

printf("\nUsing \\parallel\\Runtime is %s\n", $future->value());


exit;


session_start();
var_dump($_SESSION);
echo 'sess id2 - ' . session_id() . "\n";
echo "Session Save Path: "
    .
    ini_get
    (
        'session.save_path'
    );

if (isset($_SESSION['x'])) $_SESSION['x']++;
else $_SESSION['x'] = 10;
$_SESSION['y'] =['a'=>1,'b'=>'asf'];
//phpinfo();
//	/var/lib/php/session/sess_
//	/var/opt/remi/php80/lib/php/session/sess_
$f = implode('', @file('/var/opt/remi/php80/lib/php/session/sess_5hcp2l195038f5qlikpd3ce85f'));
var_dump($f);
var_dump(json_decode('{'.$f.'}'));
var_dump(session_decode($f));
var_dump($_SESSION);
