#include <jansson.h>
#include <curl/curl.h>
#include <stdio.h>
#include <string.h>
#include <SDL.h>
// #include <SDL_ttf.h>

#include "json.h"
#include "generateWindows.h"
#include "connexionWindow.h"
#include "menuWindow.h"
#include "sendOfferWindow.h"

struct Product
{
    char name[80];
    char barcodeValue[14];
    char *validDate;
    char *depoId;
    char *usrId;
    char *statutId;

};

struct User
{
    char *email;
    char *usrId;
    char *siteId;
};


int connexion();
int verifConnexion(struct User *user, char* email, char* mdp);
    char * getUserData(char *email, char **err);

int menu(struct User *user);
    int createOffer(struct User *user);
        struct Product *addProduct(struct User *user, struct Product *listProduct, int nbProduct);
        int validDate(struct Product *listProduct, int nbProduct);
        int sendOffer();

int printList(struct Product *listProduct, int nbProduct);
char *gets(char *str);
int toInt(char *string);
int sameString(char *model, const char*test);