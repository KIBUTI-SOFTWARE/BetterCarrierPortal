<?php

namespace App\Controllers;

use App\Libraries\MongoQueueLibrary;
use App\Libraries\RedisLibrary;
use App\Libraries\RedisQueueLibrary;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use Config\Session;
use Exception;
use Config\MyFunctions as CustomFunctions;

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
            $data = $this->request->getPost();
            $validation = \Config\Services::validation();
            $session = \Config\Services::session();
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

                    'user_level' => [
                        'rules' => 'required|in_list[3,4]',
                        'label' => 'Account Type',
                        'errors' => [
                            'required' => 'Account Type Field Cannot be Empty.',
                            'in_list' => 'Account Type Field Must Contain A Valid Account Type.'
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
                            $message = [
                                "message" => "Could Not Create User. Please Try Again."
                            ];
                            $session->setFlashdata("error", $message);
                            $session->setFlashdata('form_data', $data);
                        } else {
                            $action = "Activate Account";
                            $otp_sent = $this->generateAndSendOTP(ucwords($user_firstname), $user_email, $model, $action);
                            $message = [
                                "message" => "Account Created Successfully, and a Verification Email has been Sent."
                            ];
                            $session->setTempdata('form_data', $data, 3000000);
                            $session->setFlashdata("success", $message);
                            return redirect()->to("resend-code");

                        }
                    } else {
                        if ($isUserWithSimilarEmailExisting && $isUserWithSimilarPhoneExisting) {
                            $message = [
                                "message" => "User With Similar Phone Number and Email Address Already Exists."
                            ];
                            $session->setFlashdata("error", $message);
                            $session->setFlashdata('form_data', $data);
                        }
                        if (empty($isUserWithSimilarEmailExisting)) {
                            $message = [
                                "message" => "User With Similar Phone Number Already Exists."
                            ];
                            $session->setFlashdata("error", $message);
                            $session->setFlashdata('form_data', $data);
                        }
                        if (empty($isUserWithSimilarPhoneExisting)) {
                            $message = [
                                "message" => "User With Similar Email Address Already Exists."
                            ];
                            $session->setFlashdata("error", $message);
                            $session->setFlashdata('form_data', $data);
                        }
                    }

                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                    $session->setFlashdata('form_data', $data);
                }

            } else {
                $message = [
                    "message" => "Invalid Form Data."
                ];
                $session->setFlashdata("error", $message);
                $session->setFlashdata('form_data', $data);
            }

        }
        return redirect()->back();
    }

    public function resendCode(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = \Config\Services::validation();
            $session = \Config\Services::session();
            helper(['form']);

            if (!is_null($data)) {

                $validation->setRules([

                    'user_email' => [
                        'rules' => 'required|valid_email',
                        'label' => "User Email",
                        'errors' => [
                            'required' => "User Email Field Cannot be Empty.",
                            'valid_email' => "User Email Field must contain a valid Email.",
                        ]
                    ],
                ]);

                if ($validation->run($data)) {

                    $user_email = $data['user_email'];
                    $user_firstname = $data['user_firstname'];

                    $model = new UsersModel();

                    $isUserExisting = $model->getUserByEmail($user_email);

                    if (!empty($isUserExisting)) {
                        $other = $session->getTempdata("form_data");
                        $previous_action = $other['action'] ?? null;
                        if ($previous_action === null) {
                            $action = "Activate Account";
                            $message = [
                                "message" => "A new Verification Email has been Sent."
                            ];
                        }  else {
                            $action = "Password Recovery";
                            $message = [
                                "message" => "A new Password Recovery Email has been Sent."
                            ];
                            unset($isUserExisting['user_password']);
                            $other = [
                                "action" => 'passwordRecovery',
                            ];
                            $data = array_merge($data, $isUserExisting, $other);
                        }
                        $otp_sent = $this->generateAndSendOTP(ucwords($user_firstname), $user_email, $model, $action);
                        $session->setTempdata('form_data', $data, 3000000);
                        $session->setFlashdata("success", $message);
                    } else {
                        $message = [
                            "message" => "A User with the provided Email could not be found."
                        ];
                        $session->removeTempdata('form_data');
                        $session->setFlashdata("error", $message);
                        return redirect()->to("login");
                    }

                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                    $session->setFlashdata('form_data', $data);
                }

            } else {
                $message = [
                    "message" => "Invalid Form Data."
                ];
                $session->setFlashdata("error", $message);
                $session->setFlashdata('form_data', $data);
            }

        }
        return redirect()->back();
    }

    public function verifyAccount($otp_code): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('get')) {
            $session = \Config\Services::session();
            $model = new UsersModel();

            $otp_data = $model->getOTP($otp_code);

            if (empty($otp_data)) {
                $message = [
                    "message" => "Incorrect Verification Link."
                ];
                $session->setFlashdata("error", $message);
            } else {
                $otp_id = $otp_data['_id'];

                $updateUserData = [
                    'user_account_activated' => true
                ];

                $user_data = $model->getUserByEmail($otp_data['otp_sent_to']);

                if (empty($user_data)) {
                    $message = [
                        "message" => "User Account Not Found."
                    ];
                    $session->setFlashdata("error", $message);
                }

                $update_user = $model->updateUser($updateUserData, $user_data['_id']);
                $update_otp = $model->deleteOTP($otp_id);

                if (empty($update_user) || empty($update_otp)) {
                    $message = [
                        "message" => "Couldn't Verify Account, Please Try Again."
                    ];
                    $session->setFlashdata("error", $message);
                } else {
                    unset($user_data['user_password']);
                    $message = [
                        "message" => "Account Verified Successfully."
                    ];
                    $session->setFlashdata("success", $message);
                }
            }
        }
        return redirect()->to("login");
    }

    public function verifyPasswordRecoveryLink($otp_code): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('get')) {
            $session = \Config\Services::session();
            $model = new UsersModel();

            $otp_data = $model->getOTP($otp_code);

            if (empty($otp_data)) {
                $message = [
                    "message" => "Incorrect Verification Link."
                ];
                $session->setFlashdata("error", $message);
            } else {
                $otp_id = $otp_data['_id'];

                $user_data = $model->getUserByEmail($otp_data['otp_sent_to']);

                if (empty($user_data)) {
                    $message = [
                        "message" => "User Account Not Found."
                    ];
                    $session->setFlashdata("error", $message);
                }

                $update_otp = $model->deleteOTP($otp_id);

                if (empty($update_otp)) {
                    $message = [
                        "message" => "Couldn't Verify Account, Please Try Again."
                    ];
                    $session->setFlashdata("error", $message);
                } else {
                    unset($user_data['user_password']);
                    $message = [
                        "message" => "Account Verified Successfully."
                    ];
                    $session->removeTempdata("form_data");
                    $session->setTempdata("form_data", $user_data, 300000);
                    $session->setFlashdata("success", $message);
                    return redirect()->to("forgot-password-3");
                }
            }
        }
        return redirect()->to("forgot-password-1");
    }

    public function verifyEmail(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = \Config\Services::validation();
            $session = \Config\Services::session();
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
                        $message = [
                            "message" => "Could not Find User with the username."
                        ];
                        $session->setFlashdata("error", $message);
                    } else if ($user_data['user_deleted_flag'] === true) {
                        $message = [
                            "message" => "Account Not Found."
                        ];
                        $session->setFlashdata("error", $message);
                    } else {
                        if ($user_data['user_account_activated'] === true) {
                            $action = "Password Recovery";
                            $sendTO = $user_data['user_email'];
                            $user_firstname = ucwords($user_data['user_firstname'] ?? "");
                            $sent_OTP = $this->generateAndSendOTP($user_firstname, $sendTO, $model, $action);
                            unset($user_data['user_password']);
                            $other = [
                                "action" => 'passwordRecovery',
                            ];
                            $data = array_merge($data, $user_data, $other);
                            $session->setTempdata("form_data", $data, 3000000);
                            $message = [
                                "message" => "An email with the password recovery link has been sent to you."
                            ];
                            $session->setFlashdata("success", $message);
                            return redirect()->to("resend-code");
                        }
                    }
                    $message = [
                        "message" => "Your Account id Disabled."
                    ];
                    $session->setFlashdata("error", $message);
                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                }

            } else {

                $message = [
                    "message" => "Incorrect Form Fields."
                ];
                $session->setFlashdata("error", $message);
            }
        }
        return redirect()->back();
    }

    public function setNewPassword(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            $session = \Config\Services::session();
            //Retrieve Submitted Data
            $data = $this->request->getPost();
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
                            $message = [
                                "message" => "Could not Find User with Email or Phone Number."
                            ];
                            $session->setFlashdata("error", $message);

                        } else if ($result['user_deleted_flag'] === true) {
                            $message = [
                                "message" => "Account Not Found."
                            ];
                            $session->setFlashdata("error", $message);
                        } else if ($result['user_account_activated'] === true) {
                            $newPassword = [
                                'user_password' => password_hash($password, PASSWORD_DEFAULT),
                            ];

                            $result = $userModel->updateUser($newPassword, $user_id);

                            if (empty($result)) {
                                $message = [
                                    "message" => "Could not Update User Password, Please Try Again."
                                ];
                                $session->setFlashdata("error", $message);
                            } else {
                                $message = [
                                    "message" => "User Password Updated Successfully."
                                ];
                                $session->setFlashdata("success", $message);
                                $session->removeTempdata("form_data");
                                return redirect()->to("login");
                            }
                        } else {
                            $message = [
                                "message" => "Your Account is Disabled."
                            ];
                            $session->setFlashdata("error", $message);
                        }
                    } else {
                        $message = [
                            "message" => "New and Confirm Password Values must be the same."
                        ];
                        $session->setFlashdata("error", $message);
                    }

                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                }

            } else {
                $message = [
                    "message" => "Invalid Form Data."
                ];
                $session->setFlashdata("error", $message);
            }

            $session->setTempdata('form_data', $data, 30000);
        }

        return redirect()->back();

    }

    public function login(): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->request->is('post')) {
            $session = \Config\Services::session();
            $validation = \Config\Services::validation();
            $data = $this->request->getPost();
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

                    'user_password' => [
                        'rules' => 'required',
                        'label' => "Password",
                        'errors' => [
                            'required' => "Password Field Cannot be Empty.",
                        ]
                    ],
                ]);

                if ($validation->run($data)) {

                    $username = $data['username'];
                    $password = $data['user_password'];

                    $model = new UsersModel();

                    $result = $model->searchUser($username);

                    if (empty($result)) {
                        $message = [
                            "message" => "Could not Find user with the username."
                        ];
                    } else {
                        if ($result['user_deleted_flag'] === true) {
                            $message = [
                                "message" => "Account Not Found."
                            ];
                        } else {
                            if ($result['user_account_activated'] === true) {
                                if (password_verify($password, $result['user_password'])) {
                                    $message = [
                                        "message" => "Logged in Successfully."
                                    ];
                                    $session->setFlashdata("success", $message);
                                    $session->set('user', $result);
                                    $user_profile = json_decode($result['user_profile'], true);
                                    if (empty($user_profile)) {
                                        return redirect()->to("profile-setup");
                                    } else {
                                        return redirect()->to("dashboard");
                                    }

                                }
                                $message = [
                                    "message" => "Incorrect Password or Username."
                                ];
                            } else {
                                $message = [
                                    "message" => "Account is Disabled."
                                ];
                            }
                        }
                    }
                    $session->setFlashdata("error", $message);

                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                }

            } else {
                $message = [
                    "message" => "Invalid Username or Password."
                ];
                $session->setFlashdata("error", $message);
            }
            $session->setFlashdata('form_data', $data);
        }
        return redirect()->back();
    }

    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        $session = \Config\Services::session();
        $session->remove('user');
        session_destroy();

        return redirect('login');
    }

    /**
     * @param mixed $user_firstname
     * @param mixed $user_email
     * @param UsersModel $model
     * @param string $action
     * @return bool
     */
    private function generateAndSendOTP(string $user_firstname, string $user_email, UsersModel $model, string $action): bool
    {
        $subject = $action === "Activate Account" ? "Account Activation Code." : "Password Recovery.";
        $templatePath = $action === "Activate Account" ? '/Templates/account_activation.html' : '/Templates/password_recovery.html';

        $otp_code = CustomFunctions::generateValidationLink();
        $verification_url = base_url(($action === "Activate Account" ? "verify" : "verify-link") . "/$otp_code");
        try {
            $html_template = file_get_contents(__DIR__ . $templatePath);
        } catch (Exception $e) {
            log_message('error', 'Error reading email template: ' . $e->getMessage());
            return false;
        }

        $html_content = str_replace(['{{username}}', '{{base_url}}', '{{otp}}'], [$user_firstname, base_url(), $verification_url], $html_template);

        $job = [
            'to' => $user_email,
            'subject' => $subject,
            'message' => $html_content,
            'retries' => 0
        ];

        $redisQueue = new RedisQueueLibrary();

        try {
            $queue = "email_queues";
            $redisQueue->push($queue, $job);
        } catch (Exception $e) {
            log_message('error', 'Error pushing job to Redis: ' . $e->getMessage());

            // Fallback to MongoDB
            $mongoQueue = new MongoQueueLibrary();
            $mongoQueue->push($job);
        }

        $OTP_data = [
            'otp_code' => $otp_code,
            'otp_sent_to' => $user_email,
            'otp_sent_on' => date('Y-m-d H:i:s'),
            'otp_status' => false,
        ];

        return $model->saveSentOTP($OTP_data);
    }

}