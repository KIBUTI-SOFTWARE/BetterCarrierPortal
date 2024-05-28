<?php

namespace App\Models;

class JobApplicationsModel extends MongoConnectionModel
{
    protected string $job_applications_collection = 'job_applications';

    public function addJobApplication(array $user_data): ?array
    {
        $database = $this->connectToDatabase();
        $collection = $database->selectCollection($this->job_applications_collection);
        $insert_result = $collection->insertOne($user_data);

        if ($insert_result->getInsertedCount() === 1) {
            return $this->convertDocumentToArray($user_data);
        } else {
            return null;
        }
    }

    public function getJobApplications(): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_applications_collection);

        $query = ['job_application_deleted_flag' => false];

        $users = iterator_to_array($collection->find($query));

        return array_map([$this, 'convertDocumentToArray'], $users);
    }

    public function getJobPostApplications($post_id): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_applications_collection);

        $query = ['job_application_deleted_flag' => false, 'job_post_id' => $post_id];

        $users = iterator_to_array($collection->find($query));

        return array_map([$this, 'convertDocumentToArray'], $users);
    }

    public function getUsersJobPostApplications($user_id): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_applications_collection);

        $query = ['job_application_deleted_flag' => false, 'job_application_created_by' => $user_id];

        $users = iterator_to_array($collection->find($query));

        return array_map([$this, 'convertDocumentToArray'], $users);
    }

    public function updateJobApplication(array $data, $id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_applications_collection);

        $updateResult = $collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => $data]
        );

        return $updateResult->getModifiedCount();
    }

    public function deleteJobApplication($id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_applications_collection);

        $deleteResult = $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

        return $deleteResult->getDeletedCount();
    }
}
