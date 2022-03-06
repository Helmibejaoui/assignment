<?php

namespace App\Helpers;

class Decoder
{

    public function decodeToArray(string $fileName):array
    {
        $contentString = file_get_contents('public/uploads/' . $fileName);
        if (str_contains($fileName, 'xml')) {
            $xml = simplexml_load_string($contentString, "SimpleXMLElement", LIBXML_NOCDATA | LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);
            $json = json_encode($xml);
            $jsonArray = json_decode($json, true);
            $users = $jsonArray['row'];
        } else {
            $users = json_decode($contentString, true);
        }
        return $users;
    }

}