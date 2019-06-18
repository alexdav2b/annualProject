
struct http_data_t
{
    char *data;
    size_t size;
};

int fromBarcodeToName();
    char * get_product(char code[14], char **err);
        size_t write_memory(void *contents, size_t size, size_t nmemb, void *userp);