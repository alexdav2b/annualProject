#include "headers/headers.h"

struct http_data_t
{
    char *data;
    size_t size;
};

static size_t
write_memory(void *contents, size_t size, size_t nmemb, void *userp)
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

char *
get_product(char code[14], char **err)
{
    const char url_model[] = "https://fr.openfoodfacts.org/api/v0/produit/%s.json";

    CURL *curl_handle;
    CURLcode res;
    char *url;

    struct http_data_t chunk;

    chunk.data = malloc(sizeof(struct http_data_t));
    chunk.size = 0;

    curl_global_init(CURL_GLOBAL_ALL);

    curl_handle = curl_easy_init();

    url = calloc(sizeof(char), strlen(url_model) + strlen(code) + 1);
    //comme printf 2e parm das le code format du premier
    sprintf(url, url_model, code);

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

int fromBarcodeToName()
{
    char code[] = "3029330003533";
    // https://fr.openfoodfacts.org/api/v0/produit/3029330003533.json
    char *err;
    char *data = get_product(code, &err);

    json_t *root;
    json_error_t error;

    root = json_loads(data, 0, &error);
    if (!root)
    {
        fprintf(stderr, "error: on line %d: %s\n", error.line, error.text);
        return 1;
    }

    const char *key;
    json_t *value;

    void *iter = json_object_iter(root);
    while (iter)
    {
        key = json_object_iter_key(iter);
        value = json_object_iter_value(iter);

        printf("Key: %s, Value: %s\n", key, json_string_value(value));

        iter = json_object_iter_next(root, iter);
    }

    json_decref(root);

    // json_t *root;
    // json_error_t error;

    // root = json_loads(data, 0, &error);
    // if (!root)
    // {
    //     fprintf(stderr, "error: on line %d: %s\n", error.line, error.text);
    //     return 1;
    // }

    // const char *key;
    // json_t *value;

    // void *iter = json_object_iter(root);
    // while (iter)
    // {
    //     key = json_object_iter_key(iter);
    //     value = json_object_iter_value(iter);

    //     if (strcmp(key, "product"))
    //     {
    //         // json_t *product = json_object_val(value);
    //         void *product_iter = json_object_iter(value);

    //         const char *product_key;
    //         json_t *product_value;
    //             puts("e");

    //         while (product_iter)
    //         {
    //             product_key = json_object_iter_key(iter);
    //             product_value = json_object_iter_value(iter);

    //             if (strcmp(product_key, "origins"))
    //             {
    //                 puts(json_string_value(product_value));
    //             }

    //             product_iter = json_object_iter_next(value, product_iter);
    //         }
    //     }

    //     iter = json_object_iter_next(root, iter);
    // }

    // json_decref(root);

    return 0;
}
