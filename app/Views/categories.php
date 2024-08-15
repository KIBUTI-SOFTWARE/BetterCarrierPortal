<?php
$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_id = $user["_id"];
$user_level = $user["user_level"];
$categories = $categories ?? array();
$total_categories = count($categories);
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<h2 class="intro-y mt-10 text-lg font-medium">Categories (<?= number_format($total_categories) ?>)</h2>
<br>
<div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
    <?php if ($user_level < "3") {
        ?>
        <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#new-category"
                class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
            Add New Category
        </button>
    <?php } ?>
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
<div class="intro-y mt-5 grid grid-cols-12 gap-6" id="categories-container">
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
<?php include "Modals/categories.php"; ?>
<!-- END: Content -->

<script>
    const categories = <?= json_encode($categories) ?>;
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
        const filteredCategories = categories.filter(category => {
            return category.category_name.toLowerCase().includes(searchQuery) ||
                category.category_description.toLowerCase().includes(searchQuery);
        });

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedCategories = filteredCategories.slice(startIndex, endIndex);

        const categoriesContainer = document.getElementById('categories-container');
        categoriesContainer.innerHTML = '';

        if (paginatedCategories.length > 0) {
            for (const category of paginatedCategories) {

                const postHTML = `
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <div class="box">
                        <div class="p-5">
                            <div class="image-fit h-40 overflow-hidden rounded-md before:absolute before:left-0 before:top-0 before:z-10 before:block before:h-full before:w-full before:bg-gradient-to-t before:from-black before:to-black/10 2xl:h-56">
                                <img class="rounded-md" src="${category.package_label}"
                                     onerror="this.onerror=null; this.src='dist/images/<?=$_ENV['system_logo']?>';"
                                     alt="Package">
                                <div class="absolute bottom-0 z-10 px-5 pb-6 text-white">
                                    ${category.category_name}
                                </div>
                            </div>
                            <div class="mt-5 text-slate-600 dark:text-slate-500">
                                <div class="flex items-center">
                                    <i data-tw-merge="" data-lucide="link" class="stroke-1.5 mr-2 h-4 w-4"></i>
                                    Description: ${category.category_description}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center border-t border-slate-200/60 p-5 dark:border-darkmode-400 lg:justify-end">
                            <a class="mr-3 flex items-center" href="/view-category/${category._id}">
                                <i data-tw-merge="" data-lucide="check-square" class="stroke-1.5 mr-1 h-4 w-4"></i>
                                View
                            </a>
                        </div>
                    </div>
                </div>`;
                categoriesContainer.insertAdjacentHTML('beforeend', postHTML);
            }
        } else {
            categoriesContainer.innerHTML = '<div class="col-span-12 text-center text-slate-600 dark:text-slate-500">No Categories Found.</div>';
        }

        const entriesInfo = document.getElementById('entries-info');
        const totalEntries = filteredCategories.length;
        const startEntry = startIndex + 1;
        const endEntry = Math.min(endIndex, totalEntries);
        entriesInfo.textContent = `Showing ${startEntry} to ${endEntry} of ${totalEntries} entries`;
    }

    function renderPagination() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const filteredCategories = categories.filter(category => {
            return category.category_name.toLowerCase().includes(searchQuery) ||
                category.category_description.toLowerCase().includes(searchQuery);
        });

        const totalPages = Math.ceil(filteredCategories.length / itemsPerPage);
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

    function getPostCategory(category) {
        const post_category = new Map([
            ["1", "Employment"],
            ["2", "Internship"],
        ]);

        return post_category.get(category) || "Undefined Category";
    }

    // Initial render
    renderPagination();
    renderResults();
</script>

<?= $this->endSection() ?>