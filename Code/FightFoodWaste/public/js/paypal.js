
function Paypal(){
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
        env :'sandbox',
        client:{
            sandbox :'AZ2atbfHDRpE0IXpB1qN2fgj36aQ3rqeRDZKOD1Egambd__wHWh1eGqZU57YR_GQC1RFlZaIEV98UKqB',
        },
        // Set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '100',
                        currency: 'EUR'
                    }
                },]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Transaction completed by ' + details.payer.name.given_name);
                CreateAdhesion();
                return fetch('/paypal-transaction-complete', {
                method: 'post',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    orderID: data.orderID
                })
                });
            });
        }
    }).render('#paypal-button-container');
}
        
function CreateAdhesion(){
    $(document).ready(function(){

        $.ajax({
        url : '/adhesion',
        type : 'POST', 
        success : function(datas){
            console.log('ok');
            var btn = document.getElementById("paypal-button-container");
            if(btn != null){
                btn.parentNode.removeChild(btn);    
            }

            var validate = document.getElementById("validate");
            if(validate != null){
                validate.parentNode.removeChild(validate);    
            }

            
            var adhesion = JSON.parse(datas);

            var tr = document.createElement("tr");
            var inner = "<th>" + adhesion.id + " ?></th>";
            inner += "<th>" + adhesion.date + "</th>";
            inner += "<th> " + adhesion.name+ " </th>";
            inner += "<th><a href = <?= $url ?> class = 'btn btn-success' id = 'Create'>Voir PDF</a></th>";
            tr.innerhtml = inner;

            $one = document.getElementById("one");
            $all = document.getElementById("all");
            if(typeof one === 'undefined'){
                all.append(tr);
            }else{
                one.append(tr);
            }

        }
        });
    });
}