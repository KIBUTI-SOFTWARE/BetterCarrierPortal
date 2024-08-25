<?php

namespace App\Models;

class UsersModel extends MongoConnectionModel
{
    protected string $users_collection = 'users';
    protected string $otp_collection = 'otp';

    public function addUser(array $user_data): ?array
    {
        $database = $this->connectToDatabase();
        $collection = $database->selectCollection($this->users_collection);
        $insert_result = $collection->insertOne($user_data);

        if ($insert_result->getInsertedCount() === 1) {
            return $this->convertDocumentToArray($user_data);
        } else {
            return null;
        }
    }

    public function isUserWithEmailExisting(string $email): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $user = $collection->findOne([
            'user_email' => $email,
            'user_deleted_flag' => false
        ]);

        return $user ? $this->convertDocumentToArray($user) : null;
    }

    public function isUserWithPhoneExisting(string $phone): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $user = $collection->findOne([
            'user_phone' => $phone,
            'user_deleted_flag' => false
        ]);

        return $user ? $this->convertDocumentToArray($user) : null;
    }

    public function getUsers($user_level): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $query = $user_level === '1' ? [] : ['user_deleted_flag' => false, 'user_level' => ['$gt' => 1]];

        $users = iterator_to_array($collection->find($query));

        return array_map([$this, 'convertDocumentToArray'], $users);
    }

    public function getUsersByLevel($user_level): array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $users = iterator_to_array($collection->find([
            'user_deleted_flag' => false,
            'user_level' => $user_level
        ]));

        return array_map([$this, 'convertDocumentToArray'], $users);
    }

    public function getUserByID($user_id): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $user = $collection->findOne([
            '_id' => new \MongoDB\BSON\ObjectId($user_id),
            'user_deleted_flag' => false
        ]);

        return $user ? $this->convertDocumentToArray($user) : null;
    }

    public function searchUser($identifier): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        try {
            $objectId = new \MongoDB\BSON\ObjectId($identifier);
            $query = ['_id' => $objectId];
        } catch (\Throwable $e) {
            // Identifier is not a valid ObjectId, then it's an email or phone
            $query = [
                '$or' => [
                    ['user_email' => $identifier],
                    ['user_phone' => $identifier]
                ]
            ];
        }

        $query['user_deleted_flag'] = false;

        $user = $collection->findOne($query);

        return $user ? $this->convertDocumentToArray($user) : null;
    }

    public function updateUser(array $data, $id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $updateResult = $collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => $data]
        );

        return $updateResult->getModifiedCount();
    }

    public function getUserByEmail(string $email): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $user = $collection->findOne([
            'user_email' => $email,
            'user_deleted_flag' => false
        ]);

        return $user ? $this->convertDocumentToArray($user) : null;
    }

    public function getUserByPhone(string $phone): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->users_collection);

        $user = $collection->findOne([
            'user_phone' => $phone,
            'user_deleted_flag' => false
        ]);

        return $user ? $this->convertDocumentToArray($user) : null;
    }

    public function getOTP(string $otp_code): ?array
    {
        $collection = $this->connectToDatabase()->selectCollection($this->otp_collection);

        $otp = $collection->findOne([
            'otp_code' => $otp_code,
            'otp_status' => false
        ]);

        return $otp ? $this->convertDocumentToArray($otp) : null;
    }

    public function saveSentOTP(array $data): bool
    {
        $collection = $this->connectToDatabase()->selectCollection($this->otp_collection);

        $insertResult = $collection->insertOne($data);

        return $insertResult->getInsertedCount() > 0;
    }

    public function updateOTP(array $data, $id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->otp_collection);

        $updateResult = $collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => $data]
        );

        return $updateResult->getModifiedCount();
    }

    public function deleteOTP($id): ?int
    {
        $collection = $this->connectToDatabase()->selectCollection($this->otp_collection);

        $deleteResult = $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

        return $deleteResult->getDeletedCount();
    }
}
