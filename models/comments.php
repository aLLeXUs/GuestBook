<?php

class Model_Comments extends Model_Base {

    // добавить новый комментарий
    function add($user_id, $subject, $text) {
        // проверка темы
        $subject = trim($subject);
        if (!preg_match('/^[a-zа-я\d\s]{1,100}$/ui',$subject)) {
            setError('The subject should only consist of letters and numbers, and not be longer than 100 characters');
            return false;
        }
        // проверка комментария
        $text = trim($text);
        if (!preg_match('/^[a-zа-я\d\s_!?()#*,.\-]{1,500}$/ui',$text)) {
            setError('Comments should not consist of more than 500 characters');
            return false;
        }
        
        $query = 'INSERT INTO `comments` (`user_id`,`date`,`subject`,`text`) VALUES (:user_id,now(),:subject,:text)';
        $result = $this->db->query($query, array('user_id' => $user_id, 'subject' => $subject, 'text' => $text));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // удалить комментарий
    function remove($id) {
        
    }
    
    // получить массив всех комментариев
    public function getAll() {
        $query = 'SELECT `users`.`login`, `comments`.`date`,`comments`.`subject`, `comments`.`text` 
                    FROM users, comments WHERE `comments`.`user_id` = `users`.`id` ORDER BY date DESC';
        $result = $this->db->query($query); 
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}