<?php
namespace App\Jobs;



use App\Models\MongoConnectionModel;

class Jobs
{
    protected $data;
    protected MongoConnectionModel $mongoDb;

    public function __construct($data)
    {
        $this->data = $data;
        $this->mongoDb = new MongoConnectionModel();
    }

    public function handle(): void
    {
        $db = $this->mongoDb->connectToDatabase();
        $collection = $db->selectCollection('queue_jobs');
        $collection->insertOne($this->data);
    }
}

