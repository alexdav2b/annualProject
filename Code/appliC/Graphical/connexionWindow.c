#include "../headers/headers.h"

int connexionWindow()
{
    char *jsonConnexion = "c";
    int wait = 1;
    SDL_Event event;

    // // creation of connexion window 
    SDL_Window *pWindowConnexion = generateConnexionWindow();

    // SDL_Renderer *renderer =SDL_CreateRenderer(pWindowConnexion, -1, SDL_RENDERER_ACCELERATED);
    // TTF_Font* Sans = TTF_OpenFont("Sans.ttf", 24); //this opens a font style and sets a size

    // SDL_Color White = {255, 255, 255};  // this is the color in rgb format, maxing out all would give you the color white, and it will be your text's color

    // SDL_Surface* surfaceMessage = TTF_RenderText_Solid(Sans, "put your text here", White); // as TTF_RenderText_Solid could only be used on SDL_Surface then you have to create the surface first

    // SDL_Texture* Message = SDL_CreateTextureFromSurface(renderer, surfaceMessage); //now you can convert it into a texture

    // SDL_Rect Message_rect; //create a rect
    // Message_rect.x = 0;  //controls the rect's x coordinate 
    // Message_rect.y = 0; // controls the rect's y coordinte
    // Message_rect.w = 100; // controls the width of the rect
    // Message_rect.h = 100; // controls the height of the rect

//Mind you that (0,0) is on the top left of the window/screen, think a rect as the text's box, that way it would be very simple to understance

//Now since it's a texture, you have to put RenderCopy in your game loop area, the area where the whole code executes

// SDL_RenderCopy(renderer, Message, NULL, &Message_rect); //you put the renderer's name first, the Message, the crop size(you can ignore this if you don't want to dabble with cropping), and the rect which is the size and coordinate of your texture
//     // // window stay still 
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