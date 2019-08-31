<?php

Class Mail{
    private $to;
    private $from;
    private $subject;
    private $header;
    private $body;

    public function __construct($to, $from, $subject){
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
    }

    private function generateSimpleHeader(){
        $from = $this->from;
        // To send HTML mail, the Content-type header must be set
        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $header .= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        $this->header = $header;
    }

    private function generateJoinFileHeader(){
        $this->Sed();
    }

    public function Send(string $type){
        if($type == 'Simple'){
            $this->generateSimpleHeader();
        }else if($type == 'JoinFile'){
            $this->generateJoinFileHeader();
        }
        // $this->generateBody();

        $verif = mail($this->to, $this->subject, $this->body, $this->header);
    }

    public function generateBody($type, $data){
        $message = '';
        if($type == 'Inscription'){
            $message = "<h1>Merci pour votre inscription !</h1>
                        <b>Bonjour $data</b>
                        <p>Vous venez de vous inscrire a FightFoodWaste.</p>
                        <p>Vous pouvez des a pre#233sent vous connectez sur notre application pour nous notifier des produits que vous souhaitez donner.</p>";
                        // <a href ='#'><button id = 'ddl'>Telecharger l'application</button></a>
                        ;
        }else if($type == 'PDF'){
            $message = '';
        }else if($type == 'mdp'){
            $message = "<h1 >Nouveau mot de passe</h1>
                        <b>Bonjour </b>
                        <p>Voici votre nouveau mot de passe : <b>$data</b></p>";
        }else if($type == 'Adhesion'){
            $message = "<h1 >Expirationde votre adhesion</h1>
                        <b>Bonjour cher adherent</b>
                        <p>Votre adhesion expire </p>
                        <p>Vous pouvez la renouveler la a cette adresse :</p>
                        <a href = 'http://fightfoodwastesite/adhesions/" . $data->getId() ."'>Renouveler son abonnement</a>";
        }
        $logo = SITE_URL.'images/Mail.png';
        $this->body ="<html>
                    <head>
                        <meta charset = 'utf-8'/>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <meta http-equiv='X-UA-Compatible' content='IE=edge' />	
                        <title>" . $this->subject ."</title>
                        <style type= 'text/css' > 
                        *{ box-sizing: content-box; width: 100%; margin : 10px; }
                            #ddl{ width : 200px; padding : 10px; border : none; color : white; border-radius: 1em; background-color : #009900 ; }
                            #ddl:hover{ background-color : #00b300 !important; }
                            #ddl:active{ background-color : #008000 !important; }
                            #lien{ width : 200px; padding : 10px; border : none; color : 009900; border-radius: 1em; font-size : 2em; text-decoration: none; }
                            #lien:hover{ color : #00b300 !important; }
                            #lien:active{ color : #008000 !important; }
                        </style>
                    </head>
                        <main>
                            <div>
                               $message
                               <br>
                               <i>L'envoi de cette email est automatique. Veuillez ne pas y repondre.</i>       
                            </div>
                            <div>
                                <a href = '".SITE_URL."' id = 'lien'>
                                    <img style = 'width : 300px' src = '$logo' alt='FightFoodWaste'/>
                                </a>
                            </div>
                        </div>
                    </main>
                    </body>
                </html>";
    }
}