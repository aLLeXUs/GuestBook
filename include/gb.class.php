<?php
    class GB {
        public $dbConnection;
        public $users;
        public $comments;
        public $user;
        
        function __construct() {
            global $dbConnection;
            $this->dbConnection = $dbConnection;
            require_once('users.class.php');
            $this->users = new users;
            require_once('comments.class.php');
            $this->comments = new comments;
            
        }
        
        // вход
        function login($login, $password) {
            if (isset($login) && isset($password)) {
                
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
                return true;
                
                /*if (setCookie('login', $login) && setCookie('password', $password)) {
                    return true;
                }*/
                
            } else {
                setError('Не удалось записать куки');
                return false;
            }
        }
        
        // выход
        function logout() {
            session_destroy();
            return true;
        }
        
        // попытка авторизации
        function tryAuth($login, $password) {
            if (isset($login) && isset($password)) {
                // проверяем корректность
                $query = 'SELECT * FROM users WHERE login = :login AND password = :password';
                $result = $this->dbConnection->query($query, array('login' => $login, 'password' => $password));
                $row = $result -> fetch(PDO::FETCH_ASSOC);
                if (isset($row['id'])) {
                    $this->user = $row;
                    return true;
                }
            } else {
                return false;
            }
        }
        
        // подтвержда ли почта
        function isVerified() {
            $query = 'SELECT `validation_code` FROM users WHERE login = :login';
            $result = $this->dbConnection->query($query, array('login' => $this->user['login']));
            $row = $result -> fetch(PDO::FETCH_ASSOC);
            return empty($row['validation_code']);
        }
        
        // авторизирован ли пользователь
        function isAuthorized() {
            return !empty($this->user['id']);
        }
        

        // получает список стран
        function getCountries() {
            $query = 'SELECT * FROM countries';
            $result = $this->dbConnection->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // получает список регионов
        function getRegions($country) {        
            $query = 'SELECT id, name FROM regions WHERE country_id = :country';
            $result = $this->dbConnection->query($query, array('country' => $country));
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // получает список городов
        function getCities($region) {
            $query = 'SELECT id, name FROM cities WHERE region_id = :region';
            $result = $this->dbConnection->query($query, array('region' => $region));
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }