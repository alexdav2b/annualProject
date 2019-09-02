function ChoseStatutProduit(field){

    $(document).ready(function(){
        var statutId = $("#statutId").val();
        var th = field.parentNode;
        $.ajax({ 
            type : 'POST', url : '/livraison/products', data : 'statutId=' + statutId +"&productId=" +th.id,
            success : function(datas){ 
                alert('Le statut du produit a été changé');
            },
        });
    });
}