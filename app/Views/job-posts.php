<?php
$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_id = $user["_id"];
$user_level = $user["user_level"];
$job_posts = $job_posts ?? array();
$total_posts = count($job_posts);

$job_posts_with_users = array_map(function ($job_post) {
    $usersController = new \App\Controllers\Users();
    $job_post['job_posted_by'] = $usersController->getUser($job_post['job_post_created_by']);
    return $job_post;
}, $job_posts);
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<h2 class="intro-y mt-10 text-lg font-medium">Job Posts (<?= number_format($total_posts) ?>)</h2>
<br>
<div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
    <?php if ($user_level < "4") { ?>
        <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#new-job-post"
            class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
            Add New Post
        </button>
    <?php } ?>
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
                <?php
                $categories = (new \App\Controllers\Categories)->getCategories();
                if (count($categories) > 0) {
                    foreach ($categories as $category) {
                ?>
                        <a href="/internship-posts"
                            class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                data-tw-merge="" data-lucide="activity" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            <?= ucwords($category['category_name']) ?></a>
                        <!-- <option value="<?= $category['_id'] ?>"><?= ucwords($category['category_name']) ?></option> -->
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="mx-auto hidden text-slate-500 md:block" id="entries-info">
        <!-- Entries info will be updated by JavaScript -->
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
    // Rendering the job posts through JavaScript
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
    const job_posts = <?= json_encode($job_posts_with_users) ?>;
    let currentPage = 1;
    let itemsPerPage = 9;

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

    async function renderResults() {
    const searchQuery = document.getElementById('search-input').value.toLowerCase();
    const filteredPosts = job_posts.filter(post => {
        const job_posted_by = post.job_posted_by;
        return job_posted_by.user_firstname.toLowerCase().includes(searchQuery) ||
            job_posted_by.user_lastname.toLowerCase().includes(searchQuery) ||
            post.job_post_title.toLowerCase().includes(searchQuery);
    });

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedPosts = filteredPosts.slice(startIndex, endIndex);

    const postsContainer = document.getElementById('posts-container');
    postsContainer.innerHTML = '';

    for (const post of paginatedPosts) {
        const postLink = `<?= base_url() ?>view-job-post/${post._id}`;
        const jobCategory = await getPostCategory(post.job_post_category);
        const jobPostedOn = timeAgo(post.job_post_created_on);
        const job_posted_by = post.job_posted_by;
        const job_posted_by_profile = JSON.parse(job_posted_by.user_profile);

        const userLevel = <?= $user_level ?> > 3; // Use numeric comparison
        const isCreator = <?= $user_id ?> === post.job_post_created_by || <?= $user_level ?> < 3;

        const applyButtonHTML = userLevel ? `
            <a data-placement="top" title="Apply Now" href="#" data-tw-toggle="modal"
               data-tw-target="#apply-now"
               data-post-id="${post._id}"
               class="apply-now tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                    data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i>Apply</a>
        ` : '';

        const editDeleteButtonsHTML = isCreator ? `
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500">
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
                        <a href="/view-job-post/${post._id}"
                           class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="eye" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            View Post</a>
                    </div>
                </div>
            </div>
        ` : '';

        const postHTML = `
            <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
                    <div class="image-fit h-10 w-10 flex-none">
                        <img class="rounded-full" src="${job_posted_by_profile.user_photo}"
                             onerror="this.onerror=null; this.src='dist/images/fakers/profile-9.jpg';"
                             alt="Post">
                    </div>
                    <div class="ml-3 mr-auto">
                        <a class="font-medium" href="#">${job_posted_by.user_firstname} ${job_posted_by.user_lastname}</a>
                        <div class="mt-0.5 flex truncate text-xs text-slate-500">
                            <a class="inline-block truncate text-primary" href="#">
                                ${jobCategory.category_name}
                            </a>
                            <span class="mx-1">•</span> ${jobPostedOn}
                        </div>
                    </div>
                    ${editDeleteButtonsHTML}
                </div>
                <div class="p-5">
                    <div class="image-fit h-40 2xl:h-56">
                        <img class="rounded-md" src="dist/images/pdf.png"
                             alt="Post">
                    </div>
                    <a class="mt-5 block text-base font-medium" href="/view-job-post/${post._id}">
                        ${post.job_post_title}
                    </a>
                    <div class="mt-2 text-slate-600 dark:text-slate-500">
                        ${post.job_post_title}
                    </div>
                </div>
                <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
                    <a data-placement="top" title="Share" href="#"
                       data-post-link="${postLink}"
                       class="share-link tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                                data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i>Share</a>
                    ${applyButtonHTML}
                </div>
            </div>
        `;
        postsContainer.insertAdjacentHTML('beforeend', postHTML);
    }

    const entriesInfo = document.getElementById('entries-info');
    const totalEntries = filteredPosts.length;
    const startEntry = startIndex + 1;
    const endEntry = Math.min(endIndex, totalEntries);
    entriesInfo.textContent = `Showing ${startEntry} to ${endEntry} of ${totalEntries} entries`;
}

    function renderPagination() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const filteredPosts = job_posts.filter(post => {
            const job_posted_by = post.job_posted_by;
            return job_posted_by.user_firstname.toLowerCase().includes(searchQuery) ||
                job_posted_by.user_lastname.toLowerCase().includes(searchQuery) ||
                post.job_post_title.toLowerCase().includes(searchQuery);
        });

        const totalPages = Math.ceil(filteredPosts.length / itemsPerPage);
        const paginationControls = document.getElementById('pagination-controls');
        paginationControls.innerHTML = '';

        // Define the range of pages to show
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        // Adjust startPage if we're at the end
        if (endPage - startPage < maxVisiblePages - 1) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        // First Page Button
        if (currentPage > 1) {
            paginationControls.innerHTML += `
            <li class="flex-1 sm:flex-initial">
                <a data-tw-merge=""
                   class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3" onclick="goToPage(1)">
                    First
                </a>
            </li>
        `;
        }

        // Previous Page Button
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

        // Page Number Buttons
        for (let i = startPage; i <= endPage; i++) {
            paginationControls.innerHTML += `
            <li class="flex-1 sm:flex-initial">
                <a data-tw-merge=""
                   class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3 ${i === currentPage ? '!box dark:bg-darkmode-400' : ''}" onclick="goToPage(${i})">
                    ${i}
                </a>
            </li>
        `;
        }

        // Next Page Button
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

        // Last Page Button
        if (currentPage < totalPages) {
            paginationControls.innerHTML += `
            <li class="flex-1 sm:flex-initial">
                <a data-tw-merge=""
                   class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3" onclick="goToPage(${totalPages})">
                    Last
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

    function timeAgo(timestamp) {
        const time = new Date(timestamp);
        const now = new Date();

        const diff = Math.abs(now - time) / 1000; // Difference in seconds

        const intervals = {
            year: 31536000,
            month: 2592000,
            day: 86400,
            hour: 3600,
            minute: 60,
            second: 1
        };

        for (const [unit, seconds] of Object.entries(intervals)) {
            const count = Math.floor(diff / seconds);
            if (count > 0) {
                return count + ' ' + unit + (count > 1 ? 's' : '') + ' ago';
            }
        }
        return 'just now';
    }

    async function getPostCategory(category_id) {
        try {
            const data = {
                category_id: category_id
            };
            const jsonData = JSON.stringify(data);

            let response = await fetch('/ajax/get-category', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: jsonData
            });

            if (!response.ok) {
                throw new Error('Failed to fetch category data');
            }

            return await response.json();
        } catch (error) {
            console.error('Error fetching category details:', error);
            throw error; // Re-throw the error to handle it elsewhere if needed
        }
    }

    // Initial render
    renderPagination();
    renderResults();

    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(event) {
            if (event.target.closest('.share-link')) {
                event.preventDefault(); // Prevent the default anchor behavior

                const shareLink = event.target.closest('.share-link');
                const postLink = shareLink.getAttribute('data-post-link'); // Get the link from data-post-link attribute

                // Copy the link to the clipboard
                navigator.clipboard.writeText(postLink).then(function() {
                    Swal.fire({
                        position: "top-end",
                        timer: 10000,
                        text: "Link to the Post Copied to Clipboard.",
                        icon: "info"
                    });
                }).catch(function(err) {
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

    document.getElementById('posts-container').addEventListener('click', function(e) {
        if (e.target.closest('.apply-now')) {
            e.preventDefault();

            const button = e.target.closest('.apply-now');
            const postID = button.getAttribute('data-post-id');
            const modalInput = document.querySelector('#apply-now .postID');
            console.log(postID);
            if (modalInput) {
                modalInput.value = postID;
            }

            const applyModal = new bootstrap.Modal(document.getElementById('apply-now'));
            applyModal.show();
        }
    });
</script>
<?= $this->endSection() ?>
