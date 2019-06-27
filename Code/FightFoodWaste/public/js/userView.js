$(document).ready(function(){
    ShowView();
    $("#Modify").click(ShowUpdate);
    $("#Abort").click(ShowView);
    $("#Update").click(Update);
    $("#Delete").click(Delete);
});

function ShowView(){
    $("#Update").hide();
    $("#Abort").hide();
    $("input").hide();
    $("select").hide();
    $("#id").hide();
    $(".plaintext").show();
    $("#Modify").show();
    $("#Delete").show();
    $("#PasswordHide").hide();
}

function ShowUpdate(){
    $("#Update").show();
    $("#Abort").show();
    $("input").show();
    $("select").show();
    $(".plaintext").hide();
    $("#Modify").hide();
    $("#Delete").hide();
    $("#PasswordHide").hide();
}

// function Delete(){
//     var url = '<?= $deleteUrl ?>';
//     $("#User").attr("action", url);
//     Check();
//     $("#User").submit();
// }

function Update(){
    Check();
    $("#User").submit();
}

function Check(){
    var userType = '<?= $userType ?>'; 
    var password ='<?= $password ?>';

    if($("#SurnameID").val() == '' && userType != 'Saleman'){
        $("#SurnameID").val($("#Surname").text());
    }

    if($("#SiretID").val() == '' && userType != 'Admin' && userType != 'Employer' && userType != 'Volunteer' && userType != 'Individual'){
        $("#SiretID").val();
    }

    if($("#NameID").val() == ''){
        $("#NameID").val($('#Name').text());
    }

    if($("#EmailID").val() == ''){
        $("#EmailID").val($('#Email').text());
    }

    if($("#PasswordID").val() == ''){
        $("#PasswordID").val($("#PasswordHide").text());
    }

    if($("#NumeroID").val() == ''){
        $("#NumeroID").val($('#Numero').text());
    }


    if($("#RueID").val() == ''){
        $("#RueID").val($('#Rue').text());
    }

    if($("#PostcodeID").val() == ''){
        $("#PostcodeID").val($('#Postcode').text());
    }

    if($("#AreaID").val() == ''){
        $("#AreaID").val($('#Area').text());
    }

    if(userType == 'Employer' && $("#SalaryID").val() == ''){
        $("#SalaryID").val($('#Salary').text());
    }
}