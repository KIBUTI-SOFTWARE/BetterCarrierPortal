<?php

namespace App\Models;

use Exception;
use MongoDB\Client;

class MongoConnectionModel
{
    protected Client $client;
    protected mixed $location_database;
    private mixed $users_database;

    public function __construct()
    {
        $uri = $_ENV['mongodb_connection_uri'];
        $this->client = new Client($uri);
        $this->location_database = $_ENV['mongodb_locations_database']; // Locations Database
        $this->users_database = $_ENV['mongodb_users_database']; // Locations Database
    }

    public function connectToLocationsDatabase(): \MongoDB\Database
    {
        return $this->client->selectDatabase($this->location_database);
    }

    public function connectToUsersDatabase(): \MongoDB\Database
    {
        return $this->client->selectDatabase($this->users_database);
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
