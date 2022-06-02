<?php
namespace OscarRey\MercadoPago\Traits;

use Illuminate\Database\Eloquent\JsonEncodingException;


trait ToJsonTrait  
{
 
 
    /**
     * Convert the model instance to JSON.
     *
     * @param  int  $options
     * @return string
     *
     * @throws \Illuminate\Database\Eloquent\JsonEncodingException
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

      /**
     * Convert the object into something JSON serializable.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
    

    /**
   * Convierte un array a json
   * @param array $data
   * @return string
   */
  protected function json($data)
  {

    return json_encode($data);
  }
}