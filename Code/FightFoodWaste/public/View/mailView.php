<?php
$to = 's_pelluet@hotmail.fr';
$subject = 'Marriage Proposal';
$from = 'fightfoodwaste@spell.ovh';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = getMessage();
$fichier = getFile();

// Sending email
if(mail($to, $subject, $body, $headers)){
    echo 'Un email de confirmation vous a été envoyé.';
} else{
    echo 'Erreur. Veuillez réessayer avec une adresse email valide.';
}
?>

<?php
function getMessage(){
    $message = 
    "<html>
        <head>
            <meta charset = 'utf-8'/>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge' />	
            <title>Inscription FightFoodWaste</title>
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
                    <h1 >Merci pour votre inscription !</h1>
                    <b >Bonjour nom</b>
                    <p>Vous venez de vous inscrire à FightFoodWaste.</p>
                    <p>Vous pouvez dès à présent vous connectez sur notre application pour nous notifier des produits à envoyer.</p>
                    <a href ='#'><button id = 'ddl'>Télécharger l'application</button></a>
                    <p>Vous recevrez régulièrement des produits frais.</p>
                    <br>
                    <i>L'envoi de cette email est automatique. Veuillez ne pas y répondre.</i>
                </div>
                <div>
                    <a href = 'http://fightfoodwaste.spell.ovh/' id = 'lien'>
                        <img style = 'width : 300px' src = 'Capture.png'>
                    </a>
                </div>
            </div>
        </main>
        </body>
    </html>";
    return $message;
}
?>