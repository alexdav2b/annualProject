#include "../headers/headers.h"

int connexionWindow()
{
    char *jsonConnexion = "c";
    int wait = 1;
    SDL_Event event;

    // // creation of connexion window 
    SDL_Window *pWindowConnexion = generateConnexionWindow();

    // // window stay still 
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
                deleteConnexionWindow(pWindowConnexion); //TODO close connexion window
            }
            //Validate id connexion
            if(pKeyStates[SDL_SCANCODE_RETURN]) // || click "validation"
            {
                wait = 0;
                if(verifUser(jsonConnexion)) //ask php api if user exist
                {
                    deleteConnexionWindow(pWindowConnexion); //TODO close connexion window
                    menuWindow(); //TODO generate Menu Window
                }
                else
                {
                    deleteConnexionWindow(pWindowConnexion); //TODO close connexion window
                    generateErrorConnexionWindow(); // TODO generate error connexion window -> "try again" button 
                }
                
            }
        }
        fprintf(stdout, "\n");
    }
    return 0;
}

int verifUser(char *jsonConnexion) //verify user existence in database
{
    int waitAnswer;

    waitAnswer = 1;
    sendJson(jsonConnexion);//send json file with user connexions datas 

    while(waitAnswer != 0 ) //TODO time > 1 min 
    {
        waitAnswer = 0; // tmp
        //TODO searchAnswerFile
        //TODO return answer
    }
    return 1; // tmp
}

int sendJson(char *jsonConnexion)
{
    // TODO
    return 0;
}