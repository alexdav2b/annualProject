#include "../headers/headers.h"

int menuWindow()
{
    int wait = 1;
    SDL_Event event;

    // // creation of connexion window 
    SDL_Window *pWindowMenu = generateMenuWindow();

    // // window stay still 
    while(wait != 0)
    {
        SDL_FlushEvent(SDL_WINDOWEVENT_CLOSE);
        SDL_FlushEvent(SDL_SCANCODE_ESCAPE);
        SDL_PumpEvents();
        SDL_PollEvent(&event);
        {
            const Uint8* pKeyStates = SDL_GetKeyboardState(NULL);
            // quit or deconnect 
            if ( pKeyStates[SDL_SCANCODE_ESCAPE] || event.window.event == SDL_WINDOWEVENT_CLOSE)
            {
                wait = 0;
                deleteMenuWindow(pWindowMenu);
            }
            //Send Offer
            else if(pKeyStates[SDL_SCANCODE_RETURN]) 
            {
                wait = 0;
                deleteMenuWindow(pWindowMenu);
                sendOfferWindow();
            }
            //go to website
            else
            {}
        }
        fprintf(stdout, "\n");
    }
    return 0;
}