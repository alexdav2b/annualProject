function Trucks(datas){
    Supprimer(1);
    // Ajout du select pour les camions
    var div = document.createElement("div");
    div.setAttribute('class', 'col-md-12 col-lg-12 row');
    div.setAttribute('id', 'truck');
    
    var label = document.createElement("label");
    label.setAttribute('for', 'truckId');
    label.setAttribute('style', 'padding-top')
    label.setAttribute('class', 'inline col-md-4 col-lg-4');
    label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
    label.innerHTML = "Camion";

    var select = document.createElement("select");
    select.setAttribute('onchange', 'ChoseTruck()');
    select.setAttribute('class', 'form-control inline col-md-8 col-lg-8 inline' );
    select.setAttribute('id', 'truckId');
    select.setAttribute('name', 'truck');

    var optionC = document.createElement("option");
    optionC.innerHTML = "--Choisir--";

    $('#itineraire').append(div);
    div.append(label);
    div.append(select);
    select.append(optionC);

    var trucks = JSON.parse(datas);
    for(var i = 0; i < trucks.length; i++){
        var option = document.createElement("option");
        option.innerHTML = trucks[i].plate;
        option.setAttribute("value", trucks[i].id);
        select.append(option);
    }
}

function Employees(datas){
    Supprimer(2);
    // ajout du select pour les conducteurs
    var div = document.createElement("div");
    div.setAttribute('class', 'col-md-12 col-lg-12 row');
    div.setAttribute('id', 'employee');
    
    var label = document.createElement("label");
    label.setAttribute('for', 'employeeId');
    label.setAttribute('style', 'padding-top')
    label.setAttribute('class', 'inline col-md-4 col-lg-4');
    label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
    label.innerHTML = "Conducteur";

    var select = document.createElement("select");
    select.setAttribute('onchange', 'ChoseEmployee()');
    select.setAttribute('class', 'form-control inline col-md-8 col-lg-8 inline' );
    select.setAttribute('id', 'employeeId');
    select.setAttribute('name', 'employee');

    var optionC = document.createElement("option");
    optionC.innerHTML = "--Choisir--";

    $('#itineraire').append(div);
    div.append(label);
    div.append(select);
    select.append(optionC);

    var trucks = JSON.parse(datas);
    for(var i = 0; i < trucks.length; i++){
        var option = document.createElement("option");
        option.innerHTML = trucks[i].name  + " " + trucks[i].surname ;
        option.setAttribute("value", trucks[i].id);
        select.append(option);
    }
}

function Depots(datas){
    // Ajout du depot 
    var div = document.createElement("div");
    div.setAttribute('class', 'col-md-12 col-lg-12 row');
    div.setAttribute('id', 'depot');

    var label = document.createElement("label");
    label.setAttribute('for', 'depotId');
    label.setAttribute('style', 'padding-top')
    label.setAttribute('class', 'inline col-md-4 col-lg-4');
    label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
    label.innerHTML = "Depot";

    var select = document.createElement("select");
    select.setAttribute('onchange', 'ChoseStart()');
    select.setAttribute('class', 'form-control inline col-md-8 col-lg-8 inline' );
    select.setAttribute('id', 'depotId');
    select.setAttribute('name', 'depotId');

    var optionC = document.createElement("option");
    optionC.innerHTML = "--Choisir--";

    $('#itineraire').append(div);
    div.append(label);
    div.append(select);
    select.append(optionC);

    var objects = JSON.parse(datas);
    for(var i = 0; i < objects.length; i++){
        var option = document.createElement("option");
        option.innerHTML = objects[i].nom;
        option.setAttribute("value", objects[i].name + ' ' +  objects[i].rue + ' ' +  objects[i].postcode + ' ' +  objects[i].area);
        select.append(option);
    }
}

function AddValider(){
    // Ajout du bouton
    var btn = document.createElement("button");
    btn.setAttribute('class', 'btn btn-success col-md-4 col-lg-4 offset-md-8 offset-lg-4');
    btn.setAttribute('id', 'ValiderId');
    btn.setAttribute('onclick', 'AddDelivery()');
    // btn.setAttribute('type', 'submit');
    // <input class='btn btn-success col-md-2 col-lg-2 offset-md-4 offset-lg-4' type="submit" value="Valider"></input>
    btn.innerHTML = "Valider";
    $('#validerDelivery').append(btn);
}

function AddDelivery(){
    $(document).ready(function(){
        var truck = $("#truckId").val();
        var employee = $("#employeeId").val();
        var type = $("#deliveryType").val();
        var date = $("#date").val();
        var hour = $("#hour").val();
        var dateHour = date + "T" + hour;

        var diff = Date.parse(date) - Date.now() ;

        if(date != null && hour != null && diff > 0){
            $.ajax({
                url : '/itineraire/CreateDelivery',
                type : 'POST',
                // dataType : 'html', // On désire recevoir du HTML
                data : 'truck=' + truck + "&user=" + employee + "&dateHour=" + dateHour + "&type=" + type,
        
                success : function(datas){ 
                    // AddValider();
                },
        
                error : function(){ 
                    // Supprimer(1);
                },
            });  
        }else{
            alert("Veuillez saisir une futur date");
        }
    });
}

function ChoseSite(){
    $(document).ready(function(){
            var siteId = $("#siteId").val();
            $.ajax({
            url : '/itineraire/Site',
            type : 'POST',
            // dataType : 'html', // On désire recevoir du HTML
            data : 'siteId=' + siteId,

            success : function(datas){ 
                Trucks(datas);
            },

            error : function(){ 
                Supprimer(1);
            },
        });

    });
}




function ChoseTruck(){
    $(document).ready(function(){
            var truckId = $("#truckId").val();
            $.ajax({
            url : '/itineraire/Truck',
            type : 'POST',
            // dataType : 'html', // On désire recevoir du HTML
            data : 'truckId=' + truckId,
            
            success : function(datas){ 
                Employees(datas);
            },
            error : function(){
                Supprimer(2);
            },
        });

    });
}

function ChoseEmployee(){
    $(document).ready(function(){
        var id = $("#employeeId").val();
        $.ajax({
            url : '/itineraire/Employee',
            type : 'POST',
            data : 'id=' + id,

            success : function(datas){ 
                Supprimer(3);
                
                // Ajout du select pour les deliveryType
                var div = document.createElement("div");
                div.setAttribute('class', 'col-md-12 col-lg-12 row');
                div.setAttribute('id', 'deliveryType');
                
                var label = document.createElement("label");
                label.setAttribute('for', 'deliveryTypeId');
                label.setAttribute('style', 'padding-top')
                label.setAttribute('class', 'inline col-md-4 col-lg-4');
                label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
                label.innerHTML = "Livraison";

                var select = document.createElement("select");
                select.setAttribute('onchange', 'ChoseDeliveryType()');
                select.setAttribute('class', 'form-control inline col-md-8 col-lg-8 inline' );
                select.setAttribute('id', 'deliveryTypeId');
                select.setAttribute('name', 'deliveryType');

                var optionC = document.createElement("option");
                optionC.innerHTML = "--Choisir--";

                $('#itineraire').append(div);
                div.append(label);
                div.append(select);
                select.append(optionC);

                var objects = JSON.parse(datas);
                for(var i = 0; i < objects.length; i++){
                    var option = document.createElement("option");
                    option.innerHTML = objects[i].name;
                    option.setAttribute("value", objects[i].id);
                    select.append(option);
                }
            },
            error : function(){
                Supprimer(3)
            },
        });
    }); 
}

function ChoseDeliveryType(){
    $(document).ready(function(){
        var id = $("#deliveryTypeId").val();
        $.ajax({
        url : '/itineraire/DeliveryType',
        type : 'POST',
        data : 'id=' + id,

        success : function(datas){ 
            Supprimer(4);
            //Depots(datas);
            AddValider();
        },
        error : function(){
            Supprimer(4);
        },
    });

});
}

// option.setAttribute("value", objects[i].numero + ' ' +  objects[i].rue + ' ' +  objects[i].postcode + ' ' +  objects[i].area);

function ChoseStart(){}


function Supprimer(number){
    switch(number){
        case (1) :
        var truck = document.getElementById("truck");
        if(truck != null)
            truck.parentNode.removeChild(truck);

        case (2) :
        var employee = document.getElementById("employee");
        if(employee != null)
            employee.parentNode.removeChild(employee)
            
        case(3) :
        var delivery = document.getElementById("deliveryType");
        if(delivery != null)
            delivery.parentNode.removeChild(delivery)
            
        case(4) :
        var depot = document.getElementById("depot")
        if(depot != null)
            depot.parentNode.removeChild(depot);
        
        case(5):
        var valider = document.getElementById("ValiderId");
        if(valider != null)
        valider.parentNode.removeChild(valider);
    }
}