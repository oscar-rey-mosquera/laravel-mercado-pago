<?php
namespace OscarRey\MercadoPago\Generic;

use OscarRey\MercadoPago\Traits\EntityTrait;


class SearchResultsArray extends \MercadoPago\SearchResultsArray 
{
   use EntityTrait;
  
    public function fetch($filters, $body) {
        $this->_filters = $filters;
        if ($body) {
            $results = [];
            if (array_key_exists("results", $body)) {
                $results = $body["results"] ?? [];
            } else if (array_key_exists("elements", $body)) {
                $results = $body["elements"] ?? [];
            }

            foreach ($results as $result) {
                $entity = new $this->_class();
                $entity->fillFromArray($entity, $result);
                $this->append($entity);
            }

            $this->fetchPaging($filters, $body);
        }
    }

    private function fetchPaging($filters, $body) {
        if (array_key_exists("paging", $body)) {
            $paging = $body["paging"];
            $this->limit  = $paging["limit"];
            $this->total  = $paging["total"];
            $this->offset = $paging["offset"];
        } else {
            $this->offset = array_key_exists("offset", $filters) ? $filters["offset"] : 0;
            $this->limit = array_key_exists("limit", $filters) ? $filters["limit"] : 20;
            $this->total  = array_key_exists("total", $body) ? $body["total"] : 0;
        }
    }
  
}