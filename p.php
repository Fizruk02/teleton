<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use \parallel\{Runtime, Future, Channel, Events};

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

die();

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use app\Chat;

require __DIR__ . '/vendor/autoload.php';
foreach(['Chat', 'Db', 'Models', 'Session', 'TG'] as $s) require __DIR__ . '/app/'.$s.'.php';

$client = new Chat;

//$app = new Ratchet\App('5.181.108.172', 5000, '0.0.0.0');
$app = new Ratchet\App('127.0.0.1', 5000, '0.0.0.0');
$app->route('/chat', $client, array('*'));
$app->route('/oper', $client, array('*'));
$app->route('/echo', new Ratchet\Server\EchoServer, array('*'));
$app->run();
