<?php

namespace App\Models;

use MongoDB\BSON\ObjectId;

class CategoriesModel extends MongoConnectionModel
{
    protected string $categories_collection = 'categories';

    public function addCategory(array $category_data): ?array
    {
        $database = $this->connectToDatabase();
        $collection = $database->selectCollection($this->categories_collection);
        $insert_result = $collection->insertOne($category_data);

        if ($insert_result->getInsertedCount() === 1) {
            return $this->convertDocumentToArray($category_data);
        } else {
            return null;
        }
    }

    public function isCategoryExisting(string $category_name): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->categories_collection);

        $category = $collection->findOne([
            'category_name' => $category_name,
            'category_deleted_flag' => false
        ]);

        return $category ? $this->convertDocumentToArray($category) : null;
    }

    public function getCategories(): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->categories_collection);

        $query = ['category_deleted_flag' => false];

        $category = iterator_to_array($collection->find($query));

        return array_map([$this, 'convertDocumentToArray'], $category);
    }

    public function getCategoryByID($category_id): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->categories_collection);

        $category = $collection->findOne([
            '_id' => new ObjectId($category_id),
            'category_deleted_flag' => false
        ]);

        return $category ? $this->convertDocumentToArray($category) : null;
    }

    public function updateCategory(array $data, $id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->categories_collection);

        $updateResult = $collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $data]
        );

        return $updateResult->getModifiedCount();
    }

    public function deleteCategory($id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->categories_collection);

        $deleteResult = $collection->deleteOne(['_id' => new ObjectId($id)]);

        return $deleteResult->getDeletedCount();
    }

}