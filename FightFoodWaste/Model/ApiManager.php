<?php

Class ApiManager{
    private $url;

    public function __construct(string $table){
        $this->url = 'http://fightfoodwasteapi/' . strtolower($table);
    }

    private function getUrl(): string { return $this->url; }

    public function getAll(){
        $options = array(
            'http' => array( 
                'method'  => 'GET',
                'header'=>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n")
            );
        
        $url = $this->getUrl();

        $context  = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        $json = json_decode($result, true);
        
        return $json;
    }

    public function getById(int $id){
        $options = array(
            'http' => array( 
                'method' => 'GET',
                'header' => "Content-Type: application/json\r\n" . "Accept: application/json\r\n")
            );
        $url = $this->getUrl() . '/' . $id;

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json = json_decode($result, true);
        return $json;        
    }

    public function getByString(string $column, string $value){
        $options = array(
            'http' => array( 
                'method' => 'GET',
                'header' => "Content-Type: application/json\r\n" . "Accept: application/json\r\n")
            );
        $url = $this->getUrl() . '/' . $column . '/' . $value . '/' . 'getByString';

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json = json_decode($result, true);
        return $json;     
    }

    public function getByInt(string $column, int $value){
        $options = array(
            'http' => array( 
                'method'  => 'GET',
                'header'=>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n")
            );
        $url = $this->getUrl() . '/' . $column . '/' . $value . '/' . 'getByInt';

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json = json_decode($result, true);
        return $json;     
    }
    
    public function update($data){
        $options = array(
            'http' => array( 
                'method'  => 'PUT',
                'content' => $data,
                'header'  => "Content-Type: application/json\r\n" . "Accept: application/json\r\n")
            );
        
        $url = $this->getUrl() . '/update';

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json = json_decode($result, true);
        
        return $json;
    }
    
    public function delete(int $id){
        $options = array(
            'http' => array( 
                'method'  => 'DELETE',
                'header'=>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n")
            );
        
        $url = $this->getUrl() . '/delete/' . $id;

        $context  = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        $json = json_decode($result, true);

        return $json; 
    }

    public function create($data){
        $options = array(
            'http' => array( 
                'method'  => 'POST',
                'content' => $data,
                'header'  =>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n")
            );
        
        $url = $this->getUrl() . '/create';

        $context  = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        $json = json_decode($result, true);

        return $json; 
    }
    
}

?>