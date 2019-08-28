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


        }
        ).render('#paypal-button-container');

function CreateAdhesion(){
    $.ajax({
    url : '/adhesion',
    type : 'POST', 
    success : function(data){
        var btn = document.getElementById("paypal-button-container");
        btn.parentNode.removeChild(btn);
    }
    });
}