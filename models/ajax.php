<?php

class Model_Ajax extends Model_Base {
    
    // получает список стран
    function getCountries() {
        $query = 'SELECT * FROM countries';
        $result = $this->registry->get('db')->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // получает список регионов
    function getRegions($country) {        
        $query = 'SELECT id, name FROM regions WHERE country_id = :country';
        $result = $this->registry->get('db')->query($query, array('country' => $country));
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // получает список городов
    function getCities($region) {
        $query = 'SELECT id, name FROM cities WHERE region_id = :region';
        $result = $this->registry->get('db')->query($query, array('region' => $region));
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}