<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Mail.php';

Class UserController{

    // Parse
    private function parseOne($json) : User{
        $siteController = new SiteController();
        $site = $siteController->getById(intval($json['SiteID']));
        return  new User($json['ID'], $json['Email'], $json['Name'], $json['Password'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $site);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $siteController = new SiteController();
            $site = $siteController->getById(intval($line['SiteID']));

            $user = new User($line['ID'], $line['Email'], $line['Name'], $line['Password'], $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area'], $site);
            array_push($result, $user);
        }
        return $result;
    }

    // Get
    
    public function getById(int $id){
        $api = new ApiManager('Usr');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Usr');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getByEmail(string $email){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Email', $email);
        return $this->parseAll($json);
    }

    public function getByName(string $name){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Name', $name);
        return $this->parseAll($json);
    }

    public function getByPassword(string $password){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Password', $password);
        return $this->parseAll($json);
    }

    public function getByNumero(string $numero){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Numero', $numero);
        return $this->parseAll($json);
    }

    public function getByRue(string $rue){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Rue', $rue);
        return $this->parseAll($json);
    }

    public function getByPostcode(string $postcode){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Postcode', $postcode);
        return $this->parseAll($json);
    }

    public function getByArea(string $area){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Area', $area);
        return $this->parseAll($json);
    }

    public function getBySite(int $siteId){
        $api = new ApiManager('Usr');
        $json = $api->getByInt('Site', $siteId);
        return $this->parseAll($json);
    }

    // Views
    
    public function viewAll(){
        $users = $this->getAll();
        if($users != NULl){
            require_once __DIR__ . '/../public/View/userGestionView.php';
        }
        else{
            header('Location: /404');
        }
    }

    public function Suppression(int $id){
        $user = $this->GetById($id);
        if($user == null){
            header("Location: /404");
        }
        header("/deconnexion");
    }

    public function PasswordIsValid(string $password, string $hashedPassword): bool{
        $salt = substr($hashedPassword, 0, 10);
        $password = HashNSalt($password, $salt);
        return ($password == $hashedPassword);
	}

    private function HashNSalt(string $salt, string $password): string{
        // in DATABASE :  10st characters = SALT, 40 last = hash (SALT + PASSWORD)
        // ripemd160 => 40 characters
        $salted = $salt . $password; 
        $algo = 'ripemd160'; 
        $hashed = hash($algo, $salted, FALSE);
        $password = $salt . $hashed; 
        return $password;
    }

    public function Connexion(){

        if(isset($_SESSION['User'])){
            header('Location: 404');
        }
        if(isset($_POST['Password']) && isset($_POST['Email'])){
            $users = $this->getByEmail($_POST['Email']);
            $user = $users[0];
            if($user == NULL){
                header('Location: /404');
            }
            // var_dump($_POST['Password']);
            // var_dump($user->getPassword());
            // var_dump(HashNSalt());

            // if($user->PasswordIsValid($_POST['Password'], $user->getPassword())){
            if($_POST['Password'] == $user->getPassword()){

                session_destroy();
                session_start();
                $_SESSION['User'] = $user->getDiscriminator();
                $_SESSION['Id'] = $user->getId();

                $url = '/';
                switch($_SESSION['User']){
                    case 'Individual' :
                        $url .= 'particulier/';
                        break;
                    case 'Saleman' :
                        $url .= 'commercant/';
                        break;
                    case 'Admin':
                        $url .= 'admin/';
                        break;
                    case 'Employer' :
                        $url .= 'employe/';
                        break;
                }
                $url .= $user->getId();
                header('Location: ' . $url);
            }else{
                session_destroy();
                header('Location: /log');

            }
        }

    }

    public function Deconnexion(){
        session_unset();
        session_destroy();
        header('Location: /');
    }

    private function MailMdp($email, $mdp){
        $mail = new Mail($email, MAIL, 'Mot de passe oublie');
        $mail->generateBody('Mdp', $mdp);
    }

    public function MotDePasseOublie(){
        $email = $_POST['email'];
        $user = $this->getByEmail($email);
        
        // Génération du mot de passe
        $size = 10;
        // Initialisation des caractères utilisables
        $password = '';
        $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        for($i=0;$i<$size;$i++)
        {
            $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
        }
        $user->setPassword($password);
        $user>update();
        MailMdp($user->getEmail(), $password);
    }
    
}
?>