#include <jansson.h>
#include <curl/curl.h>
#include <stdio.h>
#include <string.h>

#include "json.h"

struct Product
{
    char name[80];
    char barcodeValue[14];
    char validDate[11];
    char depoId[5];
    char usrId[5];
};

struct User
{
    char *email;
    char usrId[5];
    char siteId[5];
};

//connexion.c
int connexion();
    struct User *verifConnexion(char* email, char* mdp);
        char * getUserData(char *email, char **err);

//offer.c
int menu(struct User *user);
    int createOffer(struct User *user);
        struct Product *addProduct(struct User *user, struct Product *listProduct, int *nbProduct);
        char *validDate(struct Product *listProduct, int nbProduct);

//send.c
int  sendOffer(struct Product *listProduct, int nbProduct, struct User *user);

//utils
int printList(struct Product *listProduct, int nbProduct);
int toInt(char *string);
int sameString(char *model, const char*test);