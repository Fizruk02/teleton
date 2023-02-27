<?php
namespace app;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/**
 * Отправляем сообщение всем подключенным клиентам, кроме отправителя
 */
class Chat implements MessageComponentInterface {
    protected $owner;
    protected $clients;
    protected $session;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->session = new Session;
        
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->owner = $conn;
        //print_r($conn);
        $this->clients->attach( $conn );
        echo 'CONNECT'.PHP_EOL;
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        if (!$data) return;
        
        
        echo 'ONMESSAGE'.PHP_EOL;
        //print_r($data);
        
        

        if(isset($data->hash))
            $this->session->start( $data->hash, $data->oper );
        elseif(isset($data->sessionId))
            $this->session->startById( $data->sessionId, $data->userId );
            
            
        
        if ($data->type == 'command') {
            foreach ($this->clients as $client) {
                if ($from == $client) {
                    $resp = [
                        'type' => $data->type,
                        'mess' => $data->mess,
                        'result' => true,
                    ];
                    $client->send(json_encode($resp));
                    
                    switch ($data->mess) {
                        case 'init':
                            $this->session->online( true );
                            
                            $respNtf = [
                                'type' => 'notify',
                                'mess' => 'connected',
                                'name'=> $this->session->user['name'],
                            ];
                            $this->sendAll( $respNtf, $from );
                            
                            $client->send(json_encode([
                                'type' => 'command',
                                'mess' => 'loadHistory',
                                'messages'=> $this->session->getMessages(),
                                ]));
                            
                            break;

                            
                        case 'issueResolved':
                        case 'issueNotResolved':
                        case 'getContacts':
                        case 'endSession':

                            $respNtf = [
                                'type' => 'notify',
                                'mess' => $data->mess,
                                'payload' => $data->payload,
                                'name'=> $this->session->user['name'],
                            ];
                            $this->sendAll( $respNtf, $from );

                            break;
                            
                        case 'sendFields':

                            //$respNtf = [
                            //    'type' => 'notify',
                            //    'mess' => $data->mess,
                            //    'payload' => $data->payload,
                            //    'name'=> $this->session->user['name'],
                            //];
                            
                            
                            $r=array_map(function($it){
                                return $it->id.': '.$it->val;
                            }, $data->payload);
                            
                            $t='КОНТАКТЫ:'.PHP_EOL.implode(PHP_EOL,$r);
                            
                            $this->session->sendMess( $t );

                            break;
                           

                            
                    }

                }
            }
        } elseif ($data->type == 'message') {
            $resp = [
                'type' => 'message',
                'mess' => $data->mess,
            ];
            //$this->sendAll( $resp, $from );
            $this->session->sendMess( $data->mess );

        } elseif ($data->type == 'notify') {
            $resp = [
                'type' => $data->type,
                'mess' => 'proccess',
                'name'=> $this->session->user['name'],
            ];
            
            $this->session->sendTyping( );
            //$this->sendAll( $resp, $from );
            
        } elseif ($data->type == 'tgmessage') {
            $respNtf = [
                'type' => 'notify',
                'mess' => 'connected',
                'name'=> $this->session->user['name'],
            ];
            $this->sendAll( $respNtf, $from );
            
            
            
            $resp = [
                'type' => 'message',
                'mess' => $data->mess,
            ];
            $this->sendAll($resp, $from);
            
            $this->session->recordMess(
                $data->mess
                );
            
            //$this->session->sendMess($data->mess);
        }
        
        
      
        

    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach( $conn );
        $this->session->online( false );
        //
        //$resp = [
        //    'type' => 'notify',
        //    'mess' => 'disconnected',
        //    'name'=> $this->session->user['name'],
        //];
        //$this->sendAll( $resp, $conn );
        //echo 'CLOSE'.PHP_EOL;
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
        echo 'ERROR'.PHP_EOL;
    }
    
    public function sendAll( $resp, $from ){
        //print_r($this->clients);
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send(json_encode($resp));
            }
        }
    }
    
}
