<?php

namespace App\Controllers;

use App\Models\JobPostsModel;
use App\Models\UsersModel;
use Config\MyFunctions as CustomFunctions;
use MongoDB\BSON\ObjectId;
use Config\Services;
use CodeIgniter\HTTP\RedirectResponse;

class JobPosts extends BaseController
{
    public function index()
    {
        //Reserved
    }

    public function getJobPost($post_id): ?array
    {
        $model = new JobPostsModel();

        return $model->getJobPostByID($post_id);
    }

    public function getJobPosts($user_level, $user_id): ?array
    {
        $model = new JobPostsModel();

        return $model->getJobPosts($user_level, $user_id);
    }

    public function getAJAXJobPost(): \CodeIgniter\HTTP\ResponseInterface
    {
        $post_id = $this->request->getJsonVar('post_id');
        $model = new JobPostsModel();

        $post_data = $model->getJobPostByID($post_id);
        return $this->response->setJSON($post_data);
    }

    public function jobPosts(): string
    {
        $session = \Config\Services::session();

        $user = $session->get('user');
        $user_id = $user['_id'];
        $user_level = $user['user_level'];

        $model = new JobPostsModel();


        // if ($this->request->getUri()->getPath() === '/employment-posts') {
        //     $job_posts = $model->getJobPostsByCategory("1", $user_level, $user_id);
        // } else if ($this->request->getUri()->getPath()=== '/internship-posts') {
        //     $job_posts = $model->getJobPostsByCategory("2", $user_level, $user_id);
        // } else {
        //     $job_posts = $model->getJobPosts($user_level, $user_id);
        // }
        $job_posts = $model->getJobPosts($user_level, $user_id);

        $data = [
            'job_posts' => $job_posts
        ];
        return view('job-posts', $data);
    }

    public function newJobPost(): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->request->is('post')) {
            $session = \Config\Services::session();

            $user = $session->get('user');
            $user_id = $user['_id'];
            $user_level = $user['user_level'];

            $validation = \Config\Services::validation();
            $data = $this->request->getPost();
            helper(['form']);

            if (!is_null($data) && $user_level < "4") {

                $validation->setRules([
                    'job_post_title' => [
                        'rules' => 'required',
                        'label' => "Job Post Title",
                        'errors' => [
                            'required' => "Job Post Title Field Cannot be Empty.",
                        ]
                    ],

                    'job_post_category' => [
                        'rules' => 'required',
                        'label' => "Job Post Category",
                        'errors' => [
                            'required' => "Job Post Category Field Cannot be Empty.",
                        ]
                    ],

                    'job_post_description' => [
                        'rules' => 'required',
                        'label' => 'Job Post Description',
                        'errors' => [
                            'required' => 'Job Post Description Field Cannot be Empty.',
                        ]
                    ],

                    'job_post_from' => [
                        'rules' => 'required',
                        'label' => 'Job Post From',
                        'errors' => [
                            'required' => 'Job Post From Field Cannot be Empty.'
                        ]
                    ],

                    'job_post_to' => [
                        'rules' => 'required',
                        'label' => 'Job Post To',
                        'errors' => [
                            'required' => 'Job Post To Field Cannot be Empty.'
                        ]
                    ],

                    'job_post_attachment_file' => [
                        'rules' => 'uploaded[job_post_attachment_file]',
                        'label' => 'Job Post Attachment',
                        'errors' => [
                            'required' => 'Job Post Attachment Field Cannot be Empty.',
                        ]
                    ],
                ]);

                if ($validation->run($data)) {

                    $job_post_title = $data['job_post_title'];
                    $job_post_category = $data['job_post_category'];
                    $job_post_description = $data['job_post_description'];
                    $job_post_from = date("Y-m-d", strtotime($data['job_post_from']));
                    $job_post_to = date("Y-m-d", strtotime($data['job_post_to']));;
                    $job_post_attachment_file = $this->saveFile();

                    $insertionData = [
                        'job_post_title' => $job_post_title,
                        'job_post_category' => new ObjectId($job_post_category),
                        'job_post_description' => $job_post_description,
                        'job_post_from' => $job_post_from,
                        'job_post_to' => $job_post_to,
                        'job_post_attachment_file' => $job_post_attachment_file,
                        'job_post_active' => false,
                        'job_post_approved' => false,
                        'job_post_created_by' => new ObjectId($user_id),
                        'job_post_created_on' => CustomFunctions::getDate(),
                        'job_post_deleted_flag' => false,
                        'job_post_updated_by' => "",
                        'job_post_updated_on' => "",
                        'job_post_deleted_by' => "",
                        'job_post_deleted_on' => ""
                    ];

                    $model = new JobPostsModel();

                    $result = $model->addJobPost($insertionData);

                    if (empty($result)) {
                        $message = [
                            "message" => "Could not Create Job Post, Please Try Again."
                        ];
                        $session->setFlashdata("error", $message);
                    } else {
                        $message = [
                            "message" => "Job Post Created Successfully."
                        ];
                        $session->setFlashdata("success", $message);
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
                    "message" => "Invalid Form Data/Fields or Unauthorized Access."
                ];
                $session->setFlashdata("error", $message);
            }
            $session->setFlashdata('form_data', $data);
        }

        return redirect()->back();
    }

    public function viewJobPost($job_post_id): RedirectResponse
    {
        $session = Services::session();

        $user = $session->get('user');
        $user_id = new ObjectId($user['_id']);

        $model = new JobPostsModel();

        $job_post_data = $model->getJobPostByID(new ObjectId($job_post_id));

        if (empty($job_post_data)) {
            $message = [
                "message" => "Couldn't Retrieve Post Info, Please Try Again."
            ];
            $session->setFlashdata("error", $message);
            return redirect()->back();
        }

        $message = [
            "message" => $session->getFlashdata("success")['message'] ?? "Post Data Retrieved Successfully."
        ];
        $session->setFlashdata("success", $message);
        $session->setTempdata('job_post_data', $job_post_data, 3600);

        return redirect()->to("job-post-profile");
    }

    public function jobPostProfile(): string|RedirectResponse
    {
        $session = Services::session();
        $job_post_data = $session->getTempdata('job_post_data') ?? array();

        if (empty($job_post_data)) {
            $message = [
                "message" => "Couldn't Retrieve Post Info, Please Try Again."
            ];
            $session->setFlashdata("error", $message);
            return redirect()->to("view-job-posts");
        }

        $data = [
            'job_post_data' => $job_post_data
        ];

        $message = [
            "message" => $session->getFlashdata("success")['message'] ?? "Post Data Retrieved Successfully."
        ];
        $session->setFlashdata("success", $message);
//        $session->removeTempdata('patient_data');
        return view('job-post-profile', $data);
    }

    public function updateJobPost(): RedirectResponse
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = Services::validation();
            $session = Services::session();
            helper(['form']);

            if (!is_null($data)) {
                $validation->setRules([
                    'job_post_id' => [
                        'rules' => 'required',
                        'label' => 'Post ID',
                        'errors' => [
                            'required' => 'Post ID Field Cannot be Empty.'
                        ]
                    ],
                    'job_post_title' => [
                        'rules' => 'required',
                        'label' => 'Category Name',
                        'errors' => [
                            'required' => 'Post Title Field Cannot be Empty.'
                        ]
                    ]
                ]);

                if ($validation->run($data)) {
                    $user_data = $session->get('user');

                    $job_post_id = new ObjectId($data['job_post_id']);
                    $job_post_title = $data['job_post_title'];
                    $job_post_description = $data['job_post_description'] ?? "";
                    $job_post_updated_by = new ObjectId($user_data['_id']);

                    $model = new JobPostsModel();

                    $updateData = [
                        'job_post_title' => $job_post_title,
                        'job_post_description' => $job_post_description,
                        'job_post_updated_by' => $job_post_updated_by,
                        'job_post_updated_on' => CustomFunctions::getDate(),
                    ];

                    $result = $model->updateJobPost($updateData, $category_id);

                    if (empty($result)) {
                        $message = [
                            "message" => "Couldn't Update Job Post, Please Try Again."
                        ];
                        $session->setFlashdata("error", $message);
                        $session->setFlashdata('form_data', $data);

                    } else {
                        $message = [
                            "message" => "Job Post Updated Successfully."
                        ];
                        $session->setFlashdata("success", $message);
                        return redirect()->to("/view-job-post/$job_post_id");
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

    public function approveJobPost(): RedirectResponse
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = Services::validation();
            $session = Services::session();
            helper(['form']);

            if (!is_null($data)) {
                $validation->setRules([
                    'job_post_id' => [
                        'rules' => 'required',
                        'label' => 'Post ID',
                        'errors' => [
                            'required' => 'Post ID Field Cannot be Empty.'
                        ]
                    ]
                ]);

                if ($validation->run($data)) {
                    $user_data = $session->get('user');

                    $post_id = new ObjectId($data['job_post_id']);
                    $post_updated_by = new ObjectId($user_data['_id']);

                    $model = new JobPostsModel();

                    $updateData = [
                        'job_post_approved' => true,
                        'job_post_updated_by' => $post_updated_by,
                        'job_post_updated_on' => CustomFunctions::getDate(),
                    ];

                    $result = $model->updateJobPost($updateData, $post_id);

                    if (empty($result)) {
                        $message = [
                            "message" => "Couldn't Approve Job Post, Please Try Again."
                        ];
                        $session->setFlashdata("error", $message);
                        $session->setFlashdata('form_data', $data);

                    } else {
                        $message = [
                            "message" => "Job Post Approved Successfully."
                        ];
                        $session->setFlashdata("success", $message);
                        return redirect()->to("/view-job-post/$post_id");
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

    public function deleteJobPost(): RedirectResponse
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = Services::validation();
            $session = Services::session();
            helper(['form']);

            if (!is_null($data)) {
                $validation->setRules([
                    'job_post_id' => [
                        'rules' => 'required',
                        'label' => 'Job Post ID',
                        'errors' => [
                            'required' => 'Job Post ID Field Cannot be Empty.'
                        ]
                    ]
                ]);

                if ($validation->run($data)) {
                    $user_data = $session->get('user');

                    $job_post_id = new ObjectId($data['job_post_id']);
                    $job_post_deleted_by = new ObjectId($user_data['_id']);

                    $model = new JobPostsModel();

                    $updateData = [
                        'job_post_deleted_flag' => true,
                        'job_post_deleted_by' => $job_post_deleted_by,
                        'job_post_deleted_on' => CustomFunctions::getDate(),
                    ];

                    $result = $model->updateJobPost($updateData, $job_post_id);

                    if (empty($result)) {
                        $message = [
                            "message" => "Couldn't Delete Job Post, Please Try Again."
                        ];
                        $session->setFlashdata("error", $message);
                        $session->setFlashdata('form_data', $data);

                    } else {
                        $message = [
                            "message" => "Job Post Deleted Successfully."
                        ];
                        $session->setFlashdata("success", $message);
                        return redirect()->to("view-job-posts");
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

    private function saveFile(): string
    {
        $file = $this->request->getFile('job_post_attachment_file');
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
