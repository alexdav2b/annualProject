#include "../headers/headers.h"

SDL_Window *generateConnexionWindow()
{
    if (SDL_Init(SDL_INIT_VIDEO) != 0)
    {
        fprintf(stdout, "Échec de l'initialisation de la SDL (%s)\n", SDL_GetError());
        return NULL;
    }
    // Window generation
    SDL_Window *pWindowConnexion = SDL_CreateWindow("Connexion", SDL_WINDOWPOS_CENTERED,
                                                SDL_WINDOWPOS_CENTERED,
                                                1280,
                                                720,
                                                SDL_WINDOW_SHOWN);

    if (pWindowConnexion)
    {
        return pWindowConnexion;
    }
    return NULL;
}

int deleteConnexionWindow(SDL_Window *pWindowConnexion)
{
    SDL_DestroyWindow(pWindowConnexion);
    return 0;
}

SDL_Window *generateErrorConnexionWindow()
{
    return 0;
}

int deleteErrorConnexionWindow()
{
    return 0;
}



SDL_Window *generateMenuWindow()
{
    SDL_Window *pWindowMenu = SDL_CreateWindow("Menu", SDL_WINDOWPOS_CENTERED,
                                                SDL_WINDOWPOS_CENTERED,
                                                1280,
                                                720,
                                                SDL_WINDOW_SHOWN);

    if (pWindowMenu)
    {
        return pWindowMenu;
    }
    return NULL;
}

int deleteMenuWindow(SDL_Window *pWindowMenu)
{
    SDL_DestroyWindow(pWindowMenu);
    return 0;
}


SDL_Window *generateSendOfferWindow()
{
    SDL_Window *pWindowSendOffer = SDL_CreateWindow("SendOffer", SDL_WINDOWPOS_CENTERED,
                                                SDL_WINDOWPOS_CENTERED,
                                                1280,
                                                720,
                                                SDL_WINDOW_SHOWN);

    if (pWindowSendOffer)
    {
        return pWindowSendOffer;
    }
    return NULL;
}

int deleteSendOfferWindow(SDL_Window *pWindowSendOffer)
{
    SDL_DestroyWindow(pWindowSendOffer);
    return 0;
}