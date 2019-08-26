#include "../headers/headers.h"

int connexion()
{
    int wait = 1, i = 0;
    char email[42];
    char pwd[42];
    struct User *user = NULL;

    user = malloc(sizeof(struct User) * 1);
    if( user == NULL)
    {
        printf("les mallocs est de la merde");
    }

// //temporaire 
//     menu(user);
//     return 0;
// //fin tmp

    while(wait)
    {
        printf("Email :\n");
        fgets(email, 42, stdin);
        printf("Mot de passe :\n");
        fgets(pwd, 42, stdin);
        //transform strings
        while(email[i] != '\0')
        {
            if(email[i] == '\n'|| email[i] == ' ')
                email[i] = '\0';
            i++;
        }
        i = 0;
        while(pwd[i] != '\0'|| pwd[i] == ' ')
        {
            if(pwd[i] == '\n')
                pwd[i] = '\0';
            i++;
        }
        // printf("av verif\n");
        // user = verifConnexion(email, pwd);
        // printf("ap verif\n");
        user->email = "a@gmail.com";
        user->siteId[0] = '1';
        user->usrId[0] = '1';

        if(user != NULL)
            wait = 0;
    }
    printf("connection effectue \nuser : %s, id : %s, site : %s\n", user->email, user->usrId, user->siteId);
    menu(user);
    return 0;
}

struct User *verifConnexion(char* email, char* pwd)
{
    char * usrId, *siteId;
    char *err;
    char *userData = getUserData(email, &err);
    unsigned int i;
    //json Brut
    json_t *rData;
    json_error_t error;
    //object in array
    json_t *userObject;
    //key in object user
    json_t *pasword, *tmpUsrId, *tmpSiteId;

    usrId = malloc(sizeof(char) * 5);
    if( usrId == NULL)
    {
        printf("les mallocs est de la merde");
    }
    siteId = malloc(sizeof(char) * 5);
    if( siteId == NULL)
    {
        printf("les mallocs est de la merde");
    }
    //load json to parse it
    rData = json_loads(userData, 0, &error);
    //test if it's an array and if it's not null
    if(!json_is_array(rData) || json_array_size(rData) == 0)
    {
        printf("email ou mot de passe incorrect\n");
        return NULL;
    }
    if (!rData)
    {
        fprintf(stderr, "erreur: line %d: %s\n", error.line, error.text);
        return NULL;
    }
    free(userData);
    for(i = 0; i < json_array_size(rData); i++)
    {
        userObject = json_array_get(rData, i);
        if(!json_is_object(userObject) || userObject == NULL)
            return NULL;
        pasword = json_object_get(userObject, "Password");
        tmpUsrId = json_object_get(userObject, "ID");
        tmpSiteId = json_object_get(userObject, "SiteID");
       
    }

    struct User *Nuser;
    Nuser = malloc(sizeof(struct Product) * 1);
    if( Nuser == NULL)
    {
        printf("les mallocs est de la merde");
    }
    if(sameString(pwd, json_string_value(pasword)))
    {
        //save user data in it's struct
        memset(usrId, '\0', 5);
        memset(siteId, '\0', 5); 
        strcpy(usrId, json_string_value(tmpUsrId));
        strcpy(siteId, json_string_value(tmpSiteId));
        for(i = 0; i < 5 ; i++)
        {
            Nuser->usrId[i] = usrId[i];
            Nuser->siteId[i] = siteId[i];
        }
        printf("av email\n");
        strcpy(Nuser->email, email);
        printf("ap email\n");
        json_decref(rData);
        printf("Nuser \nuser : %s, id : %s, site : %s\n", Nuser->email, Nuser->usrId, Nuser->siteId);
        return Nuser;
    }
    else
    {
        printf("mot de passe incorect\n");
    }
    json_decref(rData);
    
    return NULL;
}

char * getUserData(char *email, char **err)
{
    const char url_model[] = "fightfoodwasteapi.spell.ovh/usr/Email/%s/getByString";

    CURL *curl_handle;
    CURLcode res;
    char *url;
    //var that receive json
    struct http_data_t chunk;

    chunk.data = malloc(sizeof(struct http_data_t));
    chunk.size = 0;

    

    curl_handle = curl_easy_init();

    url = calloc(sizeof(char), strlen(url_model) + strlen(email) + 1);
    //create final url
    sprintf(url, url_model, email);
    curl_easy_setopt(curl_handle, CURLOPT_URL, url);
    //callback to enlarge max data json
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
    
    return chunk.data;
}