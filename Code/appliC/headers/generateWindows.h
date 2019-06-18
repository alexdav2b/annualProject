
// connexion window
SDL_Window *generateConnexionWindow();
int deleteConnexionWindow();

// error connexion window
SDL_Window *generateErrorConnexionWindow();
int deleteErrorConnexionWindow();

// menu window
SDL_Window *generateMenuWindow();
int deleteMenuWindow();

//send offer window
SDL_Window *generateSendOfferWindow();
int deleteSendOfferWindow();


// struct GraphData
// {
//     SDL_Window *pWindow;
//     SDL_Renderer *pRenderer;

//     SDL_Surface *sTile;
//     SDL_Surface *sMu;

//     SDL_Texture *TileTexture;
//     SDL_Texture *MuTexture;
// };

// int graphGenerateWorld(struct Univers *univers);
//     int graphFillWorld(struct Univers *univers);

// int printPause(struct GraphData *graphData);
// int printEndSimulation(struct GraphData *graphData);
// int loopEvent(struct Univers *univers);
