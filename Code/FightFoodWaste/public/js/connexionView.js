function Chose(){
    $(document).ready(function(){
        Supprimer();
        var val = $("#User").val();
        if(val == "Individual" || val == "Saleman"){
            var form = document.getElementById("Choisir");
            div = document.getElementById("div-in");
            form.setAttribute('method', 'post');
            var content = "<div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>";
            var btn = "";
            if(val == 'Saleman'){            
                content += "<input onblur = 'verifSiret(this)' required class = 'form-control' type = 'text' name = 'Siret' id = 'SiretID' placeholder = 'Siret'>";
                btn = "<p class = 'col-md-6 offset-md-3 col-lg-6 offset-lg-3'><button class = 'btn btn-success' id = 'Inscription' type = 'submit' value = 'Inscription'>Sign In</button></p>";
                form.setAttribute('action', '/log/commercant');
                // form.setAttribute('id', 'Saleman');
                form.setAttribute('onsubmit', 'InscriptionS(this)');
    
            }else if(val == 'Individual'){
                content += "<input onblur = 'verifSurname(this)' required class = 'form-control' type = 'text' name = 'Surname' id = 'SurnameID' placeholder = 'Surname'>";
                btn = "<p class = 'col-md-6 offset-md-3 col-lg-6 offset-lg-3'><button class = 'btn btn-success' id = 'Inscription' type = 'submit' value = 'Inscription'>Sign In</button></p>";
                form.setAttribute('action', '/log/particulier');
                // form.setAttribute('id', 'Individual');
                form.setAttribute('onsubmit', 'InscriptionI(this)');
            }
            content += "<input onblur = 'verifName(this)' required class = 'form-control' type = 'text' name = 'Name' id = 'NameID' placeholder = 'Name'>";
            content += "<input onblur = 'verifEmail(this)' required class = 'form-control' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' type = 'email' name = 'Email' id = 'EmailID' placeholder = 'Email@host.com'>";
            content += "<input onblur = 'verifMdp(this)' required class = 'form-control' type = 'text' name = 'Password' id = 'PasswordID' placeholder = 'Password'>";
            content += "<input onblur = 'verifNumero(this)' required class = 'form-control col-md-2 col-lg-2 inline' type = 'text' name = 'Numero' id = 'NumeroID' placeholder = 'N°'>";
            content += "<input onblur = 'verifRue(this)' required class = 'form-control col-md-9 offset-md-1 col-lg-9 offset-lg-1 inline' type = 'text' name = 'Rue' id = 'Rue' placeholder = 'Rue'>";
            content += "<input onblur = 'verifPostcode(this)' required class = 'form-control' type = 'text' name = 'Postcode' id = 'Postcode' placeholder = 'Postcode'>";
            content += "<input onblur = 'verifArea(this)' required class = 'form-control' type = 'text' name = 'Area' id = 'Area' placeholder = 'Area'>";
            content += btn;
            content += "</div>";
    
            div.innerHTML = content;
    
            // $("#div-in").append(form);
        }
    });
}

function Supprimer(){
    var div = document.getElementById("div-in");
    while (div.hasChildNodes()) {
        div.removeChild(div.lastChild);
    }    
}

function verifSiret(champ){
    $(document).ready(function(){
        // $.ajax({
        // url : 'https://www.numero-de-siret.com/api/' + champ.value,
        // type : 'GET',
        // api_key : 'ffb60ec1263342b96dfbf291f698804b',
        // api_secret : '5e1008866c2f7a539f46907dfa4fc787',
        // success : function(datas){
        // },
        // });
        if(champ.value.length != 14){
            message = "Veuillez saisir 14 charactères"
            alert(message);
            return false
        }
        return true;
    });
}

function verifName(champ){
    if(champ.value.length < 2){
        alert("Saisissez au moins 2 caractères");
        return false;
    }else if(champ.value.length > 80){
        alert("Saisissez au maximum 60 charactères");
        return false;
    }else{
        return true;
    }
}


// function verifSurname(champ){
//     if(champ.value.length < 2){
//         alert("Saisissez au moins 2 caractères");
//         return false;
//     }else if(champ.value.length > 80){
//         alert("Saisissez au maximum _0 charactères");
//         return false;
//     }else{
//         return true;
//     }
// }

function verifEmail(champ){
    var message ="";
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    if(!regex.test(champ.value) && champ.value.length > 255){
        message = "Saisissez une adresse mail de 255 caractères maximum";
        alert(message);
        return false;
    }else if(!regex.test(champ.value)){
        message = "Saisissez une adresse mail";
        alert(message);
        return false;
    }else if(champ.value.length > 255){
        message= "Saisissez au maximum 255 caractères";
        alert(message);
        return false;
    }else{
       return true;
    }
}
function verifMdp(champ){
        var message = "";
        if(champ.value.length < 5){
            message = "Saisissez au moins 5 caractères"
            alert(message);
            return false;
        }else if(champ.value.length > 200){
            message = "Saisissez au maximum 200 charactères"
            alert(message);
            return false;
        }else{
           return true;
        }
}

function verifNumero(champ){
    var message = "";
    if(champ.value.length < 1){
        message = "Saisissez au moins 1 caractères",
        alert(message);
        return false;
    }else if(champ.value.length > 5){
        message = "Saisissez au maximum 5 charactères",
        alert(message);
        return false;
    }else{
       return true;
    }
} 

function verifRue(champ){
    var message = "";
    if(champ.value.length < 2){
        message = "Saisissez au moins 2 caractères";
        alert(message);
        return false;
    }else if(champ.value.length > 80){
        message = "Saisissez au maximum 80 charactères";
        alert(message);
        return false;
    }else{
       return true;
    }
}

function verifPostcode(champ){
    var message = "";
    if(champ.value.length != 5){
        message = "Saisissez 5 caractères"
        alert(message);
        return false;
    }
    return true;
}

function verifArea(champ){
    var message = "";
    if(champ.value.length < 2){
        message = "Saisissez au moins 2 caractères"
        alert(message);
        return false;
    }else if(champ.value.length > 80){
        message = "Saisissez au maximum 80 charactères"
        alert(message);
        return false;
    }else{
       return true;
    }
}

// function EmailUniq(mail){
//     $(document).ready(function(){
//         $.ajax({
//             url : 'http://fightfoodwasteapi/Usr/Email/' + field.email + '/getByString', 
//             type : 'POST',
//             // dataType : 'html', // On désire recevoir du HTML
//         success : function(data){
//             var user = JSON.parse(data);
//             if(user.email == mail);
//         }, });
//     });
// }

// function NameUniq(mail){
//     $(document).ready(function(){
//         $.ajax({
//             url : 'http://fightfoodwasteapi/Usr/Name/' + field.email + '/getByString', 
//             type : 'POST',
//             // dataType : 'html', // On désire recevoir du HTML
//         success : function(data){
//             var user = JSON.parse(data);
//             if(user.email == mail);
//         }, });
//     });
// }

function Connexion(field){
    var email = field.email;
    var mdp = field.password;
    var passwordOK = verifMdp(password);
    var emailOK = verifEmail(email);
    if(passwordOK && emailOK){
        // $(document).ready(function(){
        //     $.ajax({
        //         url : 'http://fightfoodwasteapi/Usr/Email/' + field.email + '/getByString', 
        //         type : 'POST',
        //         // dataType : 'html', // On désire recevoir du HTML
        //     success : function(data){
        //         var user = JSON.parse(data);
        //         if(user != null && user.password == mdp){
        //             return true;
        //         }else{
        //             // MotDePasseOublie();
        //             return false;
        //         }
        //     }, error : function(){
        //         return false;
        //     } 
        //     });
        // });
        return true;
    }else{
        return false;
    }
}

// Méga fonction avant d'envoyer au serveur
function Inscription(field){
    var name = verifName(field.name);
    var email = verifMail(field.email);
    var mdp = verifMdp(field.password);
    var num = verifNumero(field.numero);
    var rue = verifRue(field.rue);
    var area = verifArea(field.area);
    var postcode = verifPostcode(field.postcode);
    if(name && email && mdp && num && rue && area && postcode){
        return true;
    }
    alert("Veuillez remplir correctement tous les champs");
    return false;
}

function InscriptionS(field){
    if(verifSiret(field.siret)){
        return Inscription(field);
    }else{
        return false;
    }
}

function InscriptionI(field){
    if(verifSurname(field.Surname)){
        return Inscription(field);
    }else{
        return false;
    }
}

function InscriptionV(field){
    if(verifSurname(field.Surname)){
        return Inscription(field);
    }else{
        return false;
    }
}

function InscriptionA(field){
    if(verifSurname(field.Surname)){
        return Inscription(field);
    }else{
        return false;
    }
}

function InscriptionE(field){
    if(verifSurname(field.Surname) && verifSalary(field.Salary)){
        return Inscription(field);
    }else{
        return false;
    }
}

function verifSalary(){
    var message = "";
    if(champ.length = 0){
        message = "Saisissez un nombre";
        alert(message);
        return false;
    }else if(champ.value <= 0){
        message = "Saisissez un nombre positif";
        alert(message);
        return false;
    }else{
       return true;
    }
}