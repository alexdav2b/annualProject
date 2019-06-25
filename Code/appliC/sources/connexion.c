#include "../headers/headers.h"

int connexion()
{
    int wait = 1, i = 0;
    char email[42];
    char pwd[42];
    struct User *user;

    user = malloc(sizeof(struct Product) * 1);

//temporaire 
    // menu(user);
    // return 0;
//fin tmp

    while(wait)
    {
        printf("Email :\n");
        fgets(email, 42, stdin);
        printf("Mot de passe :\n");
        fgets(pwd, 42, stdin);
        printf("\nmod de passe : %s 42\n", pwd);
        while(email[i] != '\0')
        {
            if(email[i] == '\n')
                email[i] = '\0';
            i++;
        }
        i = 0;
        while(pwd[i] != '\0')
        {
            if(pwd[i] == '\n')
                pwd[i] = '\0';
            i++;
        }
        if(verifConnexion(user, email, pwd))
            wait = 0;
    }
    menu(user);
    return 0;
}

int verifConnexion(struct User *user, char* email, char* pwd)
{
    char *err;
    char *userData = getUserData(email, &err);
    char *tmpUsrId;
    char *tmpSiteId;
    json_t *rData;
    json_error_t error;

    tmpUsrId = malloc(sizeof(char)*4);
    tmpSiteId = malloc(sizeof(char)*4);
    rData = json_loads(userData, 0, &error);
    if (!rData)
    {
        fprintf(stderr, "error: on line %d: %s\n", error.line, error.text);
        return 1;
    }
    free(userData);


    const char *key;
    json_t *value;

    void *iter = json_object_iter(rData);
    while (iter)
    {
        key = json_object_iter_key(iter);
        value = json_object_iter_value(iter);
        printf("Key: %s, Value: %s\n", key, json_string_value(value));
        if(sameString("ID", key))
        {
            strcpy(tmpUsrId, json_string_value(value));
        }
        if(sameString("SiteID", key))
        {
            strcpy(tmpSiteId, json_string_value(value));
        }
        if(sameString("password", key) && sameString((char*)json_string_value(value), pwd))
        {
            user->usrId = tmpUsrId;
            user->siteId = tmpSiteId;
            strcpy(user->email, email);
            return 1;
        }
        iter = json_object_iter_next(rData, iter);
    }

    json_decref(rData);

    return 0;
}

char * getUserData(char *email, char **err)
{
    const char url_model[] = "apitdp.todomain.ovh/usr/Email/%s/getByString";

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
    printf("json : %s\n", chunk.data);
    return chunk.data;
}