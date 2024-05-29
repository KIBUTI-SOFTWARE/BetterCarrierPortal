<?php
$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];
$job_posts = $job_posts ?? array();
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<h2 class="intro-y mt-10 text-lg font-medium">Job Posts (<?= number_format(count($job_posts)) ?>)</h2>
<br>
<div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
    <?php
    if ($user_level < "4") {
        ?>
        <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#new-job-post"
                class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
            Add New Post
        </button>
        <?php
    }
    ?>
    <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-auto sm:ml-0">
        <button data-tw-merge="" data-tw-toggle="dropdown" aria-expanded="false"
                class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed !box px-2"><span
                    class="flex h-5 w-5 items-center justify-center">
                                    <i data-tw-merge="" data-lucide="filter" class="stroke-1.5 h-4 w-4"></i>
                                </span></button>
        <div data-transition="" data-selector=".show"
             data-enter="transition-all ease-linear duration-150"
             data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1"
             data-enter-to="!mt-1 visible opacity-100 translate-y-0"
             data-leave="transition-all ease-linear duration-150"
             data-leave-from="!mt-1 visible opacity-100 translate-y-0"
             data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1"
             class="dropdown-menu absolute z-[9999] hidden">
            <div data-tw-merge=""
                 class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 w-40">
                <a href="/internship-posts"
                   class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                            data-tw-merge="" data-lucide="activity" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Internship</a>
                <a href="/employment-posts"
                   class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                            data-tw-merge="" data-lucide="activity" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Employment</a>
            </div>
        </div>
    </div>
    <div class="mx-auto hidden text-slate-500 md:block" id="entries-info">
        <!-- Entries info will be updated by JavaScript '-->
    </div>
    <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
        <div class="relative w-56 text-slate-500">
            <label>
                <input data-tw-merge="" type="text" placeholder="Search..."
                       id="search-input"
                       class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box w-56 pr-10">
            </label>
            <i data-tw-merge="" data-lucide="search"
               class="stroke-1.5 absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4"></i>
        </div>
    </div>
</div>
<div class="intro-y mt-5 grid grid-cols-12 gap-6" id="posts-container">
    <!-- BEGIN: Blog Layout -->
    <?php
    if (isset($job_posts) && count($job_posts) > 0) {
        foreach ($job_posts as $job_post) {
            $post_id = $job_post['_id'];
            $job_posted_by = (new \App\Controllers\Users)->getUser($job_post['job_post_created_by']);
            ?>
            <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
                <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
                    <div class="image-fit h-10 w-10 flex-none">
                        <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                             alt="Post">
                    </div>
                    <div class="ml-3 mr-auto">
                        <a class="font-medium" href="#">
                            <?= $job_posted_by['user_firstname'] . " " . $job_posted_by['user_lastname'] ?>
                        </a>
                        <div class="mt-0.5 flex truncate text-xs text-slate-500">
                            <a class="inline-block truncate text-primary" href="#">
                                <?= $job_post['job_post_category'] === "1" ? "Employment" : "Internship"; ?>
                            </a>
                            <span class="mx-1">•</span> <?= \Config\MyFunctions::timeAgo($job_post['job_post_created_on']); ?>
                        </div>
                    </div>
                    <?php
                    if ($user_level < "3" || $user['_id'] === $job_post['job_post_created_by']) {
                        ?>
                        <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                            <button data-tw-toggle="dropdown" aria-expanded="false"
                                    class="cursor-pointer h-5 w-5 text-slate-500" tag="a">
                                <i data-tw-merge=""
                                   data-lucide="more-vertical"
                                   class="stroke-1.5 w-5 h-5"></i>
                            </button>
                            <div data-transition="" data-selector=".show"
                                 data-enter="transition-all ease-linear duration-150"
                                 data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1"
                                 data-enter-to="!mt-1 visible opacity-100 translate-y-0"
                                 data-leave="transition-all ease-linear duration-150"
                                 data-leave-from="!mt-1 visible opacity-100 translate-y-0"
                                 data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1"
                                 class="dropdown-menu absolute z-[9999] hidden">
                                <div data-tw-merge=""
                                     class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 w-40">
                                    <a href="/edit-job-post/<?= $job_post['_id'] ?>"
                                       class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                                data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                                        Edit Post</a>
                                    <a href="/delete-job-post/<?= $job_post['_id'] ?>"
                                       class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                                data-tw-merge="" data-lucide="trash"
                                                class="stroke-1.5 mr-2 h-4 w-4"></i>
                                        Delete Post</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="p-5">
                    <div class="image-fit h-40 2xl:h-56">
                        <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                             alt="Post">
                    </div>
                    <a class="mt-5 block text-base font-medium" href="#">
                        <?= ucwords($job_post['job_post_title']) ?>
                    </a>
                    <div class="mt-2 text-slate-600 dark:text-slate-500">
                        <?= ucfirst($job_post['job_post_title']) ?>
                    </div>
                </div>
                <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
                    Applications: <span class="font-medium">75k</span>
                    <a data-placement="top" title="Share" href="#"
                       data-post-link="<?= base_url("view-job-post/$post_id") ?>"
                       class="share-link tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                                data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
                    <?php
                    if ($user_level === "4") {
                        ?>
                        <a data-placement="top" title="Apply Now" href="#" data-tw-toggle="modal"
                           data-tw-target="#apply-now"
                           data-post-id="<?= $post_id ?>"
                           class="apply-now tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                                    data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <!-- END: Blog Layout -->
</div>
<br>
<!-- BEGIN: Pagination -->
<div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
    <nav class="w-full sm:mr-auto sm:w-auto">
        <ul id="pagination-controls" class="flex w-full mr-0 sm:mr-auto sm:w-auto">
            <!-- Pagination controls will be updated by JavaScript -->
        </ul>
    </nav>
    <label for="items-per-page"></label>
    <select id="items-per-page" data-tw-merge=""
            class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 w-20 sm:mt-0">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div>
<!-- END: Pagination -->
<?php include "Modals/job-posts.php"; ?>
<!-- END: Content -->
<script>
    const job_posts = <?= json_encode($job_posts) ?>;
    let currentPage = 1;
    let itemsPerPage = 10;

    document.getElementById('items-per-page').addEventListener('change', (event) => {
        itemsPerPage = parseInt(event.target.value);
        currentPage = 1; // Reset to first page
        renderPagination();
        renderResults();
    });

    document.getElementById('search-input').addEventListener('input', () => {
        currentPage = 1; // Reset to first page on search
        renderPagination();
        renderResults();
    });

    function renderResults() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const filteredPosts = job_posts.filter(post => {
            const job_posted_by = <?php (new \App\Controllers\Users)->getUser(?>${post.job_post_created_by}<?php)?>;
            return post.user_firstname.toLowerCase().includes(searchQuery) ||
                post.user_lastname.toLowerCase().includes(searchQuery) ||
                profile.user_photo.toLowerCase().includes(searchQuery);
        });

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedUsers = filteredUsers.slice(startIndex, endIndex);

        const usersContainer = document.getElementById('users-container');
        usersContainer.innerHTML = '';

        paginatedUsers.forEach(user => {
            const profile = JSON.parse(user.user_profile);
            const user_level = getUserLevel(user.user_level);
            usersContainer.innerHTML += `
                <div class="intro-y col-span-12 md:col-span-6">
                    <div class="box">
                        <div class="flex flex-col items-center p-5 lg:flex-row">
                            <div class="image-fit h-24 w-24 lg:mr-1 lg:h-12 lg:w-12">
                                <img class="rounded-full" src="${profile.user_photo ?? ''}" alt="User"
                                     onerror="this.onerror=null; this.src='dist/images/fakers/profile-9.jpg';">
                            </div>
                            <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">
                                <a class="font-medium" href="#">
                                    ${user.user_firstname} ${user.user_lastname}
                                </a>
                                <div class="mt-0.5 text-xs text-slate-500">
                                    ${user_level}
                                </div>
                            </div>
                            <div class="mt-4 flex lg:mt-0">
                                <button data-tw-merge=""
                                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 px-2 py-1">
                                    Message
                                </button>
                                <button data-tw-merge=""
                                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&:hover:not(:disabled)]:bg-secondary/20 [&:hover:not(:disabled)]:dark:bg-darkmode-100/10 px-2 py-1">
                                    Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        document.getElementById('entries-info').innerText = `Showing ${startIndex + 1} to ${Math.min(endIndex, filteredUsers.length)} of ${filteredUsers.length} entries`;
    }

    function getUserLevel(user_level) {
        const userLevels = new Map([
            ["1", "Super Admin"],
            ["2", "System Admin"],
            ["3", "Talent Seeker/Employer"],
            ["4", "Job Seeker/Talent"],
        ]);

        return userLevels.get(user_level) || "Undefined Level";
    }


    function renderPagination() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const filteredUsers = job_posts.filter(user => {
            const profile = JSON.parse(user.user_profile);
            return user.user_firstname.toLowerCase().includes(searchQuery) ||
                user.user_lastname.toLowerCase().includes(searchQuery) ||
                profile.user_photo.toLowerCase().includes(searchQuery);
        });

        const totalPages = Math.ceil(filteredUsers.length / itemsPerPage);
        const paginationControls = document.getElementById('pagination-controls');
        paginationControls.innerHTML = '';

        if (currentPage > 1) {
            paginationControls.innerHTML += `
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3" onclick="goToPage(${currentPage - 1})">
                        <i data-tw-merge="" data-lucide="chevron-left" class="stroke-1.5 h-4 w-4"></i>
                    </a>
                </li>
            `;
        }

        for (let i = 1; i <= totalPages; i++) {
            paginationControls.innerHTML += `
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3 ${i === currentPage ? '!box dark:bg-darkmode-400' : ''}" onclick="goToPage(${i})">
                        ${i}
                    </a>
                </li>
            `;
        }

        if (currentPage < totalPages) {
            paginationControls.innerHTML += `
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3" onclick="goToPage(${currentPage + 1})">
                        <i data-tw-merge="" data-lucide="chevron-right" class="stroke-1.5 h-4 w-4"></i>
                    </a>
                </li>
            `;
        }
    }

    function goToPage(page) {
        currentPage = page;
        renderPagination();
        renderResults();
    }

    // Initial render
    renderPagination();
    renderResults();

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
