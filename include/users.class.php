<?php
    class users {
        public $dbConnection;
        
        function __construct() {
            global $dbConnection;
            $this->dbConnection = $dbConnection;
        }
        
        // добавить нового пользователя
        function add($login, $password, $email, $name, $city) {
            // проверяем логин
            if (!preg_match('/^[a-z\d_-]{3,20}$/i',$login)) {
                setError('Bad login');
                return false;
            }
            // проверяем пароль
            if (!preg_match('/^[a-z\d_-]{3,20}$/i',$password)) {
                setError('Bad password');
                return false;
            }
            // проверяем почту
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                setError('E-mail is incorrect');
                return false;
            }
            
            // проверяем город
            // todo: проверка наличия города в базе
            if (!$city > 1) {
                setError('City is incorrect');
                return false;
            }
            
            // проверяем на уникальность
            //global $dbConnection;
            if ($this->isLoginAvailable($login)) {
                $validationCode = generateRandomString(30);
                // добавляем пользователя
                $query = "INSERT INTO `users` (`login`,`password`,`email`,`validation_code`,`name`, `city_id`) 
                    VALUES (:login,:password,:email,:validation_code,:name, :city)";
                $result = $this->dbConnection->query($query, array('login' => $login,
                                                'password' => $password, 
                                                'email' => $email,
                                                'validation_code' => $validationCode,
                                                'name' => $name,
                                                'city' => $city));
                if ($result) {
                    // зарегистрирован
                    //include_once('validation.php');
                    $this->sendValidationEmail($login);
                    return true;
                } else {
                    setError('Registration failed');
                    return false;
                }
            } else {
                setError('Login already exists');
                return false;
            }
        }
        
        // удалить пользователя
        function remove($id) {
            
        }
        
        function get($id) {
            
        }
        
        function getAll() {
            
        }
        
        // проверяет досьупность логина
        function isLoginAvailable($login) {
            $query = 'SELECT * FROM users WHERE login = :login';
            $result = $this->dbConnection->query($query, array('login' => $login));
            $row = $result -> fetch(PDO::FETCH_ASSOC);
            
            return !isset($row['login']);
        }
        
        // Отправляет письмо для подтверждения почты.
        function sendValidationEmail($login) {
            global $dbConnection;
            global $user;
            $query = 'SELECT `email`, `validation_code` FROM users WHERE login = :login';
            $result = $this->dbConnection->query($query, array('login' => $login));
            $row = $result -> fetch(PDO::FETCH_ASSOC);
            if (strlen($row['validation_code']) > 0) {
                $url = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/validation.php?code=' . $row['validation_code'];
                $headers  = "Content-type: text/html; charset=windows-1251 \r\n";
            /* $text = "<html>
                    <head>
                        <title>Validation</title>
                    </head>
                    <body>Перейдите по ссылке для подтверждения почты.\n
                        <a href=\"" . $url . "\">Ссылка для подтверждения</a>
                    </body>
                    </html>";*/
                $template = file_get_contents('template/validation_email.php');
                $template = str_replace('{URL}', $url, $template);
                if (mail($row['email'], 'Validation', $template, $headers)) {
                    return true;
                } else {
                    setError('Не удалось отправить письмо');
                    return false;
                }
            } else {
                setError('Почта уже подтверждена');
                return false;
            }
        }
    }