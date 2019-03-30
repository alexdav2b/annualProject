#include "headers/headers.h"

int main()
{
    int wait = 1;
    SDL_Event event;

    // window creation 
    graphGenerateMenu();

    while(wait != 0)
    {
        SDL_FlushEvent(SDL_WINDOWEVENT_CLOSE);
        SDL_FlushEvent(SDL_SCANCODE_ESCAPE);
        SDL_PumpEvents();
        SDL_PollEvent(&event);
        {
            const Uint8* pKeyStates = SDL_GetKeyboardState(NULL);
            // quit
            if ( pKeyStates[SDL_SCANCODE_ESCAPE] || event.window.event == SDL_WINDOWEVENT_CLOSE)
            {
                wait = 0;
            }
            // start simulation
            if(pKeyStates[SDL_SCANCODE_RETURN])
            {
                // wait = simulation();
            }
        }
        fprintf(stdout, "\n");
    }

    SDL_Quit();
    // fromBarcodeToName();
    return 0;
}