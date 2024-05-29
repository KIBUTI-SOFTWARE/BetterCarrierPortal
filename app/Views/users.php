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
<h2 class="intro-y mt-10 text-lg font-medium">Users (<?= count($users) ?>)</h2>
<div class="mt-5 grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
        <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#"
                class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
            Add New User
        </button>
        <div class="mx-auto hidden text-slate-500 md:block" id="entries-info">
            <!-- Entries info will be updated by JavaScript '-->
        </div>
        <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
            <div class="relative w-56 text-slate-500">
                <label for="search-input"></label>
                <input data-tw-merge="" type="text" placeholder="Search..."
                       class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box w-56 pr-10"
                       id="search-input">
                <i data-tw-merge="" data-lucide="search"
                   class="stroke-1.5 absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4"></i>
            </div>
        </div>
    </div>
    <!-- BEGIN: Users Layout -->
    <div id="users-container"
         class="col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap grid grid-cols-12 gap-6">
        <!-- Users will be rendered here by JavaScript -->

    </div>
    <!-- END: Users Layout -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
        <nav class="w-full sm:mr-auto sm:w-auto">
            <ul id="pagination-controls" class="flex w-full mr-0 sm:mr-auto sm:w-auto">
                <!-- Pagination controls will be updated by JavaScript -->
            </ul>
        </nav>
        <select id="items-per-page" data-tw-merge=""
                class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 w-20 sm:mt-0">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    <!-- END: Pagination -->
</div>
<script>
    const users = <?= json_encode($users) ?>;
    let currentPage = 1;
    let itemsPerPage = 9;

    document.getElementById('items-per-page').addEventListener('change', (event) => {
        itemsPerPage = parseInt(event.target.value);
        currentPage = 1; // Reset to first page
        renderPagination();
        renderUsers();
    });

    document.getElementById('search-input').addEventListener('input', () => {
        currentPage = 1; // Reset to first page on search
        renderPagination();
        renderUsers();
    });

    function renderUsers() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const filteredUsers = users.filter(user => {
            const profile = JSON.parse(user.user_profile);
            return user.user_firstname.toLowerCase().includes(searchQuery) ||
                user.user_lastname.toLowerCase().includes(searchQuery) ||
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
        const filteredUsers = users.filter(user => {
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
        renderUsers();
    }

    // Initial render
    renderPagination();
    renderUsers();
</script>
<?= $this->endSection('content') ?>
