<?php

namespace App\Controllers;

use App\Models\JobPostsModel;
use MongoDB\BSON\ObjectId;
use Config\Services;

class Dashboard extends BaseController
{
    public function index()
    {
        //Reserved
    }

    public function dashboard(): string
    {
        $session = Services::session();

        $user = $session->get('user');
        $user_id = new ObjectId($user['_id']);
        $user_level = $user['user_level'];

        $employers_count = count((new Users())->getUsers("3")) ?? 0;
        $job_seekers_count = count((new Users())->getUsers("4")) ?? 0;
        $job_posts_count = count((new JobPosts())->getJobPosts($user_level, $user_id)) ?? 0;
        $job_applications_count = count((new JobApplications())->getJobApplications()) ?? 0;

        $data = [
            'employers_count' => $employers_count,
            'job_seekers_count' => $job_seekers_count,
            'job_posts_count' => $job_posts_count,
            'job_applications_count' => $job_applications_count
        ];
        return view('dashboard', $data);
    }

}
