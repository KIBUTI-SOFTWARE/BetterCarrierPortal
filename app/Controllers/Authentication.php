<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use Exception;
use Firebase\JWT\JWT;
use Config\MyFunctions as CustomFunctions;
use Firebase\JWT\Key;

class Authentication extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        //Reserved
    }

    /**
     * @throws Exception
     */
    public function register(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getJSON(true);
            $validation = \Config\Services::validation();
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

                    'user_email' => [
                        'rules' => 'required|valid_email',
                        'label' => "User Email",
                        'errors' => [
                            'required' => "User Email Field Cannot be Empty.",
                            'valid_email' => "User Email Field must contain a valid Email.",
                        ]
                    ],

                    'user_phone' => [
                        'rules' => 'required|exact_length[10]',
                        'label' => 'Phone',
                        'errors' => [
                            'required' => 'Phone Field Cannot be Empty.',
                            'exact_length' => 'Please Enter a valid Phone Number.'
                        ]
                    ],

                    'user_password' => [
                        'rules' => 'required',
                        'label' => 'Phone',
                        'errors' => [
                            'required' => 'Password Field Cannot be Empty.'
                        ]
                    ],
                ]);

                if ($validation->run($data)) {

                    $user_firstname = $data['user_firstname'];
                    $user_lastname = $data['user_lastname'];
                    $user_email = $data['user_email'];
                    $user_phone = $data['user_phone'];
                    $user_password = password_hash($data['user_password'], PASSWORD_DEFAULT);
                    $user_level = $data['user_level'] ?? "3";

                    $conn = db_connect();
                    $model = new UsersModel();

                    $insertionData = [
                        'user_firstname' => $user_firstname,
                        'user_lastname' => $user_lastname,
                        'user_email' => $user_email,
                        'user_phone' => $user_phone,
                        'user_password' => $user_password,
                        'user_profile' => json_encode(array()),
                        'user_level' => $user_level,
                        'user_account_activated' => false,
                        'user_created_on' => CustomFunctions::getDate(),
                        'user_deleted_flag' => false,
                        'user_updated_by' => "",
                        'user_updated_on' => "",
                        'user_deleted_by' => "",
                        'user_deleted_on' => ""
                    ];

                    $isUserWithSimilarEmailExisting = $model->isUserWithEmailExisting($user_email);
                    $isUserWithSimilarPhoneExisting = $model->isUserWithPhoneExisting($user_phone);

                    if (empty($isUserWithSimilarEmailExisting) && empty($isUserWithSimilarPhoneExisting)) {
                        $result = $model->addUser($insertionData);

                        if (empty($result)) {
                            return $this->respond(['status' => 'failure', 'message' => 'Could not Create User.', 'data' => $data], 500);

                        } else {
                            $otp_code = CustomFunctions::generateValidationLink();
                            $sendTO = $user_email;
                            $subject = "Account Activation Code.";

                            $html_template = file_get_contents(__DIR__.'/Templates/account_activation.html');
                            $verification_url = base_url("api/v1/auth/verify/$otp_code");

                            $html_content = str_replace('{{username}}', $user_firstname, $html_template);
                            $html_content = str_replace('{{base_url}}', base_url(), $html_content);
                            $html_content = str_replace('{{otp}}', $verification_url, $html_content);

                            $message = $html_content;

                            $OTPSendingResults = CustomFunctions::sendVerificationEmail($subject, $message, $sendTO);

                            if (!empty($OTPSendingResults) && $OTPSendingResults === 'SUCCESS') {
                                $OTP_data = [
                                    'otp_code' => $otp_code,
                                    'otp_sent_to' => $sendTO,
                                    'otp_sent_on' => CustomFunctions::getDate(),
                                    'otp_expires_on' => "",
                                    'otp_status' => false
                                ];

                                $sent_OTP = $model->saveSentOTP($OTP_data);
                                if (empty($sent_OTP)) {
                                    return $this->respond(['status' => 'failure', 'message' => 'An Error Occurred while sending the email verification code.', 'data' => $data], 500);
                                } else {

                                    return $this->respond(['status' => 'success', 'message' => 'Account Created Successfully, and a Verification Email has been Sent.', 'data' => ["user_data" => $data, "verification_link" => $verification_url]], 200);
                                }
                            } else {
                                return $this->respond(['status' => 'failure', 'message' => 'An Error Occurred while sending the email verification code.', 'data' => $data], 400);
                            }
                        }
                    } else {
                        if ($isUserWithSimilarEmailExisting && $isUserWithSimilarPhoneExisting) {
                            return $this->respond(['status' => 'failure', 'message' => 'User With Similar Phone Number and Email Address Already Exists.', 'data' => $data], 400);
                        }
                        if (empty($isUserWithSimilarEmailExisting)) {
                            return $this->respond(['status' => 'failure', 'message' => 'User With Similar Phone Number Already Exists.', 'data' => $data], 400);
                        }
                        if (empty($isUserWithSimilarPhoneExisting)) {
                            return $this->respond(['status' => 'failure', 'message' => 'User With Similar Email Address Already Exists.', 'data' => $data], 400);
                        }
                    }

                } else {
                    return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                }

            } else {

                return $this->respond(['status' => 'failure', 'message' => 'Invalid Body.', 'data' => ''], 400);
            }

        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function verifyAccount($otp_code): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('get')) {
            $model = new UsersModel();

            $otp_data = $model->getOTP($otp_code);

            if (empty($otp_data)) {
                return $this->respond(['status' => 'failure', 'message' => 'Incorrect Verification Link.', 'data' => ''], 400);
            } else {
                $otp_id = $otp_data['_id'];

                $updateUserData = [
                    'user_account_activated' => true
                ];

                $user_data = $model->getUserByEmail($otp_data['otp_sent_to']);

                if (empty($user_data)) {
                    return $this->respond(['status' => 'failure', 'message' => 'User Account Not Found.', 'data' => ''], 400);
                }

                $update_user = $model->updateUser($updateUserData, $user_data['_id']);
                $update_otp = $model->deleteOTP($otp_id);

                if (empty($update_user) || empty($update_otp)) {
                    return $this->respond(["status" => "failure", "message" => "Couldn't Verify Account, Please Try Again.", "data" => ""], 400);
                } else {
                    unset($user_data['user_password']);
                    return $this->respond(["status" => "success", "message" => "Account Verified Successfully.", "data" => $user_data], 200);
                }
            }
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);

    }

    public function verifyPasswordRecoveryLink($otp_code): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('get')) {
            $model = new UsersModel();

            $otp_data = $model->getOTP($otp_code);

            if (empty($otp_data)) {
                return $this->respond(['status' => 'failure', 'message' => 'Incorrect Verification Link.', 'data' => ''], 400);
            } else {
                $otp_id = $otp_data['_id'];

                $user_data = $model->getUserByEmail($otp_data['otp_sent_to']);

                if (empty($user_data)) {
                    return $this->respond(['status' => 'failure', 'message' => 'User Account Not Found.', 'data' => ''], 400);
                }

                $update_otp = $model->deleteOTP($otp_id);

                if (empty($update_otp)) {
                    return $this->respond(["status" => "failure", "message" => "Couldn't Verify Account, Please Try Again.", "data" => ""], 400);
                } else {
                    unset($user_data['user_password']);
                    return $this->respond(["status" => "success", "message" => "Account Verified Successfully.", "data" => $user_data], 200);
                }
            }
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);

    }

    public function verifyEmail(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getJSON(true);
            $validation = \Config\Services::validation();
            helper(['form']);

            if (!is_null($data)) {

                $validation->setRules([
                    'username' => [
                        'rules' => 'required',
                        'label' => 'Username',
                        'errors' => [
                            'required' => 'Username Field Cannot be Empty.',
                        ]
                    ]
                ]);

                if ($validation->run($data)) {
                    $username = $data['username'];

                    $model = new UsersModel();

                    $user_data = $model->searchUser($username);

                    if (empty($user_data)) {
                        return $this->respond(['status' => 'failure', 'message' => 'Could not Find User with the username.', 'data' => $data], 400);

                    } else if ($user_data['user_deleted_flag'] === true) {
                        return $this->respond(['status' => 'failure', 'message' => 'Account Not Found.', 'data' => $data], 400);
                    } else {
                        if ($user_data['user_account_activated'] === true) {

                            $otp_code = CustomFunctions::generateValidationLink();
                            $sendTO = $user_data['user_email'];
                            $subject = "Password Recovery.";

                            $html_template = file_get_contents(__DIR__.'/Templates/password_recovery.html');
                            $verification_url = base_url("api/v1/auth/verify/$otp_code");

                            $html_content = str_replace('{{username}}', $user_data['user_firstname'], $html_template);
                            $html_content = str_replace('{{base_url}}', base_url(), $html_content);
                            $html_content = str_replace('{{otp}}', $verification_url, $html_content);

                            $message = $html_content;

                            $OTPSendingResults = CustomFunctions::sendVerificationEmail($subject, $message, $sendTO);

                            if (!empty($OTPSendingResults) && $OTPSendingResults === 'SUCCESS') {
                                $OTP_data = [
                                    'otp_code' => $otp_code,
                                    'otp_sent_to' => $sendTO,
                                    'otp_sent_on' => CustomFunctions::getDate(),
                                    'otp_expires_on' => "",
                                    'otp_status' => false
                                ];

                                $sent_OTP = $model->saveSentOTP($OTP_data);

                                if (empty($sent_OTP)) {
                                    return $this->respond(['status' => 'failure', 'message' => 'An Error Occurred while sending the email verification code.', 'data' => $data], 500);
                                } else {

                                    return $this->respond(['status' => 'success', 'message' => 'An email with the password recovery link has been sent to you.', 'data' => $data], 200);
                                }
                            } else {
                                return $this->respond(['status' => 'failure', 'message' => 'An Error Occurred while sending the email verification code.', 'data' => $data], 400);
                            }

                        }
                    }

                    $_SESSION['error'] = "Your Account is Disabled.";
                } else {
                    return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                }

            } else {

                return $this->respond(['status' => 'failure', 'message' => 'Invalid Body.', 'data' => ''], 400);
            }
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function setNewPassword(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('patch')) {
            //Retrieve Submitted Data
            $data = $this->request->getJSON(true);
            $validation = \Config\Services::validation();
            helper(['form']);

            if (!is_null($data)) {

                $validation->setRules([
                    'user_id' => [
                        'rules' => 'required',
                        'label' => 'User ID',
                        'errors' => [
                            'required' => 'User ID Field Cannot be Empty.',
                        ]
                    ],

                    'new_password' => [
                        'rules' => 'required',
                        'label' => 'Password',
                        'errors' => [
                            'required' => 'Password Field Cannot be Empty.',
                        ]
                    ],

                    'confirm_new_password' => [
                        'rules' => 'required',
                        'label' => 'Confirm Password',
                        'errors' => [
                            'required' => 'Confirm Password Field Cannot be Empty.',
                        ]
                    ],
                ]);

                if ($validation->run($data)) {

                    $password = $data['new_password'];
                    $confirm_password = $data['confirm_new_password'];
                    $user_id = $data['user_id'];

                    $userModel = new UsersModel();
                    $result = $userModel->getUserByID($user_id);

                    if ($password === $confirm_password) {
                        if (empty($result)) {
                            return $this->respond(['status' => 'failure', 'message' => 'Could not Find User with Email or Phone Number.', 'data' => $data], 400);

                        } else if ($result['user_deleted_flag'] === true) {
                            return $this->respond(['status' => 'failure', 'message' => 'Account Not Found.', 'data' => $data], 400);
                        } else if ($result['user_account_activated'] === true) {
                            $newPassword = [
                                'user_password' => password_hash($password, PASSWORD_DEFAULT),
                            ];

                            $result = $userModel->updateUser($newPassword, $user_id);

                            if (empty($result)) {
                                return $this->respond(['status' => 'failure', 'message' => 'Could not Update User Password, Please Try Again.', 'data' => $data], 400);
                            } else {
                                return $this->respond(['status' => 'failure', 'message' => 'User Password Updated Successfully.', 'data' => $data], 200);
                            }
                        } else {
                            return $this->respond(['status' => 'failure', 'message' => 'Your Account is Disabled.', 'data' => $data], 400);
                        }
                    } else {
                        return $this->respond(['status' => 'failure', 'message' => 'New and Confirm Password Values must be the same.', 'data' => $data], 400);
                    }

                } else {
                    return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                }

            } else {

                return $this->respond(['status' => 'failure', 'message' => 'Invalid Body.', 'data' => ''], 400);
            }

        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);

    }

    public function login(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            $validation = \Config\Services::validation();
            $data = $this->request->getJSON(true);
            helper(['form']);

            if (!is_null($data)) {

                $validation->setRules([
                    'username' => [
                        'rules' => 'required',
                        'label' => "UserName",
                        'errors' => [
                            'required' => "UserName Field Cannot be Empty.",
                        ]
                    ],

                    'password' => [
                        'rules' => 'required',
                        'label' => "Password",
                        'errors' => [
                            'required' => "Password Field Cannot be Empty.",
                        ]
                    ],
                ]);

                if ($validation->run($data)) {

                    $username = $data['username'];
                    $password = $data['password'];

                    $conn = db_connect();
                    $model = new UsersModel();

                    $result = $model->searchUser($username);

                    if (empty($result)) {
                        return $this->respond(['status' => 'failure', 'message' => 'Could not Find user with the username.', 'data' => $data], 401);
                    } else {
                        if ($result['user_deleted_flag'] === true) {
                            return $this->respond(['status' => 'failure', 'message' => 'Account Not Found.', 'data' => $data], 401);
                        } else {
                            if ($result['user_account_activated'] === true) {
                                if (password_verify($password, $result['user_password'])) {

                                    $_SESSION['user'] = $result;
                                    $key = getenv('JWT_SECRET');
                                    $iat = time(); // current timestamp value
                                    $exp = $iat + 900;

                                    $payload = array(
                                        "app" => "LOCATIONS API v1",
                                        "iat" => $iat, //Time the JWT issued at
                                        "exp" => $exp, // Expiration time of token
                                        "data" => $result,
                                    );

                                    $token = JWT::encode($payload, $key, 'HS256');

                                    return $this->respond(['status' => 'success', 'message' => 'Logged in Successfully.', 'data' => ['token' => $token]], 200);
                                }

                                return $this->respond(['status' => 'failure', 'message' => 'Incorrect Password or Username.', 'data' => $data], 401);
                            } else {
                                return $this->respond(['status' => 'failure', 'message' => 'Account is Disabled.', 'data' => $data], 401);
                            }

                        }

                    }

                } else {
                    return $this->respond(['status' => 'failure', 'message' => ($validation->getErrors()), 'data' => $data], 400);
                }

            } else {

                return $this->respond(['status' => 'failure', 'message' => 'Invalid Username or Password.', 'data' => ''], 401);
            }
        }
        return $this->respond(['status' => 'failure', 'message' => 'The Requested URL could not be Found.', 'data' => ''], 404);
    }

    public function getTokenData($auth = null): \CodeIgniter\HTTP\ResponseInterface|bool|string
    {
        if ($auth === null) {
            $authHeader = $this->request->getHeaderLine('Authorization');
        }  else {
            $authHeader = $auth;
        }
        $matches = array();
        $key = getenv('JWT_SECRET');
        if (empty($authHeader) || !preg_match('/Bearer (.+)/', $authHeader, $matches)) {
            return $this->respond(['status' => 'failure', 'message' => 'Incorrect Authorization Token.', 'data' => ''], 401);
        }
        $token = $matches[1];
        $token_data = JWT::decode($token, new Key($key, 'HS256'));
        return json_encode(['token_data' => $token_data]);
    }

    public function generateRefreshToken(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $token = $this->request->getHeaderLine('Authorization');

            $key = getenv('JWT_SECRET');
            $matches = array();
            if (empty($token) || !preg_match('/Bearer (.+)/', $token, $matches)) {
                throw new \Exception('Incorrect Authorization Token.', 401);
            }
            $token = $matches[1];
            $token_data = JWT::decode($token, new Key($key, 'HS256'));
            $user_data = json_decode(json_encode($token_data), true);

            $iat = time(); // current timestamp value
            $exp = $iat + 1296000;

            $payload = array(
                "app" => "LOCATIONS API v1",
                "iat" => $iat, //Time the JWT issued at
                "exp" => $exp, // Expiration time of token
                "data" => $user_data['data'],
            );

            $token_generated_on = date('Y-m-d\TH:i:s.uP', $iat);
            $token_expires_on = date('Y-m-d\TH:i:s.uP', $exp);

            $new_token = JWT::encode($payload, $key, 'HS256');

            return $this->respond(['status' => 'success', 'message' => 'New Token Generated Successfully.', 'data' => ['token' => $new_token, 'generated_on' => $token_generated_on, 'expires_on' => $token_expires_on]], 200);
        } catch (\Throwable $e) {
            // Handle the error
            $status = $e->getCode() ?: 500;
            $message = $e->getMessage() ?: 'An unexpected error occurred.';
            return $this->respond(['status' => 'failure', 'message' => $message, 'data' => ''], $status);
        }
    }
}