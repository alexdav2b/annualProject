#include "../headers/headers.h"

int graphGenerateMenu()
{
    if (SDL_Init(SDL_INIT_VIDEO) != 0)
    {
        fprintf(stdout, "Échec de l'initialisation de la SDL (%s)\n", SDL_GetError());
        return -1;
    }

    // {
        // Window generation
        SDL_Window *pWindowMenu = SDL_CreateWindow("Menu - Don't Riot Versus Nature", SDL_WINDOWPOS_CENTERED,
                                               SDL_WINDOWPOS_CENTERED,
                                               1920,
                                               1080,
                                               SDL_WINDOW_SHOWN);

//         if (pWindowMenu)
//         {
//             SDL_Renderer *pRendererMenu = SDL_CreateRenderer(pWindowMenu, -1, SDL_RENDERER_ACCELERATED); // Initiate a rendered that will be next filled
//             if (pRendererMenu)
//             {
//                 SDL_Surface *background = SDL_LoadBMP("assets/menu.bmp");
//                 if (background)
//                 {
//                     SDL_Texture *BGTextures = SDL_CreateTextureFromSurface(pRendererMenu, background); // Sprite preparation
//                     if (BGTextures)
//                     {
//                         SDL_Rect dest = {0, 0, 1920, 1080};
//                         SDL_RenderCopy(pRendererMenu, BGTextures, NULL, &dest); // sprite "printed" on the futur render
//                         SDL_RenderPresent(pRendererMenu); // Render

//                     }
//                     else
//                     {
//                         fprintf(stdout, "Échec de création de la texture (%s)\n", SDL_GetError());
//                     }
//                 }
//                 else
//                 {
//                     fprintf(stdout, "Échec de chargement du sprite (%s)\n", SDL_GetError());
//                 }
//             }
//             else
//             {
//                 fprintf(stdout, "Échec de création du renderer (%s)\n", SDL_GetError());
//             }
//         }
//         else
//         {
//             fprintf(stderr, "Erreur de création de la fenêtre: %s\n", SDL_GetError());
//         }
//     }
//     return 1;
// }

// int graphGenerateWorld(struct Univers *univers)
// {
//     struct GraphData *graphData = malloc(sizeof(struct GraphData));

//     if (SDL_Init(SDL_INIT_VIDEO) != 0)
//     {
//         fprintf(stdout, "Échec de l'initialisation de la SDL (%s)\n", SDL_GetError());
//         return -1;
//     }

//     {
//         // Window generation
//         graphData->pWindow = SDL_CreateWindow("Don't Riot Versus Nature", SDL_WINDOWPOS_CENTERED,
//                                                SDL_WINDOWPOS_CENTERED,
//                                                1920,
//                                                1080,
//                                                SDL_WINDOW_SHOWN);

//         if (graphData->pWindow)
//         {
//             graphData->pRenderer = SDL_CreateRenderer(graphData->pWindow, -1, SDL_RENDERER_ACCELERATED); // Initiate a rendered that will be next filled
//             if (graphData->pRenderer)
//             {
//                 graphData->sTile = SDL_LoadBMP("assets/ground.bmp");
//                 graphData->sMu = SDL_LoadBMP("assets/mu.bmp");
//                 if (graphData->sTile && graphData->sMu)
//                 {
//                     graphData->TileTexture = SDL_CreateTextureFromSurface(graphData->pRenderer, graphData->sTile); // Sprite preparation
//                     graphData->MuTexture = SDL_CreateTextureFromSurface(graphData->pRenderer, graphData->sMu);     // Sprite preparation

//                     univers->graphData = graphData;

//                     if (graphData->TileTexture && graphData->MuTexture)
//                     {
//                         graphFillWorld(univers);
//                     }
//                     else
//                     {
//                         fprintf(stdout, "Échec de création de la texture (%s)\n", SDL_GetError());
//                     }
//                 }
//                 else
//                 {
//                     fprintf(stdout, "Échec de chargement du sprite (%s)\n", SDL_GetError());
//                 }
//             }
//             else
//             {
//                 fprintf(stdout, "Échec de création du renderer (%s)\n", SDL_GetError());
//             }
//         }
//         else
//         {
//             fprintf(stderr, "Erreur de création de la fenêtre: %s\n", SDL_GetError());
//         }
//     }
    return 1;
}

// int graphFillWorld(struct Univers *univers)
// {
//     int i, j;
//     int pX = 0, pY = 0;

//     for (i = 0; i < univers->land->size; i++)
//     {
//         pX = 0;
//         for (j = 0; j < univers->land->size; j++)
//         {
//             SDL_Rect dest = {pX, pY, TSIZE, TSIZE};
//             SDL_RenderCopy(univers->graphData->pRenderer, univers->graphData->TileTexture, NULL, &dest); // Sprite copy
//             if (univers->land->tiles[i][j].Mu != NULL)
//             {
//                 SDL_Rect dest2 = {pX, pY, TSIZE, TSIZE};
//                 SDL_RenderCopy(univers->graphData->pRenderer, univers->graphData->MuTexture, NULL, &dest2); // sprite copy
//             }
//             pX += TSIZE;
//         }
//         pY += TSIZE;
//     }
//     SDL_RenderPresent(univers->graphData->pRenderer); // render
//     return 0;
// }

// int printPause(struct GraphData *graphData)
// {
//     SDL_Surface * End = SDL_LoadBMP("assets/pause.bmp");
//     if (End)
//     {
//         SDL_Texture * tEnd = SDL_CreateTextureFromSurface(graphData->pRenderer, End);
//         if (tEnd)
//         {
//             SDL_Rect dest = {0, 0, 1920, 1080};
//             SDL_RenderCopy(graphData->pRenderer, tEnd, NULL, &dest); // Copy sprite
//             SDL_RenderPresent(graphData->pRenderer); // Render

//         }
//         else
//         {
//             fprintf(stdout, "Échec de création de la texture (%s)\n", SDL_GetError());
//         }
//     }
//     else
//     {
//         fprintf(stdout, "Échec de chargement du sprite (%s)\n", SDL_GetError());
//     }
//     return 0;
// }


// int printEndSimulation(struct GraphData *graphData)
// {
//     SDL_Surface * End = SDL_LoadBMP("assets/end.bmp");
//     if (End)
//     {
//         SDL_Texture * tEnd = SDL_CreateTextureFromSurface(graphData->pRenderer, End);
//         if (tEnd)
//         {
//             SDL_Rect dest = {0, 0, 1920, 1080};
//             SDL_RenderCopy(graphData->pRenderer, tEnd, NULL, &dest); // Copie du sprite grâce au SDL_Renderer
//             SDL_RenderPresent(graphData->pRenderer); // Affichage

//         }
//         else
//         {
//             fprintf(stdout, "Échec de création de la texture (%s)\n", SDL_GetError());
//         }
//     }
//     else
//     {
//         fprintf(stdout, "Échec de chargement du sprite (%s)\n", SDL_GetError());
//     }
//     return 0;
// }