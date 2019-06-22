#include "../headers/headers.h"

int createOffer()
{
    int wait = 1, nbProduct = 0;
    char cmd[42];
    struct Product *listProduct;

    while(wait)
    {
        printf("\n1: Proposer un produit \n2: Valier la proposition \n3: Retourner au menu\n");
        fgets(cmd, 42, stdin);
        if(cmd[0] == '1')
        {
            listProduct = addProduct(listProduct, nbProduct);
            nbProduct += 1;
        }
        else if(cmd[0] == '2')
            sendOffer();
        else if(cmd[0] == '3')
            wait = 0;
        printList(listProduct, nbProduct);
    }
    return 0;
}

char *getBarcode()
{
    char *productBarcode, barcode[42];
    int i = 0;
    
    printf("\nEntrez le code barre : ");
    fgets(barcode, 42, stdin);
    productBarcode = malloc(sizeof(char)* ((int)strlen(barcode) - 1));
    strcpy(productBarcode, barcode);
    while(productBarcode[i] != '\0')
    {
        if(productBarcode[i] == '\n')
            productBarcode[i] = '\0';
        i++;
    }
    return productBarcode;
}

struct Product *addProduct(struct Product *listProduct, int nbProduct)
{
    int i;
    char *productBarcode;
    struct Product *newListProduct = malloc(sizeof(struct Product) * (nbProduct + 1));
    
    for(i = 0; i < nbProduct; i++)
    {
        newListProduct[i] = listProduct[i];
    }
    productBarcode = getBarcode();
    if(productBarcode[0] != '\n')
    {
        newListProduct[nbProduct].barcodeValue = atoi(productBarcode);
        fromBarcodeToName(productBarcode);
        free(productBarcode);
        return newListProduct;
    }
    return NULL;
}