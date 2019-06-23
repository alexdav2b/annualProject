$(document).ready(function(){
    Abort();
    $("#Modify").click(function(){
        $("#Update").show();
        $("#Abort").show();
        $("input").show();
        $("select").show();
        $(".plaintext").hide();
        $("#Modify").hide();
    });
    $("#Abort").click(Abort);
    $("#Update").click(function(){
        if($("#SurnameID").val() == ''){
            $("#SurnameID").val($('#Surname').text());
        }

        if($("#NameID").val() == ''){
            $("#NameID").val($('#Name').text());
        }

        if($("#EmailID").val() == ''){
            $("#EmailID").val($('#Email').text());
        }

        if($("#PasswordID").val() == ''){
            $("#PasswordID").val($('#Password').text());
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
        $("#Individual").submit();
        // document.getElementById("Individual").submit();
    });
});

function Abort(){
    $("#Update").hide();
    $("#Abort").hide();
    $("input").hide();
    $("select").hide();
    $("#id").hide();
    $(".plaintext").show();
    $("#Modify").show();
}