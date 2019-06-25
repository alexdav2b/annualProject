#include "../headers/headers.h"

int createOffer(struct User *user)
{
    int wait = 1, nbProduct = 0;
    char cmd[42];
    struct Product *listProduct;

    while(wait)
    {
        fflush(stdin); //STDOUT
        printf("\n1: Proposer un produit \n2: Valier la proposition \n3: Retourner au menu\n");
        fflush(stdin);
        fgets(cmd, 3, stdin);
        fflush(stdin);
        if(cmd[0] == '1')
        {
            listProduct = addProduct(user, listProduct, nbProduct);
            validDate(listProduct, nbProduct);
            nbProduct += 1;
            printList(listProduct, nbProduct);
        }
        else if(cmd[0] == '2')
            sendOffer();
        else if(cmd[0] == '3')
            wait = 0;
    }
    return 0;
}

int validDate(struct Product *listProduct, int nbProduct)
{
    char valDate[42];

    printf("Entrez la date de peremption\n");
    fgets(valDate, 42, stdin);
    //traitement de la date -> format
    strcpy(listProduct[nbProduct].validDate, valDate);
    return 0;
}

char *getBarcode()
{
    char *productBarcode, barcode[14];
    int i = 0;
    
    printf("\nEntrez le code barre : ");
    fgets(barcode, 14, stdin);
    productBarcode = malloc(sizeof(char)* ((int)strlen(barcode)));
    strcpy(productBarcode, barcode);
    while(productBarcode[i] != '\0')
    {
        if(productBarcode[i] == '\n')
            productBarcode[i] = '\0';
        i++;
    }
    return productBarcode;
}

struct Product *addProduct(struct User *user, struct Product *listProduct, int nbProduct)
{
    int i;
    unsigned int sizeName;
    unsigned int j;
    char *productBarcode;
    char *name;
    struct Product *newListProduct = malloc(sizeof(struct Product) * (nbProduct + 1));

    productBarcode = getBarcode();
    name = fromBarcodeToName(productBarcode);
    sizeName = strlen(name);

    if (sameString("err", name))
    {
        printf("ce produit n'es pas reconnu\n");
    }
    else if(productBarcode[0] != '\n')
    {
        //copy previous list
        for(i = 0; i < nbProduct; i++)
        {
            newListProduct[i] = listProduct[i];
        }
        //name
        for(j =0; j < 80 && j < strlen(name); j++)
        {
            newListProduct[nbProduct].name[j] = name[j];
        }
        newListProduct[nbProduct].name[sizeName] = '\0';
        //barcode value
        for(j =0; j < 14; j++)
        {
            newListProduct[nbProduct].barcodeValue[j] = productBarcode[j];
        }
        //id user
        strcpy(newListProduct[nbProduct].usrId, user->usrId);
        //id depot
        strcpy(newListProduct[nbProduct].depoId, user->siteId);
        //id statut
        strcpy(newListProduct[nbProduct].depoId, "0\0");

        free(productBarcode);
        free(listProduct);
        return newListProduct;
    }
    else
    {
        free(productBarcode);
    }
    // free(newListProduct);
    return listProduct;
}

struct Product *dellProduct(struct Product *listProduct, int nbProduct, int idProduct)
{
    int i;
    char *productBarcode;
    char *name;
    struct Product *newListProduct = malloc(sizeof(struct Product) * (nbProduct - 1));

    for(i = 0; i < nbProduct; i++)
    {
        newListProduct[i] = listProduct[i];
    }
    productBarcode = getBarcode();
    name = fromBarcodeToName(productBarcode);

    printf("\ntest : %d\n", sameString("err", name));
    if (sameString("err", name))
    {
        printf("ce produit n'es pas reconnu\n");
    }
    if(productBarcode[0] != '\n')
    {
        for(unsigned int j =0; j < 14; j++)
        {
            newListProduct[nbProduct].barcodeValue[j] = productBarcode[j];
        }
        
        for(unsigned int j =0; j < 80 && j < strlen(name); j++)
        {
            newListProduct[nbProduct].name[j] = name[j];
        }
        free(productBarcode);
        return newListProduct;
    }
    return 0;
}