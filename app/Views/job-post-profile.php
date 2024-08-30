<?php

use App\Controllers\Users;
use Config\MyFunctions;

$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_id = $user["_id"];
$user_level = $user["user_level"];


$job_post_data = $job_post_data ?? array();
$job_post_created_by = (new Users)->getUser($job_post_data["job_post_created_by"] ?? "") ?? array();
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<div class="mt-8 flex items-center">
    <h2 class="intro-y mr-auto text-lg font-medium">Job Post Profile</h2>
</div>
<div>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box mt-5 px-5 pt-5">
        <ul data-tw-merge="" role="tablist"
            class="w-full flex flex-col justify-center text-center sm:flex-row">

            <li id="package-details-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none">
                <button data-tw-merge="" data-tw-target="#package-details" role="tab"
                    class="cursor-pointer appearance-none px-5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white border-b-2 dark:border-transparent [&.active]:border-b-primary [&.active]:font-medium [&.active]:dark:border-b-primary active flex items-center py-4">
                    <i data-tw-merge="" data-lucide="user-circle" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Job Post Details
                </button>
            </li>
            <li id="update-details-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none">
                <button data-tw-merge="" data-tw-target="#update-details" role="tab"
                    class="cursor-pointer appearance-none px-5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white border-b-2 dark:border-transparent [&.active]:border-b-primary [&.active]:font-medium [&.active]:dark:border-b-primary flex items-center py-4">
                    <i data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Update Job Post Details
                </button>
            </li>
        </ul>
    </div>
    <!-- END: Profile Info -->
    <!-- BEGIN: Personal Information -->
    <div class="tab-content mt-5">
        <div data-transition="" data-selector=".active"
            data-enter="transition-[visibility,opacity] ease-linear duration-150"
            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0"
            data-enter-to="visible opacity-100"
            data-leave="transition-[visibility,opacity] ease-linear duration-150"
            data-leave-from="visible opacity-100"
            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0"
            id="category-details" role="tabpanel" aria-labelledby="category-details-tab"
            class="tab-pane active leading-relaxed">
            <div class="intro-y col-span-12 lg:col-span-8 xl:col-span-9">
                <div class="intro-y box lg:mt-5">
                    <div data-tw-merge="" class="accordion p-5">
                        <div data-tw-merge=""
                            class="accordion-item [&:not(:last-child)]:border-b [&:not(:last-child)]:border-slate-200/60 [&:not(:last-child)]:dark:border-darkmode-400 p-4 first:mt-0 last:mb-0 border border-slate-200/60 mt-3 dark:border-darkmode-400">
                            <div class="accordion-header" id="faq-accordion-1">
                                <button data-tw-merge="" data-tw-toggle="collapse"
                                    data-tw-target="#faq-accordion-1-collapse" type="button"
                                    aria-expanded="true"
                                    aria-controls="faq-accordion-1-collapse"
                                    class="accordion-button outline-none py-4 -my-4 font-medium w-full text-left dark:text-slate-400 [&:not(.collapsed)]:text-primary [&:not(.collapsed)]:dark:text-slate-300">
                                    Job Post Details
                                </button>
                            </div>
                            <div id="faq-accordion-1-collapse" aria-labelledby="faq-accordion-1"
                                class="accordion-collapse collapse mt-3 text-slate-700 leading-relaxed dark:text-slate-400 [&.collapse:not(.show)]:hidden [&.collapse.show]:visible show">
                                <div data-tw-merge=""
                                    class="accordion-body leading-relaxed text-slate-600 dark:text-slate-500">
                                    <h1>
                                        <span class="font-bold">Job Post Title: </span><?= ucwords($job_post_data['job_post_title'] ?? "") ?>
                                    </h1>
                                    <br>
                                    <p>
                                        <span class="font-bold">Job Post Description;</span> <br>
                                        <?= ucwords($job_post_data['job_post_description'] ?? "") ?>
                                    </p>
                                    <br>
                                    <p>
                                        <span class="font-bold">Job Post Created By;</span> <br>
                                        <?= $job_post_created_by['user_firstname'] ?? "" ?> <?= $job_post_created_by['user_lastname'] ?? "" ?>
                                    </p>
                                </div>
                                <div class="px-5 py-3 text-right">
                                    <?php
                                    if ($user_level < "3") {
                                    ?>
                                        <?php
                                        if ($job_post_data['job_post_approved'] === false) {
                                        ?>
                                            <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#approve-job-post" data-post-id="<?= $job_post_data['_id'] ?>"
                                                class="approve-job-post transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                                                Approve Post
                                            </button>
                                        <?php
                                        }
                                        ?>
                                        <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#delete-job-post" data-post-id="<?= $job_post_data['_id'] ?>"
                                            class="delete-job-post transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                                            Delete Post
                                        </button>
                                    <?php
                                    } elseif ($job_post_data["job_post_created_by"] === $job_post_created_by['_id']) {
                                    ?>
                                        <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#delete-job-post"
                                            class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                                            Delete Post
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-transition="" data-selector=".active"
            data-enter="transition-[visibility,opacity] ease-linear duration-150"
            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0"
            data-enter-to="visible opacity-100"
            data-leave="transition-[visibility,opacity] ease-linear duration-150"
            data-leave-from="visible opacity-100"
            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0"
            id="update-details" role="tabpanel" aria-labelledby="update-details-tab"
            class="tab-pane leading-relaxed">
            <?php
            if ($user_level < "3" || $job_post_data["job_post_created_by"] === $job_post_created_by['_id']) {
            ?>
                <div class="intro-y box mt-5">
                    <div class="flex items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400">
                        <h2 class="mr-auto text-base font-medium">
                            Updating Job Post Details
                        </h2>
                    </div>
                    <form name="update-job-post" action="/update-job-post" method="post"
                        enctype="multipart/form-data">
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">
                                    <div>
                                        <input data-tw-merge="" id="job_post_id" type="hidden"
                                            name="job_post_id"
                                            value="<?= $job_post_data['_id'] ?>"
                                            placeholder="Job Post ID" />
                                    </div>
                                    <div>
                                        <label data-tw-merge="" for="category_name"
                                            class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                            Job Post Title
                                        </label>
                                        <input data-tw-merge="" id="job_post_title"
                                            type="text" name="job_post_title"
                                            placeholder="Category Name"
                                            required value="<?= $job_post_data['job_post_title'] ?? "" ?>"
                                            class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                    </div>
                                    <div class="mt-3">
                                        <label data-tw-merge="" for="category_description"
                                            class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                            Job Post Description
                                        </label>
                                        <textarea id="job_post_description"
                                            name="job_post_description"
                                            data-value="<?= $category_data['category_description'] ?? "" ?>"
                                            class="editor form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                            required placeholder="Category Description."
                                            style="height: 100px"><?= $job_post_data['job_post_description'] ?? "" ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-3 text-right">
                                <button data-tw-merge="" type="reset"
                                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&:hover:not(:disabled)]:bg-secondary/20 [&:hover:not(:disabled)]:dark:bg-darkmode-100/10 mr-1 w-20">
                                    Reset
                                </button>
                                <button data-tw-merge="" type="submit"
                                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary w-20">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
    <!-- END: Personal Information -->
</div>
<!-- END: Content -->
<?php include "Modals/job-posts.php"; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const approvePost = document.querySelectorAll('.approve-job-post');

        approvePost.forEach(function(button) {
            button.addEventListener('click', function(e) {
                const postID = button.getAttribute('data-post-id');
                const postIDInput = document.querySelector('#approve-job-post .postID');
                console.log(postID);
                if (postIDInput) {
                    postIDInput.value = postID;
                }

                // Show the modal
                const approvePost = new bootstrap.Modal(document.getElementById('approve-job-post'));
                approvePost.show();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const deletePost = document.querySelectorAll('.delete-job-post');

        deletePost.forEach(function(button) {
            button.addEventListener('click', function(e) {
                const postID = button.getAttribute('data-post-id');
                const postIDInput = document.querySelector('#delete-job-post .postID');
                console.log(postID);
                if (postIDInput) {
                    postIDInput.value = postID;
                }

                // Show the modal
                const deletePost = new bootstrap.Modal(document.getElementById('delete-job-post'));
                deletePost.show();
            });
        });
    });
</script>

<?= $this->endSection('content') ?>
