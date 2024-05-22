<?php

namespace App\Models;

use Exception;
use MongoDB\Client;

class MongoConnectionModel
{
    protected Client $client;
    protected mixed $location_database;
    private mixed $database;

    public function __construct()
    {
        $uri = $_ENV['mongodb_connection_uri'];
        $this->client = new Client($uri);
        $this->database = $_ENV['mongodb_database']; // Used Database
    }

    public function connectToDatabase(): \MongoDB\Database
    {
        return $this->client->selectDatabase($this->database);
    }

    // Function to convert MongoDB document to array
    public static function convertDocumentToArray($document): array
    {
        $array = (array) $document;
        foreach ($array as $key => $value) {
            if ($value instanceof \MongoDB\BSON\ObjectId) {
                $array[$key] = (string) $value;
            }
        }
        return $array;
    }
}
