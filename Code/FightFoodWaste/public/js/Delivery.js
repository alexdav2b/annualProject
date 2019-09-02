class Delivery{
    constructor(id, truckId, employeeId, typeId, dateStart, url, stops, depotId, siteId, arrets){
        this.id = id;
        this.truckId = truckId;
        this.employeeId = employeeId;
        this.typeId = typeId;
        this.dateStart = dateStart;
        this.url = url;
        this.stops = stops;
        this.depotId = depotId;
        this.siteId = siteId;
        this.arrets = arrets;
    }
}
    // el.addEventListener("click", function(){modifyText("four")}, false);
    // ==================================================================
    // DOM

function Supprimer(number){
    switch(number){
        case (1) :
        var site = document.getElementById("site");
        if(site != null)
            site.parentNode.removeChild(site);

        case (2) :
        var depot = document.getElementById("depot")
        if(depot != null)
            depot.parentNode.removeChild(depot);

        case(3) :
        var dateHour = document.getElementById("dateHour")
        if(dateHour != null)
            dateHour.parentNode.removeChild(dateHour);
        var valider1 = document.getElementById("valider1")
        if(dateHour != null)
            valider1.parentNode.removeChild(valider1);

        case(4):
        var stops = document.getElementById("stop")
        if(stops != null){
            while(stops.firstChild)
            {
                stops.removeChild(stops.firstChild);
            }
        }
        var truck = document.getElementById("truck");
        if(truck != null)
            truck.parentNode.removeChild(truck);

        case (5):
            var employee = document.getElementById("employee");
            if(employee != null)
                employee.parentNode.removeChild(employee)

        case(6):
            var btn = document.getElementById("validerbtn2");
            if(btn != null)
            btn.parentNode.removeChild(btn)
        break;
        
        case(7):
        var fin = document.getElementById("fin");
        if(fin != null)
            fin.parentNode.removeChild(fin);
 
    }
}

function printURl(){
    var h = document.createElement("h2");
    h.setAttribute('class', 'col-md-12 col-lg-12');
    h.innerHTML = 'La livraison a été correctement crée';
    $("#stop").append(h);
}

function printPDF(){

}

function printSites(datas){
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
        option.innerHTML = sites[i].name + ' : ' +  sites[i].rue + ' ' +  sites[i].postcode + ' ' +  sites[i].area;
        option.setAttribute("value", sites[i].id);
        select.append(option);
    }
}
    
function printDepots(datas){
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
    select.setAttribute('onchange', 'ChoseDepot()');
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
        option.innerHTML = depots[i].rue + ' ' +  depots[i].postcode + ' ' +  depots[i].area;
        option.setAttribute("value", depots[i].id);
        select.append(option);
    }
}

function printDates(){
    var div = document.createElement("div");
    div.setAttribute('class', 'col-md-12 col-lg-12 row');
    div.setAttribute('id', 'dateHour');

    var label = document.createElement("label");
    label.setAttribute('for', 'dateHourId');
    label.setAttribute('style', 'padding-top')
    label.setAttribute('class', 'inline col-md-4 col-lg-4 ');
    label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
    label.innerHTML = "Date";

    var input1 = document.createElement("input");
    input1.setAttribute('class', 'inline col-md-4 col-lg-4 form-control');
    input1.setAttribute('type', 'time');
    input1.setAttribute('name', 'hour');
    input1.setAttribute('id', 'hour')

    var input2 = document.createElement("input");
    input2.setAttribute('class', 'inline col-md-4 col-lg-4 form-control');
    input2.setAttribute('type', 'date');
    input2.setAttribute('name', 'date');
    input2.setAttribute('id', 'date')

    var btn = document.createElement("button");
    btn.setAttribute('class', 'btn btn-secondary col-md-4 col-lg-4 offset-md-8 offset-lg-4');
    btn.setAttribute('id', 'validerbtn1');
    btn.setAttribute('onclick', 'GenerateItineraire()');
    btn.innerHTML = "Générer l'itinéraire";
    $('#stop').append(btn);


    $('#itineraire').append(div);
    div.append(label);
    div.append(input1);
    div.append(input2);
}
    
function printTrucks(datas){
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
    
function printEmployees(datas){
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

    var employees = JSON.parse(datas);
    for(var i = 0; i < employees.length; i++){
        var option = document.createElement("option");
        option.innerHTML = employees[i].name  + " " + employees[i].surname ;
        option.setAttribute("value", employees[i].id);
        select.append(option);
    }
}

function AddMinutes(date, minutes){
    return new Date(date.getTime() + minutes * 60000);
}
    
function printStops(datas){
    var points = [];
    $(document).ready(function(){
    if(datas != null){
        var json = JSON.parse(datas);
        
        var url = json.url;
        livraison.url = url;

        var stops = json.stops;
        var size = stops.length;

        var legs = json.map.routes[0].legs;
        var ordre = json.map.routes[0].waypoint_order;

        var dateStart = new Date(livraison.dateStart);
        var dateEnd = new Date(livraison.dateStart);

        for(var i = 0; i < ordre.length; i++){ // legs en plus
            stops[i].ordre = ordre[i];
            var date = legs[i+1].duration.value;
            var dateHour = AddMinutes(dateStart, date);
            dateEnd = dateHour;
            stops[i].dateHour = dateHour.toLocaleString("default",  {  year: 'numeric', month: 'numeric', day: 'numeric' , hour:'numeric', minute: 'numeric'});

        }
        livraison.dateEnd = dateEnd.toLocaleString("default",  {  year: 'numeric', month: 'numeric', day: 'numeric' , hour:'numeric', minute: 'numeric'});
        livraison.stops = stops;

        for(var i = 0; i < size; i++){
            var adresse = stops[i].Numero + ' ' + stops[i].Rue + ' ' + stops[i].Postcode + ' ' + stops[i].Area;
           
            var div1 = document.createElement("div");
            div1.setAttribute("class", 'col-md-12 col-lg-12 row');
            var ordre = document.createElement("label");
            ordre.setAttribute('class', 'inline col-md-1 col-lg-1');
            ordre.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
            ordre.innerHTML = stops[i].ordre + 1;
            div1.append(ordre);

            var date = document.createElement("label");
            date.setAttribute('class', 'inline col-md-4 col-lg-4');
            date.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
            date.innerHTML = new Date(stops[i].dateHour).toLocaleString("default",  { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' , hour:'numeric', minute: 'numeric'});
            div1.append(date);

            
            var prenom = document.createElement("label");
            prenom.setAttribute('class', 'inline col-md-3 col-lg-3');
            prenom.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
            prenom.innerHTML = stops[i].Nom;
            div1.append(prenom);
            
            var label = document.createElement("label");
            label.setAttribute('class', 'inline col-md-5 col-lg-4');
            label.setAttribute('style', 'padding-top : 6px !important; padding-bottom : 6px !important;');
            label.innerHTML = adresse;
            div1.append(label);

 
            var div2 = document.createElement("div");
            div2.setAttribute("class", 'col-md-10 md-offset-1 lg-offset-1 col-lg-12');

            for(var j = 0; j < stops[i].Products.length; j++){
                var product = stops[i].Products[j]
                var div3 = document.createElement("div");
                div3.setAttribute("class", 'col-md-12 col-lg-12 row');
                
                var input = document.createElement("input");
                input.setAttribute("value", "ID : " + product.id + "Name :" +product.name);
                input.setAttribute("type", "text");
                input.setAttribute('class', ' col-md-5 col-lg-4 form-control');
                input.setAttribute("readonly", "readonly");
                div3.append(input);

                var input1 = document.createElement("input");
                input1.setAttribute("value", "Barcode : " +product.barcode);
                input1.setAttribute("type", "text");
                input1.setAttribute('class', ' col-md-5 col-lg-4 form-control');
                input1.setAttribute("readonly", "readonly");
                div3.append(input1);

                var input2 = document.createElement("input");
                input2.setAttribute("value", "DLC : " + product.validDate );
                input2.setAttribute("type", "text");
                input2.setAttribute('class', ' col-md-5 col-lg-4 form-control');
                input2.setAttribute("readonly", "readonly");
                div3.append(input2);

                div2.append(div3);
            }
            div1.append(div2);
            $("#stop").append(div1);
        }  

        var btn = document.createElement("a");
        btn.setAttribute('class', 'btn btn-secondary col-md-4 col-lg-4 offset-md-8 offset-lg-4');
        btn.setAttribute('id', 'map');
        btn.setAttribute('target', '_blank');
        btn.setAttribute('href', "livraison/map:"+livraison.url);
        btn.innerHTML = "Voir le trajet";
        $('#stop').append(btn);


    }});
}

function printValider(){
    var btn = document.createElement("button");
    btn.setAttribute('class', 'btn btn-success col-md-4 col-lg-4 offset-md-8 offset-lg-4');
    btn.setAttribute('id', 'validerbtn2');
    btn.setAttribute('onclick', 'Valider()');
    btn.innerHTML = "Valider";
    $('#itineraire').append(btn);
}

// ==================================================================
// SEND

function ChoseType(){
    $(document).ready(function(){
        var typeId = $("#typeId").val();
        
        $.ajax({ 
            type : 'POST', url : '/livraison/printSite', data : 'typeId=' + typeId,
            success : function(datas){ 
                Supprimer(1);
                livraison.typeId = typeId;
                printSites(datas);
            },
            error : function(){ Supprimer(1); },
        });
    });
}
    
function ChoseSite(){
    $(document).ready(function(){
        var siteId = $("#siteId").val();
        $.ajax({ type : 'POST', url : '/livraison/printDepot', data : 'siteId=' + siteId,
            success : function(datas){
                Supprimer(2);
                livraison.siteId = siteId;
                printDepots(datas);
            },

            error : function(){ Supprimer(2); },
        });
    });
}
    
function ChoseDepot(){
    $(document).ready(function(){
        var depotId = $("#depotId").val();
        $.ajax({ type : 'POST', url : '/livraison/printDate', data : 'depotId=' + depotId,

        success : function(datas){
            Supprimer(3);
            livraison.depotId = depotId;
            printDates();
        },

        error : function(){ Supprimer(3); },
        });
    });     
}

function GenerateItineraire(){
    $(document).ready(function(){
        var date = $("#date").val();
        var hour = $("#hour").val();
        var str = date + 'T' + hour;
        var dateHour = new Date(str);
        var now = new Date();
        if(dateHour >= now){
            livraison.dateStart = str;
            $.ajax({ type : 'POST', url : '/livraison/printMap', 
            data :
                "typeId=" + livraison.typeId + 
                "&siteId=" + livraison.siteId + 
                "&depotId=" + livraison.depotId + 
                "&dateStart=" + livraison.dateStart,

            success : function(datas){
                Supprimer(4);
                printStops(datas);
                askTrucks();
            },
    
            error : function(){ 
                Supprimer(4);
             },
            });

        }else{
            alert("Veuillez saisir une date valide");
        }
    });
}
    
function askTrucks(){
    $(document).ready(function(){
        var siteId = livraison.siteId;
        $.ajax({ url : '/livraison/printTrucks', type : 'POST', data : 'siteId=' + siteId,
            success : function(datas){ 
                printTrucks(datas);
            },
            error : function(){ Supprimer(4); },
        });
    });
}

function ChoseTruck(){
    $(document).ready(function(){
        var truckId = $("#truckId").val();
        var siteId =$("#siteId").val();
        $.ajax({ url : '/livraison/printEmployees', type : 'POST', data : 'truckId=' + truckId + '&siteId=' + siteId,
            
            success : function(datas){ 
                Supprimer(5);
                livraison.truckId = truckId;
                printEmployees(datas);
            },
            error : function(){ Supprimer(5); },
        });

    });
}
    
function ChoseEmployee(){
        $(document).ready(function(){
            var id = $("#employeeId").val();
            $.ajax({
                url : '/livraison/Employee',
                type : 'POST',
                data : 'id=' + id,
    
                success : function(){ 
                    Supprimer(6);
                    livraison.employeeId = id;
                    printValider();
                },
                error : function(){
                    Supprimer(6)
                },
            });
        }); 
}
    
    
function Valider(){
    $(document).ready(function(){
        var truckId = livraison.truckId;
        var employeeId = livraison.employeeId;
        var typeId = livraison.typeId;
        var dateStart = livraison.dateStart;
        var dateEnd = livraison.dateEnd;
        var stops = livraison.stops;
        var url = livraison.url;
        var depotId = livraison.depotId;
        var siteId = livraison.siteId;

        $.ajax({
            url : '/livraison/create',
            type : 'POST',
            data : 'truckId=' + truckId + "&employeeId=" + employeeId + 
            "&dateStart=" + dateStart + "&typeId=" + typeId + "&stops=" + stops +
            "&url=" + url + "&depotId=" + depotId + "&siteId=" +siteId + "&dateEnd=" + dateEnd,
    
            success : function(datas){ 
                Supprimer(7);

                var json =JSON.parse(datas);
                livraison.id = json.id;

                createStops(datas);

            },
    
            error : function(){ 
                // Supprimer(1);
                alert("erreur");
            },
            });  
    });
}
    
function createStops(datas){
    var stops = livraison.stops;
    $(document).ready(function(){
        json = JSON.parse(datas);
        for(var i = 0; i < stops.length; i++){
            createStop(stops[i], i);
        }
    });
}

function createStop(stop, index){
    var products = livraison.stops[index].Products;
    var userId =  livraison.stops[index].Id;

    $(document).ready(function(){       
        $.ajax({
            url : '/livraison/createStop',
            type : 'POST',
            data : 'dateHour=' + stop.dateHour + "&livraisonId=" + livraison.id + "&employeeId=" + livraison.employeeId ,
            success : function(datas){
                $(document).ready(function(){
                    json = JSON.parse(datas);
                    for(var i=0; i < products.length; i++){
                        createStopProduct(json, products[i], userId);
                    }
            })} ,  
        });
    });
}

function createStopProduct(stop, product, userId){
    $(document).ready(function(){ 
        var id = product.id;
        var rcv = null;
        if(livraison.typeId == 2){
            rcv = userId;
        }

        $.ajax({
            url : '/livraison/createStopProduct',
            type : 'POST',
            data : 'productId=' + id + "&stopId=" + stop.id +"&rcv=" + rcv,
            success : function(datas){
            },  
        });
    });
}

var livraison = new Delivery();

// var map;
// // initMap();
// google.maps.event.addListenerOnce(map, 'idle', function () {

//     google.maps.event.trigger(map, 'resize');

// });
// function initMap() {
//     var markerArray = [];

//     // Instantiate a directions service.
//     var directionsService = new google.maps.DirectionsService;

//     // var options = { zoom: 4, center: {lat: 48.8467, lng: 2.3876} }
//     map = new google.maps.Map(document.getElementById('map'), {
//         center: {lat: -34.397, lng: 150.644},
//         zoom: 8
//       });


//     // Create a map and center it on Manhattan.
//     // map = new google.maps.Map(document.getElementById('map'), options);

//     // Create a renderer for directions and bind it to the map.
//     var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

//     // Instantiate an info window to hold step text.
//     var stepDisplay = new google.maps.InfoWindow;

//     // Display the route between the initial start and end selections.
//     // calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map);
    
//     // // Listen to change events from the start and end lists.
//     // var onChangeHandler = function() {
//     //   calculateAndDisplayRoute(
//     //       directionsDisplay, directionsService, markerArray, stepDisplay, map);
//     // };


//     // document.getElementById('start').addEventListener('change', onChangeHandler);
//     // document.getElementById('end').addEventListener('change', onChangeHandler);
// }

// function calculateAndDisplayRoute(directionsDisplay, directionsService,
//     markerArray, stepDisplay, map) {
//     // First, remove any existing markers from the map.
//     for (var i = 0; i < markerArray.length; i++) {
//         markerArray[i].setMap(null);
//     }

//     // Retrieve the start and end locations and create a DirectionsRequest using
//     // DRIVING directions.
//     directionsService.route({
//         origin: document.getElementById('start').value, // depot ou site
//         destination: document.getElementById('end').value, // depot ou site
//         travelMode: 'DRIVING'
//     }, 
//         function(response, status) {
//         // Route the directions and pass the response to a function to create
//         // markers for each step.
//         if (status === 'OK') {
//             document.getElementById('warnings-panel').innerHTML =
//             '<b>' + response.routes[0].warnings + '</b>';
//             directionsDisplay.setDirections(response);
//             showSteps(response, markerArray, stepDisplay, map);
//         } else {
//             window.alert('Directions request failed due to ' + status);
//         }
//     });
// }

// function showSteps(directionResult, markerArray, stepDisplay, map) {
//     // For each step, place a marker, and add the text to the marker's infowindow.
//     // Also attach the marker to an array so we can keep track of it and remove it
//     // when calculating new routes.
//     var myRoute = directionResult.routes[0].legs[0];
//     for (var i = 0; i < myRoute.steps.length; i++) {
//         var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
//         marker.setMap(map);
//         marker.setPosition(myRoute.steps[i].start_location);
//         attachInstructionText(stepDisplay, marker, myRoute.steps[i].instructions, map);
//     }
// }

// function attachInstructionText(stepDi    splay, marker, text, map) {
//     google.maps.event.addListener(marker, 'click', function() {
//         // Open an info window when the marker is clicked on, containing the text
//         // of the step.
//         stepDisplay.setContent(text);
//         stepDisplay.open(map, marker);
//     });
// }