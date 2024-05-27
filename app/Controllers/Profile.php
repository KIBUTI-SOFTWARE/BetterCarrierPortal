<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Profile extends BaseController
{
    public function index()
    {
        //Reserved
    }

    public function profileSetup(): string
    {
        return view('setup-profile');
    }

    public function profileSetupAction()
    {
        if ($this->request->is('post')) {
            $session = \Config\Services::session();

            $user = $session->get('user');
            $user_level = $user['_id'];
            $user_level = $user['user_level'];
            $user_profile = json_decode($user['user_level'], true);

            $validation = \Config\Services::validation();
            $data = $this->request->getPost();
            helper(['form']);

            if (!is_null($data)) {

                if ($user_level === "3") {
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

                        'user_dob' => [
                            'rules' => 'required',
                            'label' => 'Date of Birth',
                            'errors' => [
                                'required' => 'Date of Birth Field Cannot be Empty.'
                            ]
                        ],

                        'user_experience' => [
                            'rules' => 'required',
                            'label' => 'Date of Birth',
                            'errors' => [
                                'required' => 'Date of Birth Field Cannot be Empty.'
                            ]
                        ],

                        'user_preferred_industries' => [
                            'rules' => 'required',
                            'label' => 'User Preferred',
                            'errors' => [
                                'required' => 'User Preferred Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_name' => [
                            'rules' => 'required',
                            'label' => 'Company Name',
                            'errors' => [
                                'required' => 'Company Name Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_email' => [
                            'rules' => 'required|valid_email',
                            'label' => 'Company Email',
                            'errors' => [
                                'required' => 'Company Email Profile Field Cannot be Empty.',
                                'valid_email' => "Company Email Field must contain a valid Email.",
                            ]
                        ],

                        'user_company_phone' => [
                            'rules' => 'required|exact_length[10]',
                            'label' => 'Phone',
                            'errors' => [
                                'required' => 'Company Phone Field Cannot be Empty.',
                                'exact_length' => 'Please Enter a valid Company Phone Number.'
                            ]
                        ],

                        'user_company_location' => [
                            'rules' => 'required',
                            'label' => 'Company Location',
                            'errors' => [
                                'required' => 'Company Location Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_employees' => [
                            'rules' => 'required',
                            'label' => 'Company Employees',
                            'errors' => [
                                'required' => 'Company Employees Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_industry' => [
                            'rules' => 'required',
                            'label' => 'Company Employees',
                            'errors' => [
                                'required' => 'Company Employees Field Cannot be Empty.',
                            ]
                        ],

                        'photo_file' => [
                            'rules' => 'uploaded[photo_file]',
                            'label' => 'User Photo',
                            'errors' => [
                                'required' => 'User Photo Field Cannot be Empty.',
                            ]
                        ],

                        'cv_file' => [
                            'rules' => 'uploaded[cv_file]',
                            'label' => 'User CV',
                            'errors' => [
                                'required' => 'User CV Field Cannot be Empty.',
                            ]
                        ],
                    ]);
                } else if ($user_level === "4") {
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

                        'user_dob' => [
                            'rules' => 'required',
                            'label' => 'Date of Birth',
                            'errors' => [
                                'required' => 'Date of Birth Field Cannot be Empty.'
                            ]
                        ],

                        'user_experience' => [
                            'rules' => 'required',
                            'label' => 'Date of Birth',
                            'errors' => [
                                'required' => 'Date of Birth Field Cannot be Empty.'
                            ]
                        ],

                        'user_preferred_industries' => [
                            'rules' => 'required',
                            'label' => 'User Preferred',
                            'errors' => [
                                'required' => 'User Preferred Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_name' => [
                            'rules' => 'required',
                            'label' => 'Company Name',
                            'errors' => [
                                'required' => 'Company Name Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_email' => [
                            'rules' => 'required|valid_email',
                            'label' => 'Company Email',
                            'errors' => [
                                'required' => 'Company Email Profile Field Cannot be Empty.',
                                'valid_email' => "Company Email Field must contain a valid Email.",
                            ]
                        ],

                        'user_company_phone' => [
                            'rules' => 'required|exact_length[10]',
                            'label' => 'Phone',
                            'errors' => [
                                'required' => 'Company Phone Field Cannot be Empty.',
                                'exact_length' => 'Please Enter a valid Company Phone Number.'
                            ]
                        ],

                        'user_company_location' => [
                            'rules' => 'required',
                            'label' => 'Company Location',
                            'errors' => [
                                'required' => 'Company Location Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_employees' => [
                            'rules' => 'required',
                            'label' => 'Company Employees',
                            'errors' => [
                                'required' => 'Company Employees Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_industry' => [
                            'rules' => 'required',
                            'label' => 'Company Employees',
                            'errors' => [
                                'required' => 'Company Employees Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_contact_person' => [
                            'rules' => 'required',
                            'label' => 'Company Contact Person Name',
                            'errors' => [
                                'required' => 'Company Contact Person Name Field Cannot be Empty.',
                            ]
                        ],

                        'user_company_contact_person_email' => [
                            'rules' => 'required|valid_email',
                            'label' => 'Company Contact Person Email',
                            'errors' => [
                                'required' => 'Company Contact Person Email Profile Field Cannot be Empty.',
                                'valid_email' => "Company Contact Person Email Field must contain a valid Email.",
                            ]
                        ],

                        'company_logo_file' => [
                            'rules' => 'uploaded[company_logo_file]',
                            'label' => 'Company Photo',
                            'errors' => [
                                'required' => 'Company Photo Field Cannot be Empty.',
                            ]
                        ],
                    ]);
                }

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
}
