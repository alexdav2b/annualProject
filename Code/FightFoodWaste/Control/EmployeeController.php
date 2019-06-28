<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Employee.php';

Class EmployeeController{

    // Parse
    private function parseOne($json) : Employee{
        if($json['Discriminator'] == 'Employer'){
            $siteController = new SiteController();
            $site = $siteController->getById(intval($json['SiteID']));

            $user = new Employee($json['ID'], $json['Email'], $json['Name'], $json['Password'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Salary'], $json['Surname'], $site);
            return $user;
        }
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            if($line['Discriminator'] == 'Employer'){
                $siteController = new SiteController();
                $site = $siteController->getById(intval($line['SiteID']));
                $user = new Employee($line['ID'], $line['Email'], $line['Name'], $line['Password'], $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area'], $line['Salary'], $line['Surname'], $site);
                array_push($result, $user);
            }
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
        $json = $api->getByString('Name', $email);
        return $this->parseAll($json);
    }

    public function getBySurname(string $surname){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Surname', $surname);
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

    // getbySalary
    
    // Views
    public function view(int $id){
        if(!isset($_SESSION['User']) && !isset($_SESSION['ID']) && $_SESSION['User'] == null && $_SESSION['Id'] == null 
        || $_SESSION['Id'] != $id){
            header("Location: /404");
        }

        $user = $this->getById($id);
        if($user == NULL || $user->getDiscriminator() != 'Employer'){ 
            header('Location: /404');
        }
        $url = "/employe/update/" . $id;
        $controller = new SiteController();
        $sites = $controller->getAll();
        if($sites == null){
            header('Location: /404');
        }
        require_once __DIR__ . '/../public/View/userView.php';
    }

    public function New(){
        if($_SESSION['User'] != 'Admin'){
            header("Location: /404");
        }
        $controller = new SiteController();
        $sites = $controller->getAll();
        require_once __DIR__ . '/../public/View/newEmployeeView.php';
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

    public function Inscription(){
        $controller = new SiteController();
        $site = $controller->GetById($_POST['Site']);

        // $salt = bin2hex(random_bytes(5)); // 10 characters
        // $password = $this->HashNSalt($salt,  $POST['Password']); // 50 characters

        $form = array(
            htmlspecialchars($_POST['Email']),
            htmlspecialchars($_POST['Name']),
            htmlspecialchars($_POST['Password']),
            // $password,
            htmlspecialchars($_POST['Numero']),
            htmlspecialchars($_POST['Rue']),
            htmlspecialchars($_POST['Postcode']),
            htmlspecialchars($_POST['Area']),
            $_POST['Salary'], 
            htmlspecialchars($_POST['Surname']), 
            $site
        );

        foreach($form as $value){
            if($value == null){
                header("Location: /employe/new");
            }
        }
        $user = new Employee(null, $form[0], $form[1], $form[2], $form[3],  $form[4],  $form[5],  $form[6],  $form[7],  $form[8], $form[9]);
        $user->createEmployee();        
        $id = $user->getId();

        ob_start();
        echo("<div class = 'col-md-6 offset-md-3'>");
        echo("<p>L'utilisateur a été créé</p>");
        echo("</div>");
        $content = ob_get_clean();

        require_once __DIR__ . '/../public/View/templateView.php';
    }

    public function Modification(int $id){
        $controller = new SiteController();
        $site = $controller->GetById($_POST['Site']);
        $form = array(
            htmlspecialchars($_POST['Email']),
            htmlspecialchars($_POST['Name']),
            htmlspecialchars($_POST['Password']),
            htmlspecialchars($_POST['Numero']),
            htmlspecialchars($_POST['Rue']),
            htmlspecialchars($_POST['Postcode']),
            htmlspecialchars($_POST['Area']),
            htmlspecialchars($_POST['Salary']),
            htmlspecialchars($_POST['Surname']), 
            $site
        );
        $user = new Employee($id, $form[0], $form[1], $form[2], $form[3],  $form[4],  $form[5],  $form[6],  $form[7],  $form[8], $form[9]);
        $user->updateEmployee();        
        header("Location: /employe/$id"); 
    }

}

?>