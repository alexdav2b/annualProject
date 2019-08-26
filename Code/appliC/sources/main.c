#include "../headers/headers.h"

int main()
{
    curl_global_init(CURL_GLOBAL_ALL);
    printf("\n\nAPPLICATION C \n\n\n");
    connexion();
    curl_global_cleanup();
    return 0;
}


int printList(struct Product *listProduct, int nbProduct)
{
    int i;

    printf("nombre de produits : %d\n", nbProduct);
    for(i = 0; i < nbProduct; i++)
    {
        printf("id : %d, cb : %s, name : %s, date : %s, usrid : %s, depotid : %s\n",i, listProduct[i].barcodeValue, listProduct[i].name, listProduct[i].validDate, listProduct[i].usrId, listProduct[i].usrId);
    }
    return 0;
}