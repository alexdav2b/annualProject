$(document).ready(function(){
    $("#Update").hide();
    $("input").hide();
    $("select").hide();
    $("#Modify").click(function(){
        $("#Update").show();
        $("input").show();
        $("select").show();
        $(".plaintext").hide();
        $("#Modify").hide();
    });
    $("#Update").click(function(){
        if($("#SurnameID").val()){
            $("#SurnameID").val($('#Surname').text());
        }
        if($("#NameID").val() == null){
            $("#NameID").val($('#Name').text());
        }
        if($("#EmailID").val() == null){
            $("#EmailID").val($('#Email').text());
        }
        if($("#PasswordID").val() == null){
            $("#PasswordID").val($('#Password').text());
        }
        if($("#SiteID").val() == null){
            $("#SiteID").val($('#Site').text());
        }
        if($("#NumeroID").val() == null){
            $("#NumeroID").val($('#Numero').text());
        }
        if($("#RueID").val() == null){
            $("#RueID").val($('#Rue').text());
        }
        if($("#PostcodeID").val() == null){
            $("#PostcodeID").val($('#Postcode').text());
        }
        if($("#AreaID").val() == null){
            $("#AreaID").val($('#Area').text());
        }
        if($("#EligibilityID").val() == null){
            $("#EligibilityID").val($('#Eligibility').text());
        }
        window.location.replace("/");
    });
});