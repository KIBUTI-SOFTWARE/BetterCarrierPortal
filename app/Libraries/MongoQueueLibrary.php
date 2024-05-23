<?php
namespace App\Libraries;

use App\Models\MongoConnectionModel;

class MongoQueueLibrary
{
    protected \MongoDB\Collection $collection;

    public function __construct()
    {
        $mongo = new MongoConnectionModel();
        $this->collection = $mongo->connectToDatabase()->selectCollection('queue_jobs');
    }

    public function push($job): void
    {
        $this->collection->insertOne($job);
    }

    public function pop(): object|array|null
    {
        return $this->collection->findOneAndDelete([], ['sort' => ['_id' => 1]]);
    }
}
