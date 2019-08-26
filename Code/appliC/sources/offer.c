#include "../headers/headers.h"

int menu(struct User *user)
{
    int wait = 1;
    char cmd[42];

    while(wait)
    {
        printf("1: Proposer une offre \n 2: Quitter\n");
        fgets(cmd, 42, stdin);
        if(cmd[0] == '1')
            createOffer(user);
        else if(cmd[0] == '2')
            wait = 0;
    }
    return 0;
}

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
            printf("connection effectue \nuser : %s, id : %s, site : %s\n", user->email, user->usrId, user->siteId);
            printf("test1\n");
            listProduct = addProduct(user, listProduct, &nbProduct);
            printList(listProduct, nbProduct);
        }
        else if(cmd[0] == '2')
            sendOffer(listProduct, nbProduct, user);
        else if(cmd[0] == '3')
            wait = 0;
    }
    return 0;
}

//ask user validity date
char *validDate(struct Product *listProduct, int nbProduct)
{
    char *valDate;
    int i, wait = 1;

    valDate = malloc(sizeof(char)*11);
    
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
        if(i == 11)
            wait = 0;
    }
    return valDate;
}

char *getBarcode()
{
    char *productBarcode, barcode[14];
    int i = 0;
    
    printf("\nEntrez le code barre : ");
    fgets(barcode, 14, stdin);
    productBarcode = calloc(sizeof(char), strlen(barcode)+1);
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
    printf("test2\n");
    name = fromBarcodeToName(productBarcode);
    printf("test3\n");
    sizeName = strlen(name);

    if (sameString("err", name))
    {
        printf("ce produit n'es pas reconnu\n");
    }
    else if(productBarcode[0] != '\n')
    {
        //save new product 
        //copy previous list
        printf("newlis\n");
        newListProduct  = malloc(sizeof(struct Product) * (*nbProduct + 1));
        for(i = 0; i < *nbProduct; i++)
        {
            newListProduct[i] = listProduct[i];
        }
        printf("name\n");
        //name
        for(j =0; j < 80 && j < strlen(name); j++)
        {
            newListProduct[*nbProduct].name[j] = name[j];
        }
        free(name);
        newListProduct[*nbProduct].name[sizeName] = '\0';
        printf("barcode\n");
        //barcode value
        for(j =0; j < 14; j++)
        {
            newListProduct[*nbProduct].barcodeValue[j] = productBarcode[j];
        }
        printf("usr\n");
        //id user and depot
        for(j = 0; j < 5; j++)
        {
            newListProduct[*nbProduct].usrId[j] = user->usrId[j];
            newListProduct[*nbProduct].depoId[j] = user->siteId[j];
        }
        newListProduct[*nbProduct].depoId[strlen(user->siteId)] = '\0';
        newListProduct[*nbProduct].usrId[strlen(user->usrId)] = '\0';
        //id statut
        newListProduct[*nbProduct].depoId[0] = "0";
        newListProduct[*nbProduct].depoId[1] = "\0";

        // validity date 
        date = validDate(listProduct, *nbProduct);
        for(i = 0; i < 11; i++)
        {
            newListProduct[*nbProduct].validDate[i] = date[i];
        }
        newListProduct[*nbProduct].validDate[10] = '\0';
        *nbProduct += 1;
        free(productBarcode);
        free(listProduct);
        free(date);
        return newListProduct;
    }
    free(productBarcode);
    return listProduct;
}


//*nbProduct