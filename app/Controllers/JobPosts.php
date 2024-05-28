<?php

namespace App\Controllers;

use App\Models\JobsModel;
use App\Models\UsersModel;
use Config\MyFunctions as CustomFunctions;

class JobPosts extends BaseController
{
    public function index()
    {
        //Reserved
    }

    public function jobPosts(): string
    {
        $session = \Config\Services::session();

        $user = $session->get('user');
        $user_id = $user['_id'];
        $user_level = $user['user_level'];

        $model = new JobsModel();


        if ($this->request->getUri()->getPath() === '/employment-posts') {
            $job_posts = $model->getJobPostsByCategory("1", $user_level, $user_id);
        } else if ($this->request->getUri()->getPath()=== '/internship-posts') {
            $job_posts = $model->getJobPostsByCategory("2", $user_level, $user_id);
        } else {
            $job_posts = $model->getJobPosts($user_level, $user_id);
        }

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
                        'rules' => 'required|in_list[1,2]',
                        'label' => "Job Post Category",
                        'errors' => [
                            'required' => "Job Post Category Field Cannot be Empty.",
                            'in_list' => "Please Select a Valid Job Post Category.",
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
                        'job_post_category' => $job_post_category,
                        'job_post_description' => $job_post_description,
                        'job_post_from' => $job_post_from,
                        'job_post_to' => $job_post_to,
                        'job_post_attachment_file' => $job_post_attachment_file,
                        'job_post_active' => true,
                        'job_post_created_by' => $user_id,
                        'job_post_created_on' => CustomFunctions::getDate(),
                        'job_post_deleted_flag' => false,
                        'job_post_updated_by' => "",
                        'job_post_updated_on' => "",
                        'job_post_deleted_by' => "",
                        'job_post_deleted_on' => ""
                    ];

                    $model = new JobsModel();

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
