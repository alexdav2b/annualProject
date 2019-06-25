#include "../headers/headers.h"

int main()
{
    printf("\n\nAPPLICATION C \n\n\n");
    connexion();

    return 0;
}


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

int  sendOffer()
{
    //send json to api 
    return 0;
}

int printList(struct Product *listProduct, int nbProduct)
{
    int i;
    for(i = 0; i < nbProduct; i++)
    {
        printf("id : %d, cb : %s, name : %s\n",i, listProduct[i].barcodeValue, listProduct[i].name);
    }
    return 0;
}