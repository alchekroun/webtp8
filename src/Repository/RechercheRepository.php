<?php
namespace App\Repository;

class RechercheRepository
{
    /**
     * @param $url
     * @param $jsonString string object
     * @return bool|string
     */
    function postJSON($url, $jsonString)
    {
        $url = "127.0.0.1:9200" . $url;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonString));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    function searchInAll($search)
    {
        return $this->postJSON("/biblotheque/_search", "{\"query\": { \"query_string\":{ \"query\": \"*$search*\" } }}");
    }
    //Filter = nom de la colonne sur laquel on veut chercher
    function searchFilter($colonne, $search)
    {
        return $this->postJSON("/biblotheque/_search", "{\"query\": {\"query_string\" : {\"default_field\" : \"$colonne\", \"query\" : \"*$search*\"}} }");
    }
}