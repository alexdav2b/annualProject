#include "../headers/headers.h"

int main()
{
    printf("\n\nAPPLICATION C \n\n\n");
    // connexionWindow();
    
    // close all windows
    // SDL_Quit();
    connexion();

    return 0;
}

// int main(void) {
  
//   char* s = NULL;
  
//   json_t *root = json_object();
//   json_t *json_arr = json_array();
  
//   json_object_set_new( root, "destID", json_integer( 1 ) );
//   json_object_set_new( root, "command", json_string("enable") );
//   json_object_set_new( root, "respond", json_integer( 0 ));
//   json_object_set_new( root, "data", json_arr );
  
//   json_array_append( json_arr, json_integer(11) );
//   json_array_append( json_arr, json_integer(12) );
//   json_array_append( json_arr, json_integer(14) );
//   json_array_append( json_arr, json_integer(9) );
  
//   s = json_dumps(root, 0);
  
//   puts(s);
//   json_decref(root);
  
//  return 0;
// }

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

// int saisie_texte(SDL_Surface *ecran, SDL_Rect position_zone, TTF_Font *police, SDL_Color couleur_texte, int long_max, char *saisie) /*On envoie l'écran, la position de la zone de saisie, la police ( faites attentions car certaines polices ne contiennent pas tous les caractères, la couleur du texte, la longueur max de la saisie(pour éviter les dépassement de mémoire) et enfin le tableau de char pour recevoir la saisie)*/
// {
//     SDL_Surface *texte=NULL;
//     SDL_Event event;
//     int continuer = 1;
//     int i=0;
 
//     texte = TTF_RenderText_Blended(police, saisie, couleur_texte);
//     saisie[0]='\0';
//     SDL_EnableUNICODE(1);
//     SDL_EnableKeyRepeat(120, 120);
 
//     while (continuer)
//     {
//         SDL_WaitEvent(&event);
//         switch (event.type)
//         {
//             case SDL_KEYDOWN:
//                 if (i>long_max)
//                     continuer=0;
//                 else if(event.key.keysym.sym==8 && i>0) // pour retour arrière
//                 {
//                     i--;
//                     saisie[i]=32;
//                 }
//                 else if (event.key.keysym.sym>=32 && event.key.keysym.sym<=126) //Touches ASCII de 32 à 126
//                 {
//                     saisie[i]=(char)event.key.keysym.unicode;
//                     i++;
//                     saisie[i]='\0';
//                 }
//                 else if (event.key.keysym.sym==SDLK_RETURN || event.key.keysym.sym==SDLK_KP_ENTER) /* pour la touche Entrée => fin de la saisie */
//                 {
//                     saisie[i]='\0';
//                     continuer=0;
//                 }
//                 else if(event.key.keysym.sym>=SDLK_KP0 && event.key.keysym.sym<=SDLK_KP9) /*Saisie de clavier numérique*/
//                                 {
//                                     saisie[i]=event.key.keysym.sym - SDLK_KP0 + '0';
//                                     i++;
//                                     saisie[i]='\0';
//                                 }
//                 else if (event.key.keysym.sym==SDLK_KP_PERIOD )
//                 {
//                     saisie[i]='.';
//                     i++;
//                     saisie[i]='\0';
//                 }
//                 else if (event.key.keysym.sym==SDLK_KP_DIVIDE )
//                 {
//                     saisie[i]='/';
//                     i++;
//                     saisie[i]='\0';
//                 }
//                 else if (event.key.keysym.sym==SDLK_KP_MINUS)
//                 {
//                     saisie[i]= '-' ;
//                     i++;
//                     saisie[i]='\0';
//                 }
//                 else if (event.key.keysym.sym==SDLK_KP_PLUS)
//                 {
//                     saisie[i]= '+' ;
//                     i++;
//                     saisie[i]='\0';
//                 }
//                 else if (event.key.keysym.sym==SDLK_KP_MULTIPLY)
//                 {
//                     saisie[i]= '*' ;
//                     i++;
//                     saisie[i]='\0';
//                 }
//                 else if (event.key.keysym.sym==SDLK_KP_EQUALS)
//                 {
//                     saisie[i]= '=' ;
//                     i++;
//                     saisie[i]='\0';
//                 }
 
//             break;
 
//         }
//         SDL_FillRect(ecran, NULL, SDL_MapRGB(ecran->format,0,135,200)); /*Adaptez cette partir en fonction de votre programme*/
//         texte=TTF_RenderText_Blended(police, saisie, couleur_texte);
//         SDL_BlitSurface(texte, NULL, ecran, &position_zone); /* Blit du texte par-dessus */
//         SDL_Flip(ecran);
 
 
//     }
 
//     SDL_FreeSurface(texte);
 
//     return 0;
// }