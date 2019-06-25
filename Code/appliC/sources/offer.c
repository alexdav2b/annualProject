#include "../headers/headers.h"

int createOffer(struct User *user)
{
    int wait = 1, nbProduct = 0;
    char cmd[42];
    struct Product *listProduct;

    while(wait)
    {
        printf("\n1: Proposer un produit \n2: Valier la proposition \n3: Retourner au menu\n");
        fgets(cmd, 3, stdin);        
        if(cmd[0] == '1')
        {
            listProduct = addProduct(user, listProduct, &nbProduct);
            printList(listProduct, nbProduct);
        }
        else if(cmd[0] == '2')
            sendOffer();
        else if(cmd[0] == '3')
            wait = 0;
    }
    return 0;
}

//ask user validity date
char *validDate(struct Product *listProduct, int nbProduct)
{
    char valDate[11];
    int i, wait = 1;

    
    while(wait)
    {
        printf("Entrez la date de peremption :\n");
        fflush(stdout);
        fflush(stdin);
        fgets(valDate, 12, stdin);
        i = 0;
        while(valDate[i] != '\0')
        {
            if(valDate[i] == '\n')
                valDate[i] = '\0';
            i++;
        }
        if(i == 10)
            wait = 1;
        printf("date : %s\n", valDate);
    }
    return valDate;
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

struct Product *addProduct(struct User *user, struct Product *listProduct, int *nbProduct)
{
    int i;
    unsigned int sizeName;
    unsigned int j;
    char *productBarcode;
    char *name, *date;
    struct Product *newListProduct;
    //get barcode in string
    productBarcode = getBarcode();
    //get name from openfoodfact
    name = fromBarcodeToName(productBarcode);
    
    sizeName = strlen(name);

    if (sameString("err", name))
    {
        printf("ce produit n'es pas reconnu\n");
    }
    else if(productBarcode[0] != '\n')
    {
        //save new product 
        //copy previous list
        newListProduct  = malloc(sizeof(struct Product) * (*nbProduct + 1));
        for(i = 0; i < *nbProduct; i++)
        {
            newListProduct[i] = listProduct[i];
        }
        //name
        for(j =0; j < 80 && j < strlen(name); j++)
        {
            newListProduct[*nbProduct].name[j] = name[j];
        }
        free(name);
        newListProduct[*nbProduct].name[sizeName] = '\0';
        //barcode value
        for(j =0; j < 14; j++)
        {
            newListProduct[*nbProduct].barcodeValue[j] = productBarcode[j];
        }
        //id user and depot
        for(j = 0; j < 5; j++)
        {
            newListProduct[*nbProduct].usrId[j] = user->usrId[j];
            newListProduct[*nbProduct].depoId[j] = user->siteId[j];
        }
        //id statut
        newListProduct[*nbProduct].depoId[0] = "0";
        newListProduct[*nbProduct].depoId[1] = "\0";
        // validity date 
        // date = validDate(listProduct, *nbProduct);
        // printf("\n %s\n", date);
        // for(i = 0; i < 11; i++)
        // {
        //     listProduct[*nbProduct].validDate[i] = date[i];
        // }
        *nbProduct += 1;
        free(productBarcode);
        free(listProduct);
        return newListProduct;
    }
    free(productBarcode);
    return listProduct;
}
