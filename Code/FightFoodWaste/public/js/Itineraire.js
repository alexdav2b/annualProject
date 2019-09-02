/* ========================================================================
   DOM
*/

// function Supprimer(number){
//     /*  (- Types)
//         - Sites
//         - Depots
//         - Date
//         - BtnGenerateItenerary
//         - Map
//         - Trucks
//         - Employees
//         - BtnValidate
//         (- Envoyer données)
//     */
//     switch(number){
//         case (1) :
//         var site = document.getElementById("site");
//         if(site != null)
//             site.parentNode.removeChild(site);

//         case (2) :
//         var depot = document.getElementById("depot")
//         if(depot != null)
//             depot.parentNode.removeChild(depot);

//         case(3) :
//         // date
//         case(4) :
//         // btn generate
//         case(5) :
//             // var map = document.getElementById("map");
//             // map.setAttribute("style", "height:100%; visibility:hidden");

//         case (6):
//                 var truck = document.getElementById("truck");
//                 if(truck != null)
//                     truck.parentNode.removeChild(truck);
        
//         case (7) :
//             var employee = document.getElementById("employee");
//             if(employee != null)
//                 employee.parentNode.removeChild(employee)

//         // case
//         // var delivery = document.getElementById("delivery");
//         // if(delivery != null)
//         //     delivery.parentNode.removeChild(delivery)
            


        
//         // case(5):
//         // var stops = document.getElementById("stop")
//         // if(stops != null){
//         //     while(stops.firstChild)
//         //     {
//         //         stops.removeChild(stops.firstChild);
//         //     }
//         // }
        

//         // var valider = document.getElementById("ValiderId");
//         // if(valider != null)
//         //     valider.parentNode.removeChild(valider);
//     }
// }

// function Types(datas){
//     Supprimer(1);
// }

function Sites(datas){
    var div = document.createElement("div");
    div.setAttribute('class', 'col-md-12 col-lg-12 row');
    div.setAttribute('id', 'site');
    
    var label = document.createElement("label");
    label.setAttribute('for', 'siteId');
    label.setAttribute('style', 'padding-top')
    label.setAttribute('class', 'inline col-md-4 col-lg-4');
    label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
    label.innerHTML = "Site";

    var select = document.createElement("select");
    select.setAttribute('onchange', 'ChoseSite()');
    select.setAttribute('class', 'form-control inline col-md-8 col-lg-8 inline' );
    select.setAttribute('id', 'siteId');
    select.setAttribute('name', 'site');

    var optionC = document.createElement("option");
    optionC.innerHTML = "--Choisir--";

    $('#itineraire').append(div);
    div.append(label);
    div.append(select);
    select.append(optionC);

    var sites = JSON.parse(datas);
    for(var i = 0; i < sites.length; i++){
        var option = document.createElement("option");
        option.innerHTML = sites[i].name + ' ' +  sites[i].rue + ' ' +  sites[i].postcode + ' ' +  sites[i].area;
        option.setAttribute("value", sites[i].id);
        select.append(option);
    }
}

function Depots(datas){
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
    select.setAttribute('onchange', 'ChoseDate()');
    select.setAttribute('class', 'form-control inline col-md-8 col-lg-8 inline' );
    select.setAttribute('id', 'depotId');
    select.setAttribute('name', 'depotId');

    var optionC = document.createElement("option");
    optionC.innerHTML = "--Choisir--";

    $('#itineraire').append(div);
    div.append(label);
    div.append(select);
    select.append(optionC);

    var depots = JSON.parse(datas);
    for(var i = 0; i < depots.length; i++){

        var option = document.createElement("option");
        option.innerHTML = depots[i].nom;
        option.setAttribute("value", depots[i].name + ' ' +  depots[i].rue + ' ' +  depots[i].postcode + ' ' +  depots[i].area);
        select.append(option);
    }
}

function Trucks(datas){
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

function Dates(datas){

}



function Stops(datas){
    var points = [];
    $(document).ready(function(){
    if(datas != null){
        var json = JSON.parse(datas);
        var size = json.length;

        for(var i = 0; i < size; i++){
            var adresse = json[i].Numero + ' ' + json[i].Rue + ' ' + json[i].Postcode + ' ' + json[i].Area;
            $(document).ready(function(){
                $.ajax({
                    url : '/itineraire/Coo',
                    type : 'POST',
                    data : "address=" + adresse,
            
                    success : function(datas){ 
                        var point = JSON.parse(datas);
                        points.push(point);

                    }
                })
            });

            var div1 = document.createElement("div");
            div1.setAttribute("class", 'col-md-12 col-lg-12 row');
            for(var j = 0; j < json[i].Products.length; j++){

              
                var prenom = document.createElement("label");
                prenom.setAttribute('class', 'inline col-md-4 col-lg-4');
                prenom.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
                prenom.innerHTML = json[i].Nom;
                div1.append(prenom);
                
                var label = document.createElement("label");
                label.setAttribute('class', 'inline col-md-5 col-lg-4');
                label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
                label.innerHTML = adresse;
                div1.append(label);

                var product = json[i].Products[j]
                var input = document.createElement("input");
                input.setAttribute("value", product.barcode + " : " + product.name);
                input.setAttribute("type", "text");
                input.setAttribute('class', ' col-md-5 col-lg-4 form-control');
                input.setAttribute("readonly", "readonly");
                div1.append(input);
            }
            $("#stop").append(div1);
        }  
    }});
        // récupérer itineraire
        GetItinerary(points);
        // Map(points);
}

/* ========================================================================
   SEND DATA
*/


// function ChoseType(){
//     $(document).ready(function(){
//         var typeId = $("#typeId").val();
//         $.ajax({
//         url : '/livraison/printSite',
//         type : 'POST',
//         data : 'typeId=' + typeId,

//         success : function(datas){ 
//             Supprimer(1);
//             Sites(datas);
//         },
//         error : function(){
//             Supprimer(1);
//         },
//     });

// });
// }

// function ChoseSite(){
//     $(document).ready(function(){
//             var siteId = $("#siteId").val();
//             $.ajax({
//             url : '/livraison/printDepot',
//             type : 'POST',
//             data : 'siteId=' + siteId,

//             success : function(datas){
//                 Supprimer(1);
//                 console.log(datas);
//                 Depots(datas);
//             },

//             error : function(){ 
//                 Supprimer(1);
//             },
//         });

//     });
// }

// function ChoseDepot(){
//     // ChoseDate 2
// }


// function ChoseDate(){
//     $(document).ready(function(){
//         var depotId = $("#depotId").val();
//         var hour = $("#depotId").val();
//         $.ajax({
//         url : '/livraison/printDepot',
//         type : 'POST',
//         data : 'depotId=' + depotId,

//         success : function(datas){
//             Supprimer(3);
//             Trucks(datas);
//         },

//         error : function(){ 
//             Supprimer(1);
//         },
//     });

// });
// }

// function ChoseTruck(){
//     $(document).ready(function(){
//             var truckId = $("#truckId").val();
//             $.ajax({
//             url : '/itineraire/Truck',
//             type : 'POST',
//             // dataType : 'html', // On désire recevoir du HTML
//             data : 'truckId=' + truckId,
            
//             success : function(datas){ 
//                 Employees(datas);
//             },
//             error : function(){
//                 Supprimer(2);
//             },
//         });

//     });
// }

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
                div.setAttribute('id', 'delivery');
                
                var label = document.createElement("label");
                label.setAttribute('for', 'deliveryTypeId');
                label.setAttribute('style', 'padding-top')
                label.setAttribute('class', 'inline col-md-4 col-lg-4');
                label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
                label.innerHTML = "Livraison";

                var select = document.createElement("select");
                select.setAttribute('onchange', 'ChoseDeliveryType()');
                select.setAttribute('class', 'form-control inline col-md-8 col-lg-8 inline' );
                select.setAttribute('id', 'deliveryType');
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

function GetItinerary(data){
    $(document).ready(function(){
    var url =  'https://api.mapbox.com/optimized-trips/v1/mapbox/driving/';
    for(i = 0; i < data.length; i++){
       url += data.lng +','+ data.lat;
       if(i != data.length){
           url += ";"
       }
    }
    var end = '?access_token=pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA';

});
}

function AddValider(){
    // Ajout du bouton
    var btn = document.createElement("button");
    btn.setAttribute('class', 'btn btn-success col-md-4 col-lg-4 offset-md-8 offset-lg-4');
    btn.setAttribute('id', 'ValiderId');
    btn.setAttribute('onclick', 'PostInfo()');
    // btn.setAttribute('type', 'submit');
    // <input class='btn btn-success col-md-2 col-lg-2 offset-md-4 offset-lg-4' type="submit" value="Valider"></input>
    btn.innerHTML = "Valider";
    $('#validerDelivery').append(btn);
}

function PostInfo(){
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

function SearchStops(){
    $(document).ready(function(){
        var type = $("#deliveryType").val();
        $.ajax({
            url : '/itineraire/Search',
            type : 'POST',
            data : "type=" + type,
    
            success : function(datas){ 
                Supprimer(5);
                Stops(datas);
                // Map(datas);
            },
    
            error : function(){ 
                Supprimer(5);
            },
        });  
    });
}