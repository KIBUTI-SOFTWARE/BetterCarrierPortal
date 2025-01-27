<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Config\MyFunctions as CustomFunctions;

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

    public function myProfile(): string
    {
//        $session = session();
//        $user = $session->get('user');
//        $user_id = $user['_id'];
//        $model = new UsersModel();
//        $data = [
//            "user_profile" => $model->getUserByID($user_id)
//        ];
//        return view('view-profile', $data);

        return view('view-profile');
    }

    public function profileSetupAction()
    {
        if ($this->request->is('post')) {
            $session = \Config\Services::session();

            $user = $session->get('user');
            $user_id = $user['_id'];
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

                        'user_company_contact_person_role' => [
                            'rules' => 'required',
                            'label' => 'Company Contact Person Name',
                            'errors' => [
                                'required' => 'Company Contact Person Name Field Cannot be Empty.',
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
                }
                else {
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
                    ]);
                }

                if ($validation->run($data)) {

                    $user_firstname = $data['user_firstname'];
                    $user_lastname = $data['user_lastname'];
                    $user_surname = $data['user_surname'] ?? "";
                    $user_dob = date("Y-m-d", strtotime($data['user_dob']));
                    $user_experience = $data['user_experience'] ?? "";
                    $user_preferred_industries = $data['user_preferred_industries'] ?? "";
                    $user_projects = $data['user_projects'] ?? "";
                    $user_github = $data['user_github'] ?? "";
                    $user_linkedin = $data['user_linkedin'] ?? "";
                    $user_other_socials = $data['user_other_socials'] ?? "";
                    $user_company_name = $data['user_company_name'] ?? "";
                    $user_company_email = $data['user_company_email'] ?? "";
                    $user_company_phone = $data['user_company_phone'] ?? "";
                    $user_company_location = $data['user_company_location'] ?? "";
                    $user_company_employees = $data['user_company_employees'] ?? "";
                    $user_company_industry = $data['user_company_industry'] ?? "";
                    $user_company_github = $data['user_company_github'] ?? "";
                    $user_company_linkedin = $data['user_company_linkedin'] ?? "";
                    $user_company_other_socials = $data['user_company_other_socials'] ?? "";
                    $user_company_contact_person = $data['user_company_contact_person'] ?? "";
                    $user_company_contact_person_role = $data['user_company_contact_person_role'] ?? "";
                    $user_company_contact_person_email = $data['user_company_contact_person_email'] ?? "";

                    $model = new UsersModel();

                    $result = $model->searchUser($user_id);

                    if (empty($result)) {
                        $message = [
                            "message" => "Could not Find user."
                        ];
                    } else {
                        $profileData = array();

                        if ($user_level === "3") {
                            $logo_file_url = $this->saveFile('company_logo_file');
                            $profileData = [
                                'user_surname' => $user_surname,
                                'user_dob' => $user_dob,
                                'user_experience' => $user_experience,
                                'user_preferred_industries' => $user_preferred_industries,
                                'user_projects' => $user_projects,
                                'user_github' => $user_github,
                                'user_linkedin' => $user_linkedin,
                                'user_other_socials' => $user_other_socials,
                                'user_company_name' => $user_company_name,
                                'user_company_email' => $user_company_email,
                                'user_company_phone' => $user_company_phone,
                                'user_company_location' => $user_company_location,
                                'user_company_employees' => $user_company_employees,
                                'user_company_industry' => $user_company_industry,
                                'user_company_contact_person' => $user_company_contact_person,
                                'user_company_contact_person_role' => $user_company_contact_person_role,
                                'user_company_contact_person_email' => $user_company_contact_person_email,
                                'user_company_github' => $user_company_github,
                                'user_company_linkedin' => $user_company_linkedin,
                                'user_company_other_socials' => $user_company_other_socials,
                                'user_company_logo' => $logo_file_url,
                            ];
                        }
                        else if ($user_level === "4") {
                            $photo_file_url = $this->saveFile('photo_file');
                            $cv_file_url = $this->saveFile('cv_file');
                            $profileData = [
                                'user_surname' => $user_surname,
                                'user_dob' => $user_dob,
                                'user_experience' => $user_experience,
                                'user_preferred_industries' => $user_preferred_industries,
                                'user_projects' => $user_projects,
                                'user_github' => $user_github,
                                'user_linkedin' => $user_linkedin,
                                'user_other_socials' => $user_other_socials,
                                'user_photo' => $photo_file_url,
                                'user_cv' => $cv_file_url,
                            ];
                        } else {
                            $profileData = [
                                'user_surname' => $user_surname,
                                'user_dob' => $user_dob
                            ];
                        }

                        $insertionData = [
                            'user_firstname' => $user_firstname,
                            'user_lastname' => $user_lastname,
                            'user_profile' => json_encode($profileData),
                            'user_updated_by' => $user_id,
                            'user_updated_on' => CustomFunctions::getDate(),
                        ];

                        $update_profile = $model->updateUser($insertionData, $user_id);

                        if (empty($update_profile)) {
                            $message = [
                                "message" => "Could Not Update User Profile, Please Try Again."
                            ];
                        } else {
                            $user_new_profile = $model->getUserByID($user_id);
                            if (empty($user_new_profile)) {
                               exit();
                            } else {
                                $session->set('user', "");
                                $session->set('user', $user_new_profile);
                            }
                            $message = [
                                "message" => "User Profile Updated Successfully."
                            ];
                            $session->setFlashdata("success", $message);
                            return redirect()->to("dashboard");
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
                    "message" => "Invalid Form Data/Fields."
                ];
                $session->setFlashdata("error", $message);
            }
            $session->setFlashdata('form_data', $data);
        }

        return redirect()->back();
    }

    public function updatePassword(): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($this->request->is('post')) {
            $session = \Config\Services::session();

            $user = $session->get('user');
            $user_id = $user['_id'];

            $validation = \Config\Services::validation();
            $data = $this->request->getPost();

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

                    $current_password = $data['current_password'];
                    $new_password = $data['new_password'];
                    $confirm_new_password = $data['confirm_new_password'];

                    if ($new_password === $confirm_new_password) {

                        $model = new UsersModel();

                        $result = $model->getUserByID($user_id);

                        if (empty($result)) {
                            $message = [
                                "message" => "Could not Find user."
                            ];
                        } else {
                            if (password_verify($current_password, $result['user_password'])) {
                                $update_data = [
                                    'user_password' => password_hash($new_password, PASSWORD_DEFAULT)
                                ];
                                $update_password_result = $model->updateUser($update_data, $user_id);

                                if (empty($update_password_result)) {
                                    $message = [
                                        "message" => "Could Not Update User Password, Please Try Again."
                                    ];
                                } else {
                                    $message = [
                                        "message" => "User Password Updated Successfully."
                                    ];
                                    $session->setFlashdata("success", $message);
                                    return redirect()->back();
                                }
                            } else {
                                $message = [
                                    "message" => "Incorrect Current Password."
                                ];
                            }
                        }
                    } else {
                        $message = [
                            "message" => "The New Passwords Do Not Match."
                        ];
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
                    "message" => "Invalid Form Data/Fields."
                ];
                $session->setFlashdata("error", $message);
            }
            $session->setFlashdata('form_data', $data);
        }
        return redirect()->back();
    }

    private function saveFile(string $identifier): string
    {
        $file = $this->request->getFile($identifier);
        $file_url = '';
        if ($file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move('uploads/files/', "$name");

            $filename = $file->getName();
            if ($filename !== '') {
                $file_url = base_url("uploads/files/$filename");
            }
        }
        return $file_url;
    }
}
