<?php
$session = session();
$user = $session->get("user");
$user_id = $user["_id"];
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];
$job_applications = $job_applications ?? array();
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<h2 class="intro-y mt-10 text-lg font-medium">All Applications (<?= number_format(count($job_applications)) ?>)</h2>
<br>
<div class="mt-5 grid grid-cols-12 gap-6">
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table data-tw-merge="" class="w-full text-left -mt-2 border-separate border-spacing-y-[10px]">
            <thead data-tw-merge="" class="">
            <tr data-tw-merge="" class="">
                <th data-tw-merge=""
                    class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-left">
                    S/N
                </th>
                <th data-tw-merge=""
                    class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-left">
                    JOB TITLE
                </th>
                <th data-tw-merge=""
                    class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-left">
                    APPLICANT
                </th>
                <th data-tw-merge=""
                    class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-left">
                    APPLICATION SENT ON
                </th>
                <th data-tw-merge=""
                    class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-left">
                    ACTIONS
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($job_applications) && count($job_applications) > 0) {
                $sn = 0;
                foreach ($job_applications as $job_application) {
                    $job_post = (new \App\Controllers\JobPosts())->getJobPost($job_application['job_post_id']);
                    $job_posted_by = (new \App\Controllers\Users)->getUser($job_post['job_post_created_by']);
                    $job_applicant = (new \App\Controllers\Users)->getUser($job_application['job_application_created_by']);
                    if ($user_level === "3" && $user_id === $job_post["job_post_created_by"]) {
                        ?>
                        <tr data-tw-merge="" class="intro-x">
                            <td data-tw-merge=""
                                class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 text-left shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <?= ++$sn; ?>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <a class="whitespace-nowrap font-medium" href="#">
                                    <?= $job_post['job_post_title'] ?>
                                </a>
                                <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                    <?= $job_posted_by['user_firstname'] . " " . $job_posted_by['user_lastname'] ?>
                                </div>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <a class="whitespace-nowrap font-medium" href="#">
                                    <?= $job_applicant['user_firstname'] . " " . $job_applicant['user_lastname'] ?>
                                </a>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box w-40 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <div class="flex items-center justify-center text-success">
                                    <?= \Config\MyFunctions::timeAgo($job_application['job_application_created_on']) ?>
                                </div>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box w-56 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600 before:absolute before:inset-y-0 before:left-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 before:dark:bg-darkmode-400">
                                <div class="flex items-center justify-center">
                                    <a class="mr-3 flex items-center" href="#">
                                        <i data-tw-merge="" data-lucide="view"
                                           class="stroke-1.5 mr-1 h-4 w-4"></i>
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr data-tw-merge="" class="intro-x">
                            <td data-tw-merge=""
                                class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 text-left shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <?= ++$sn; ?>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <a class="whitespace-nowrap font-medium" href="#">
                                    <?= $job_post['job_post_title'] ?>
                                </a>
                                <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                    <?= $job_posted_by['user_firstname'] . " " . $job_posted_by['user_lastname'] ?>
                                </div>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <a class="whitespace-nowrap font-medium" href="#">
                                    <?= $job_applicant['user_firstname'] . " " . $job_applicant['user_lastname'] ?>
                                </a>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box w-40 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                <div class="flex items-center justify-center text-success">
                                    <?= \Config\MyFunctions::timeAgo($job_application['job_application_created_on']) ?>
                                </div>
                            </td>
                            <td data-tw-merge=""
                                class="text-left px-5 py-3 border-b dark:border-darkmode-300 box w-56 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600 before:absolute before:inset-y-0 before:left-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 before:dark:bg-darkmode-400">
                                <div class="flex items-center justify-center">
                                    <a class="mr-3 flex items-center" href="#">
                                        <i data-tw-merge="" data-lucide="view"
                                           class="stroke-1.5 mr-1 h-4 w-4"></i>
                                        View
                                    </a>
                                    <a class="flex items-center text-danger" data-tw-toggle="modal"
                                       data-tw-target="#delete-confirmation-modal" href="#">
                                        <i data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-1 h-4 w-4"></i>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
</div>
<?php include "Modals/job-posts.php"; ?>
<!-- END: Content -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.body.addEventListener('click', function (event) {
            if (event.target.closest('.share-link')) {
                event.preventDefault(); // Prevent the default anchor behavior

                const shareLink = event.target.closest('.share-link');
                const postLink = shareLink.getAttribute('data-post-link'); // Get the link from data-post-link attribute

                // Copy the link to the clipboard
                navigator.clipboard.writeText(postLink).then(function () {
                    Swal.fire({
                        position: "top-end",
                        timer: 10000,
                        text: "Link to the Post Copied to Clipboard.",
                        icon: "info"
                    });
                }).catch(function (err) {
                    Swal.fire({
                        position: "top-end",
                        timer: 10000,
                        text: "'Failed to copy the link: '" + err,
                        icon: "error"
                    });
                    console.error('Failed to copy the link: ', err);
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const applyButtons = document.querySelectorAll('.apply-now');

        applyButtons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const postID = button.getAttribute('data-post-id');
                const modalInput = document.querySelector('#apply-now .postID');

                if (modalInput) {
                    modalInput.value = postID;
                }

                // Show the modal
                const applyModal = new bootstrap.Modal(document.getElementById('apply-now'));
                applyModal.show();
            });
        });
    });

</script>
<?= $this->endSection('content') ?>

