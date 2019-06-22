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
    int barcodeValue;
    char name[42];
    int endDate;
};

char *gets(char *str);
int toInt(char *string);
int connexion();
int verifConnexion(char* email, char* mdp);
    char * getUserData(char *email, char **err);

int menu();
    int createOffer();
        struct Product *addProduct(struct Product *listProduct, int nbProduct);
        int sendOffer();
        int printList(struct Product *listProduct, int nbProduct);