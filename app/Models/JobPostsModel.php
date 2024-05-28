<?php

namespace App\Models;

class JobPostsModel extends MongoConnectionModel
{
    protected string $job_posts_collection = 'job_posts';

    public function addJobPost(array $user_data): ?array
    {
        $database = $this->connectToDatabase();
        $collection = $database->selectCollection($this->job_posts_collection);
        $insert_result = $collection->insertOne($user_data);

        if ($insert_result->getInsertedCount() === 1) {
            return $this->convertDocumentToArray($user_data);
        } else {
            return null;
        }
    }

    public function getJobPosts($user_level, $user_id): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_posts_collection);

        if ($user_level === '3') {
            // Query for user level 3: Return posts created by the given user_id and not deleted
            $query = ['job_post_deleted_flag' => false, 'job_post_created_by' => $user_id];
        } else {
            // Query for other user levels: Return posts not deleted
            $query = ['job_post_deleted_flag' => false];
        }

        $users = iterator_to_array($collection->find($query));

        return array_map([$this, 'convertDocumentToArray'], $users);
    }

    public function getJobPostsByCategory($category, $user_level, $user_id): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_posts_collection);

        if ($user_level === '3') {
            // Query for user level 3: Return posts created by the given user_id and not deleted
            $query = ['job_post_deleted_flag' => false, 'job_post_created_by' => $user_id, 'job_post_category' => $category];
        } else {
            // Query for other user levels: Return posts not deleted
            $query = ['job_post_deleted_flag' => false, 'job_post_category' => $category];
        }

        $users = iterator_to_array($collection->find($query));

        return array_map([$this, 'convertDocumentToArray'], $users);
    }

    public function updateJobPost(array $data, $id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_posts_collection);

        $updateResult = $collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => $data]
        );

        return $updateResult->getModifiedCount();
    }

    public function deleteJobPost($id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->job_posts_collection);

        $deleteResult = $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

        return $deleteResult->getDeletedCount();
    }
}
