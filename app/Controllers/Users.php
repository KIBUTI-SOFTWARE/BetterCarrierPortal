<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use Exception;

class Users extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        //Reserved
    }

    public function getUser($user_id): ?array
    {
        $model = new UsersModel();

        return $model->getUserByID($user_id);
    }

    public function viewUsers(): string
    {
        $session = \Config\Services::session();

        $user = $session->get('user');
        $user_id = $user['_id'];
        $user_level = $user['user_level'];

        $model = new UsersModel();


        if ($this->request->getUri()->getPath() === '/view-employers') {
            $users = $model->getUsersByLevel("3");
        } else if ($this->request->getUri()->getPath()=== '/view-job-seekers') {
            $users = $model->getUsersByLevel("4");
        } else {
            $users = $model->getUsers($user_level);
        }

        $data = [
            'users' => $users
        ];
        return view('users', $data);
    }

    public function getProfile(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('get')) {
            $authHeader = $this->request->getHeaderLine('Authorization');
            $user_token = (new Authentication)->getTokenData($authHeader);
            $token_data = json_decode($user_token, true);

            if (!is_null($token_data)) {
                $user_data = $token_data['token_data']['data'];

                $user_id = $user_data['_id'];

                $model = new UsersModel();

                $result = $model->getUserByID($user_id);

                if (empty($result)) {
                    return $this->respond(['status' => 'failure', 'message' => 'Could not Find User Data.', 'data' => ''], 500);
                } else {
                    unset($result['user_password']);
                    return $this->respond(['status' => 'success', 'message' => 'User Profile Retrieved Successfully.', 'data' => $result], 200);
                }
            }
            return $this->respond(['status' => 'failure', 'message' => 'Unauthorized Access.', 'data' => ''], 401);
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function updateUserLevel(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('patch')) {
            $authHeader = $this->request->getHeaderLine('Authorization');
            $user_token = (new Authentication)->getTokenData($authHeader);
            $token_data = json_decode($user_token, true);

            if (!is_null($token_data)) {
                $validation = \Config\Services::validation();
                $data = $this->request->getJSON(true);
                $user_data = $token_data['token_data']['data'];
                helper(['form']);

                if (!is_null($data)) {

                    $validation->setRules([
                        'user_id' => [
                            'rules' => 'required',
                            'label' => "User ID",
                            'errors' => [
                                'required' => "User ID Field Cannot be Empty.",
                            ]
                        ],

                        'user_new_level' => [
                            'rules' => 'required|in_list[1,2,3,4]',
                            'label' => "User New Level",
                            'errors' => [
                                'required' => "User New Level Field Cannot be Empty.",
                                'in_list' => "Please Select a Valid User Level.",
                            ]
                        ],
                    ]);

                    if ($validation->run($data)) {

                        $updated_by = $user_data['_id'];
                        $user_level = $user_data['user_level'];

                        $user_id = $data['user_id'];
                        $user_new_level = $data['user_new_level'];

                        if ($user_level < "3") {

                            $model = new UsersModel();

                            $result = $model->getUserByID($user_id);

                            if (empty($result)) {
                                return $this->respond(['status' => 'failure', 'message' => 'Could not Find User Data.', 'data' => $data], 500);
                            } else {

                                $update_data = [
                                    'user_level' => $user_new_level,
                                    'user_updated_by' => $updated_by,
                                    'user_updated_on' => CustomFunctions::getDate(),
                                ];

                                $update_profile_result = $model->updateUser($update_data, $user_id);

                                if (empty($update_profile_result)) {
                                    return $this->respond(['status' => 'failure', 'message' => 'Could Not Update User Profile, Please Try Again.', 'data' => ''], 400);
                                } else {
                                    return $this->respond(['status' => 'success', 'message' => 'User Profile Updated Successfully.', 'data' => ''], 200);
                                }

                            }
                        } else {

                            return $this->respond(['status' => 'failure', 'message' => 'Unauthorized Access.', 'data' => $data], 401);
                        }

                    } else {
                        return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                    }

                } else {

                    return $this->respond(['status' => 'failure', 'message' => 'Invalid Body.', 'data' => ''], 400);
                }
            }
            return $this->respond(['status' => 'failure', 'message' => 'Unauthorized Access.', 'data' => ''], 401);
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function updateProfile(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('patch')) {
            $authHeader = $this->request->getHeaderLine('Authorization');
            $user_token = (new Authentication)->getTokenData($authHeader);
            $token_data = json_decode($user_token, true);

            if (!is_null($token_data)) {
                $validation = \Config\Services::validation();
                $data = $this->request->getJSON(true);
                $user_data = $token_data['token_data']['data'];
                helper(['form']);

                if (!is_null($data)) {

                    $validation->setRules([
                        'user_firstname' => [
                            'rules' => 'required',
                            'label' => "First Name",
                            'errors' => [
                                'required' => "First Name Field Cannot be Empty.",
                            ]
                        ],

                        'user_lastname' => [
                            'rules' => 'required',
                            'label' => "Last Name",
                            'errors' => [
                                'required' => "Last Name Field Cannot be Empty.",
                            ]
                        ],

                        'user_profile' => [
                            'rules' => 'required',
                            'label' => "User Profile",
                            'errors' => [
                                'required' => "User Profile Field Cannot be Empty.",
                            ]
                        ],
                    ]);

                    if ($validation->run($data)) {

                        $user_id = $user_data['_id'];
                        $user_firstname = $data['user_firstname'];
                        $user_lastname = $data['user_lastname'];
                        $user_profile = $data['user_profile'] ?? array();

                        $model = new UsersModel();

                        $result = $model->getUserByID($user_id);

                        if (empty($result)) {
                            return $this->respond(['status' => 'failure', 'message' => 'Could not Find User Data.', 'data' => $data], 500);
                        } else {
                            $update_data = [
                                'user_firstname' => $user_firstname,
                                'user_lastname' => $user_lastname,
                                'user_profile' => json_encode($user_profile),
                            ];
                            $update_profile_result = $model->updateUser($update_data, $user_id);

                            if (empty($update_profile_result)) {
                                return $this->respond(['status' => 'failure', 'message' => 'Could Not Update User Profile, Please Try Again.', 'data' => ''], 400);
                            } else {
                                return $this->respond(['status' => 'success', 'message' => 'User Profile Updated Successfully.', 'data' => ''], 200);
                            }

                        }

                    } else {
                        return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                    }

                } else {

                    return $this->respond(['status' => 'failure', 'message' => 'Invalid Body.', 'data' => ''], 400);
                }
            }
            return $this->respond(['status' => 'failure', 'message' => 'Unauthorized Access.', 'data' => ''], 401);
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function getAllUsers(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('get')) {
            $authHeader = $this->request->getHeaderLine('Authorization');
            $user_token = (new Authentication)->getTokenData($authHeader);
            $token_data = json_decode($user_token, true);

            if (!is_null($token_data)) {
                $user_data = $token_data['token_data']['data'];

                $user_level = $user_data['user_level'];

                $model = new UsersModel();

                $result = $model->getUsers($user_level);

                if (empty($result)) {
                    return $this->respond(['status' => 'failure', 'message' => 'Could not Find User Data.', 'data' => ''], 500);
                } else {
                    unset($result['user_password']);
                    return $this->respond(['status' => 'success', 'message' => 'User Accounts Retrieved Successfully.', 'data' => $result], 200);
                }
            }
            return $this->respond(['status' => 'failure', 'message' => 'Unauthorized Access.', 'data' => ''], 401);
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function searchUser(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            $authHeader = $this->request->getHeaderLine('Authorization');
            $user_token = (new Authentication)->getTokenData($authHeader);
            $token_data = json_decode($user_token, true);

            if (!is_null($token_data)) {
                $validation = \Config\Services::validation();
                $data = $this->request->getJSON(true);
                helper(['form']);

                if (!is_null($data)) {

                    $validation->setRules([
                        'identifier' => [
                            'rules' => 'required',
                            'label' => "Identifier",
                            'errors' => [
                                'required' => "Identifier Field Cannot be Empty.",
                            ]
                        ],
                    ]);

                    if ($validation->run($data)) {

                        $identifier = $data['identifier'];

                        $model = new UsersModel();

                        $result = $model->searchUser($identifier);

                        if (empty($result)) {
                            return $this->respond(['status' => 'failure', 'message' => 'Could not Find User with the Specified Identifier.', 'data' => ''], 500);
                        } else {
                            unset($result['user_password']);
                            return $this->respond(['status' => 'success', 'message' => 'User Account(s) Retrieved Successfully.', 'data' => $result], 200);
                        }

                    } else {
                        return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                    }

                } else {

                    return $this->respond(['status' => 'failure', 'message' => 'Invalid Body.', 'data' => ''], 400);
                }
            }
            return $this->respond(['status' => 'failure', 'message' => 'Unauthorized Access.', 'data' => ''], 401);
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function updatePassword(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('patch')) {
            $authHeader = $this->request->getHeaderLine('Authorization');
            $user_token = (new Authentication)->getTokenData($authHeader);
            $token_data = json_decode($user_token, true);

            if (!is_null($token_data)) {
                $validation = \Config\Services::validation();
                $data = $this->request->getJSON(true);
                $user_data = $token_data['token_data']['data'];
                helper(['form']);

                if (!is_null($data)) {

                    $validation->setRules([
                        'current_password' => [
                            'rules' => 'required',
                            'label' => "Current Password",
                            'errors' => [
                                'required' => "Current Password Field Cannot be Empty.",
                            ]
                        ],

                        'new_password' => [
                            'rules' => 'required',
                            'label' => "New Password",
                            'errors' => [
                                'required' => "New Password Field Cannot be Empty.",
                            ]
                        ],

                        'confirm_new_password' => [
                            'rules' => 'required',
                            'label' => "Confirm Password",
                            'errors' => [
                                'required' => "Confirm Password Field Cannot be Empty.",
                            ]
                        ],
                    ]);

                    if ($validation->run($data)) {

                        $user_id = $user_data['_id'];
                        $current_password = $data['current_password'];
                        $new_password = $data['new_password'];
                        $confirm_new_password = $data['confirm_new_password'];

                        if ($new_password === $confirm_new_password) {

                            $model = new UsersModel();

                            $result = $model->getUserByID($user_id);

                            if (empty($result)) {
                                return $this->respond(['status' => 'failure', 'message' => 'Could not Find User Data.', 'data' => $data], 500);
                            } else {
                                if (password_verify($current_password, $result['user_password'])) {
                                    $update_data = [
                                        'user_password' => password_hash($new_password, PASSWORD_DEFAULT)
                                    ];
                                    $update_password_result = $model->updateUser($update_data, $user_id);

                                    if (empty($update_password_result)) {
                                        return $this->respond(['status' => 'failure', 'message' => 'Could Not Update User Password, Please Try Again.', 'data' => ''], 400);
                                    } else {
                                        return $this->respond(['status' => 'success', 'message' => 'User Password Updated Successfully.', 'data' => ''], 200);
                                    }
                                } else {
                                    return $this->respond(['status' => 'failure', 'message' => 'Incorrect Current Password.', 'data' => ''], 400);
                                }

                            }
                        } else {
                            return $this->respond(['status' => 'failure', 'message' => 'The New Passwords Do Not Match.', 'data' => ''], 400);
                        }

                    } else {
                        return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                    }

                } else {

                    return $this->respond(['status' => 'failure', 'message' => 'Invalid Body.', 'data' => ''], 400);
                }
            }
            return $this->respond(['status' => 'failure', 'message' => 'Unauthorized Access.', 'data' => ''], 401);
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }
}