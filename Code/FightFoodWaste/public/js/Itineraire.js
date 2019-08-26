function ChoseSite(){
    $(document).ready(function(){
            var siteId = $("#siteId").val();
            $.ajax({
            url : '/itineraire/Site',
            // url : '../test.php',
            type : 'POST',
            // dataType : 'html', // On désire recevoir du HTML
            data : 'siteId=' + siteId,

            success : function(datas){ 
                Supprimer();

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
            },
        });

    });
}

function ChoseTruck(){
    $(document).ready(function(){
            var truckId = $("#truckId").val();
            $.ajax({
            url : '/itineraire/Truck',
            // url : '../test.php',
            type : 'POST',
            // dataType : 'html', // On désire recevoir du HTML
            data : 'truckId=' + truckId,

            success : function(datas){ 
                var employee = document.getElementById("employee");
                if(employee != null)
                    employee.parentNode.removeChild(employee)

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
                console.log(trucks);
                for(var i = 0; i < trucks.length; i++){
                    var option = document.createElement("option");
                    option.innerHTML = trucks[i].name  + " " + trucks[i].surname ;
                    option.setAttribute("value", trucks[i].id);
                    select.append(option);
                }
            },
        });

    });
}

function ChoseDeliveryType(){

}

function ChoseStart(){}

function Supprimer(){
    var truck = document.getElementById("truck");
    if(truck != null)
        truck.parentNode.removeChild(truck);

    var employee = document.getElementById("employee");
    if(employee != null)
        employee.parentNode.removeChild(employee)

}