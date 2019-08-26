#include "../headers/headers.h"

int sendOffer(struct Product *listProduct, int nbProduct, struct User *user)
{
    const char json_model[] = "{\"Name\":\"%s\",\"Barcode\":\"%s\",\"ValidDate\":\"%s\",\"DepositeryID\":%s,\"UsrID_Donated\":%s,\"UsrID_Received\":0,\"StatutID\":2}";
    CURL *curl = NULL;
    CURLcode res;
    char *json = NULL;
    int i;
    // printf("nombre de produits : %d\n", nbProduct);
    // i = nbProduct;
    if (listProduct == NULL)
    {
        printf("vous avez pas entre de produit\n");
        menu(user);
    }
    printf("\ntest\n");
    // for(i = 0; i < nbProduct; i++)
    // {
    //     printf("\n i = %d\n", i);
    // }
    printf("i = %d", i);
    printf("\n name = %s\n", listProduct[0].barcodeValue);
    printf("\n name = %s\n", listProduct[0].validDate);
    printf("\n name = %s\n", listProduct[0].usrId);

    // printf("nombre de produits : %d\n", i);
    json = calloc(sizeof(char), strlen(json_model) + strlen(listProduct[0].barcodeValue) + strlen(listProduct[0].validDate) + strlen(listProduct[0].usrId) + 1);
    sprintf(json, json_model, listProduct[0].name, listProduct[0].barcodeValue, listProduct[0].validDate, listProduct[0].usrId, listProduct[0].usrId);
    printf("\ntest2\n");

    printf("%s\n", json);
    puts("av curl");
    // curl_global_init(CURL_GLOBAL_ALL);
    curl = curl_easy_init();
    printf("\ntest2\n");
    if (curl)
    {
        printf("\ntest22\n");
        //url target
        curl_easy_setopt(curl, CURLOPT_URL, "http://fightfoodwasteapi.spell.ovh/product/create");
        printf("\ntest223\n");
        //post data
        curl_easy_setopt(curl, CURLOPT_POSTFIELDS, json);
        printf("\ntest224\n");
        // send request
        res = curl_easy_perform(curl);
        // print error
        printf("\ntest23\n");
        if (res != CURLE_OK)
            fprintf(stderr, "curl_easy_perform() failed: %s\n",
                    curl_easy_strerror(res));

        curl_easy_cleanup(curl);
    }
    // curl_global_cleanup();
    printf("\ntest2\n");
    return 0;
}
