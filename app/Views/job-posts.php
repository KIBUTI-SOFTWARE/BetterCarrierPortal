<?php
$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];
$users = $users ?? array();
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<h2 class="intro-y mt-10 text-lg font-medium">Job Posts (<?= number_format(count($job_posts)) ?>)</h2>
<br>
<div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
    <!-- Add new post button -->
    <?php if ($user_level < "4"): ?>
        <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#new-job-post"
                class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
            Add New Post
        </button>
    <?php endif; ?>
    <!-- Filter dropdown -->
    <!-- Pagination Info -->
    <div class="mx-auto hidden text-slate-500 md:block" id="entries-info">
        <!-- Entries info will be updated by JavaScript -->
    </div>
    <!-- Search input -->
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
<!-- Job Posts Container -->
<div class="intro-y mt-5 grid grid-cols-12 gap-6" id="posts-container">
    <!-- Job Posts will be rendered by JavaScript -->
</div>
<!-- Pagination -->
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
<!-- Modals -->
<?php include "Modals/job-posts.php"; ?>
<!-- END: Content -->
<script>
    const jobPosts = <?= json_encode($job_posts) ?>;
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
        const filteredPosts = jobPosts.filter(post => {
            // Filter Condition
            return post.job_post_title.toLowerCase().includes(searchQuery);
        });

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedPosts = filteredPosts.slice(startIndex, endIndex);

        const postsContainer = document.getElementById('posts-container');
        postsContainer.innerHTML = '';

        paginatedPosts.forEach(post => {
            // Adjust this HTML template based on your job post card structure
            postsContainer.innerHTML += `
                <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
                    <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
                        <div class="image-fit h-10 w-10 flex-none">
                            <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                                 alt="Post">
                        </div>
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
                </div>
            `;
        });

        document.getElementById('entries-info').innerText = `Showing ${startIndex + 1} to ${Math.min(endIndex, filteredPosts.length)} of ${filteredPosts.length} entries`;
    }

    function renderPagination() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const filteredPosts = jobPosts.filter(post => {
            // Adjust this filter condition based on your job post data structure
            return post.job_post_title.toLowerCase().includes(searchQuery);
        });

        const totalPages = Math.ceil(filteredPosts.length / itemsPerPage);
        const paginationControls = document.getElementById('pagination-controls');
        paginationControls.innerHTML = '';

        if (currentPage > 1) {
            paginationControls.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="goToPage(${currentPage - 1})">Previous</a>
                </li>
            `;
        }

        for (let i = 1; i <= totalPages; i++) {
            paginationControls.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>
                </li>
            `;
        }

        if (currentPage < totalPages) {
            paginationControls.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="goToPage(${currentPage + 1})">Next</a>
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
</script>

<?= $this->endSection('content') ?>
