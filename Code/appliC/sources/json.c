#include "../headers/headers.h"

char* fromBarcodeToName(char * code)
{
    char *err;
    //get json from openfoodfact
    char *data = getProduct(code, &err);
    int found = 0, size;
    char *name;

    name = malloc(sizeof(char)*80);
    size = 80;

    json_t *rData;
    json_error_t error;
    rData = json_loads(data, 0, &error);
    if (!rData)
    {
        fprintf(stderr, "erreur: line %d: %s\n", error.line, error.text);
        return "err";
    }
    free(data);

    json_t *product = json_object_get(rData, "product");

    const char *key;
    json_t *value;
    
    void *iter = json_object_iter(product);
    while (iter)
    {
        key = json_object_iter_key(iter);
        value = json_object_iter_value(iter);
        if (sameString("product_name_fr", key))
        {
            //get french name
            found = 1;
            memset(name, '\0', size);
            strcpy(name, json_string_value(value));
            name[strlen(json_string_value(value))] = '\0';
        }
        iter = json_object_iter_next(product, iter);
    }
    if(found != 1)
    {
        while (iter)
        {
            //get general name if french not exist
            key = json_object_iter_key(iter);
            value = json_object_iter_value(iter);
            value = json_object_iter_value(iter);
            if (!sameString("product_name", key))
            {
                found = 1;
                memset(name, '\0', size);
                strncpy(name, json_string_value(value), 79);
            }
            iter = json_object_iter_next(product, iter);
        }
    }
    json_decref(product);
    if(found != 1)
        return "err";
    return name;
}


int sameString(char *model,const char*test)
{
    unsigned int i = 0;
    while(i < strlen(model) && i < strlen(test) && model[i] == test[i])
        i++;
    if(i == strlen(model))
        return 1;
    return 0;
}

char * getProduct(char *code, char **err)
{
    const char url_model[] = "https://fr.openfoodfacts.org/api/v0/produit/%s.json";

    CURL *curl_handle;
    CURLcode res;
    char *url;
    //var that receive json
    struct http_data_t chunk;

    chunk.data = malloc(sizeof(struct http_data_t));
    chunk.size = 0;

    curl_global_init(CURL_GLOBAL_ALL);

    curl_handle = curl_easy_init();

    url = calloc(sizeof(char), strlen(url_model) + strlen(code) + 1);
    //create final url
    sprintf(url, url_model, code);
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
    curl_global_cleanup();

    return chunk.data;
}

size_t write_memory(void *contents, size_t size, size_t nmemb, void *userp)
{
    size_t realsize = size * nmemb;
    struct http_data_t *mem = (struct http_data_t *)userp;

    char *ptr = realloc(mem->data, mem->size + realsize + 1);

    if (ptr == NULL)
    {
        printf("Out of memory\n");
        return 0;
    }

    mem->data = ptr;
    memcpy(&(mem->data[mem->size]), contents, realsize);
    mem->size += realsize;
    mem->data[mem->size] = 0;

    return realsize;
}