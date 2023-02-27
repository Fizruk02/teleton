<?php
namespace app;

class Models extends Db
{
    protected function _setSession( $userId ){
        return $this->insert(
            'INSERT INTO `sessions` (`user_id`, `date`, `status`) VALUES(?, now(), 0)', [ $userId ]
            );
    }
    
    protected function _setSessionChannel( $channel_id, $message_id, $id ){
        return $this->update(
            'UPDATE `sessions` SET `channel_id`=?, `message_id`=? WHERE id=?', [ $channel_id, $message_id, $id ]
            );
    }
    
    protected function _getOpenUserSession( $userId ){
        return $this->single(
            'SELECT * FROM `sessions` WHERE `user_id`=? AND `status`=0 ORDER BY `id` DESC LIMIT 1', [ $userId ]
            );
    }
    
    protected function _getLastOpenSession(){
        return $this->single(
            'SELECT * FROM `sessions` WHERE status=0 ORDER BY id DESC LIMIT 1', [ ]
            );
    }
    
    protected function _getSession( $id ){
        return $this->single(
            'SELECT * FROM `sessions` WHERE id=?', [ $id ]
            );
    }
    
    protected function _getSessionCommentMessId( $id ){
        return $this->single(
            'SELECT * FROM `sessions` WHERE id=? AND comment_message_id', [ $id ]
            );
    }
    
    protected function _getUser( $hash ){
        return $this->single(
            'SELECT * FROM `users` WHERE `hash`=?', [ $hash ]
            );
    }
    
    protected function _getUserById( $id ){
        return $this->single(
            'SELECT * FROM `users` WHERE `id`=?', [ $id ]
            );
    }
    
    protected function _setUser( $hash, $oper, $name ){
        return $this->insert(
            'INSERT INTO `users` (`date`, `hash`, `operator`, `name`) VALUES (now(), ?, ?, ?)', [ $hash, $oper, $name ]
            );
    }
    
    protected function _getMessages( $sessionId ){
        return $this->select(
            'SELECT * FROM `messages` WHERE `session_id`=?', [ $sessionId ]
            );
    }
    
    protected function _setMess( $userId, $sessionId, $mess ){
        return $this->insert(
            'INSERT INTO `messages` (`date`, `user_id`, `session_id`, `message`) VALUES (now(), ?, ?, ?)', [ $userId, $sessionId, $mess ]
            );
    }
    
    protected function _setOnline( $userId, $status ){
        return $this->update(
            'UPDATE `users` SET `online`='.($status?'true':'false').' WHERE id=?', [ $userId ]
            );
    }
    
}