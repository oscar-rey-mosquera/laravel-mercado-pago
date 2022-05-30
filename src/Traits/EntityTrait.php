<?php
namespace OscarRey\MercadoPago\Traits;

use Exception;
use MercadoPago\RecuperableError;
use OscarRey\MercadoPago\Generic\SearchResultsArray;

trait EntityTrait {

    public function process_error_body($message){
        $recuperable_error = new RecuperableError(
            $message['message'],
            $message['error'] ?? null,
            $message['status']
        );

        if(isset($message['cause']))
            $recuperable_error->proccess_causes($message['cause']);
        
        $this->error = $recuperable_error;
    }

    /**
     * @return mixed
     */
    public static function search($filters = [], $options = [])
    {
        $class = get_called_class();
        $searchResult = new SearchResultsArray();
        $searchResult->setEntityTypes($class);
        $entityToQuery = new $class();
        
        self::$_manager->setEntityUrl($entityToQuery, 'search');
        self::$_manager->cleanQueryParams($entityToQuery);
        self::$_manager->setQueryParams($entityToQuery, $filters);

        $response = self::$_manager->execute($entityToQuery, 'get');
        if ($response['code'] == "200" || $response['code'] == "201") {
            $searchResult->fetch($filters, $response['body']);
        } elseif (intval($response['code']) >= 400 && intval($response['code']) < 500) {
            $searchResult->process_error_body($response['body']);
            throw new Exception($response['body']['message']);
        } else {
            throw new Exception("Internal API Error");
        }
        return $searchResult;
    }

    
}