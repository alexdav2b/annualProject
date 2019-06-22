#include "../headers/headers.h"

int connexion()
{
    int wait = 1, i = 0;
    char email[42];
    char mdp[42];

    while(wait)
    {
        printf("Email :\n");
        fgets(email, 42, stdin);
        printf("Mot de passe :\n");
        fgets(mdp, 42, stdin);
        while(email[i] != '\0')
        {
            if(email[i] == '\n')
                email[i] = '\0';
            i++;
        }
        i = 0;
        while(mdp[i] != '\0')
        {
            if(mdp[i] == '\n')
                mdp[i] = '\0';
            i++;
        }
        if(verifConnexion(email, mdp))
            wait = 0;
    }
    menu();
    return 0;
}

int verifConnexion(char* email, char* mdp)
{
    char *err;
    char *userData = getUserData(email, &err);

    return 1;

    return 0;
}

char * getUserData(char *email, char **err)
{
    const char url_model[] = "http://fightfoodwasteAPI/usr/Email/%s/getByString";

    CURL *curl_handle;
    CURLcode res;
    char *url;

    struct http_data_t chunk;

    chunk.data = malloc(sizeof(struct http_data_t));
    chunk.size = 0;

    curl_global_init(CURL_GLOBAL_ALL);

    curl_handle = curl_easy_init();

    url = calloc(sizeof(char), strlen(url_model) + strlen(email) + 1);
    //comme printf 2e parm dans le code format du premier
    sprintf(url, url_model, email);
    printf("\n%s\n", url);
    curl_easy_setopt(curl_handle, CURLOPT_URL, url);

    curl_easy_setopt(curl_handle, CURLOPT_WRITEFUNCTION, write_memory);
    curl_easy_setopt(curl_handle, CURLOPT_WRITEDATA, (void *)&chunk);

    curl_easy_setopt(curl_handle, CURLOPT_USERAGENT, "libcurl-agent/1.0");

    res = curl_easy_perform(curl_handle);

    if (res != CURLE_OK)
    {
        const char *fetch_err = curl_easy_strerror(res);

        *err = calloc(sizeof(char), strlen(fetch_err) + 1);
        strcpy(*err, fetch_err);
    }
    else
    {
        *err = NULL;
    }

    curl_easy_cleanup(curl_handle);
    curl_global_cleanup();

    return chunk.data;
}