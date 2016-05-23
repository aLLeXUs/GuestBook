<?php
class db {
    private $dbName;
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $connectLink = null;
    private static $instance;         // экземпляра объекта
    private function __construct(){}  // Защищаем от создания через new Singleton
    private function __clone()    {}  // Защищаем от создания через клонирование
    private function __wakeup()   {}  // Защищаем от создания через unserialize
    public static function getInstance() {    // Возвращает единственный экземпляр класса. @return Singleton
        if (empty(self::$instance)) {
            require_once('config.php');
            self::$instance = new self();
            self::$instance -> dbName = $db['name'];
            self::$instance -> dbHost = $db['host'];
            self::$instance -> dbUser = $db['user'];
            self::$instance -> dbPass = $db['pass'];
        }
        return self::$instance;
    }
    //Выполняем запросы
    public function query($qString, $qParams = null) {
        $stmt = $this -> connectLink -> prepare($qString);
        $stmt -> execute($qParams);
        return $stmt;
    }
    //Соединяемся с базой
    public function openConnection() {
        try {
            $this -> connectLink = new PDO('mysql:host='.$this -> dbHost.';dbname='.$this -> dbName.';charset=utf8', $this -> dbUser, $this -> dbPass);
            $this -> connectLink -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            setError(DBERROR);
            die();
            //die('Подключение не удалось: ' . $e -> getMessage());
        }
        return $this -> connectLink;
    }
    //Закрываем соединение с базой
    public function closeConnection() {
        if (!is_null($this -> connectLink)) {
            $this -> connectLink = null;
        }
    }
}
?>