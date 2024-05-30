<?php
$session = session();
$user = $session->get("user");
$job_applications = $job_applications ?? array();
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<h2 class="intro-y mt-10 text-lg font-medium">Job Applications (<?= number_format(count($job_applications)) ?>)</h2>
<div class="mt-5 grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
        <div class="mx-auto hidden text-slate-500 md:block" id="entries-info">
            <!-- Entries info will be updated by JavaScript -->
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
    <!-- BEGIN: Job Applications Layout -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table -mt-2">
            <thead>
            <tr>
                <th class="whitespace-nowrap">Applicant</th>
                <th class="whitespace-nowrap">Job Title</th>
                <th class="whitespace-nowrap">Status</th>
                <th class="whitespace-nowrap">Application Date</th>
                <th class="whitespace-nowrap">Actions</th>
            </tr>
            </thead>
            <tbody id="job-applications-container">
            <!-- Job applications will be rendered here by JavaScript -->
            </tbody>
        </table>
    </div>
    <!-- END: Job Applications Layout -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap mt-5">
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
</div>
<script>
    const jobApplications = <?= json_encode($job_applications) ?>;
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
        const filteredApplications = jobApplications.filter(application => {
            return application._id.toLowerCase().includes(searchQuery);
        });

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedApplications = filteredApplications.slice(startIndex, endIndex);

        const applicationsContainer = document.getElementById('job-applications-container');
        applicationsContainer.innerHTML = '';

        paginatedApplications.forEach(application => {
            const sn = 0;
            const applicationSentOn = timeAgo(application.job_application_created_on);

            applicationsContainer.innerHTML += `
                <tr>
                    <td class="whitespace-nowrap">
                        ++${sn}
                    </td>
                    <td class="whitespace-nowrap">${application._id}</td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center justify-center ${application._id == '1' ? 'text-success' : 'text-danger'}">
                            ${application._id == '1' ? 'Active' : 'Inactive'}
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center justify-center text-success">
                            ${new Date(application.job_application_created_on).toLocaleDateString()}
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center justify-center">
                            <a class="mr-3 flex items-center" href="#">
                                <i data-tw-merge="" data-lucide="view" class="stroke-1.5 mr-1 h-4 w-4"></i>
                                View
                            </a>
                            <a class="flex items-center text-danger" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" href="#">
                                <i data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-1 h-4 w-4"></i>
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
            `;
        });

        document.getElementById('entries-info').innerText = `Showing ${startIndex + 1} to ${Math.min(endIndex, filteredApplications.length)} of ${filteredApplications.length} entries`;
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

    function renderPagination() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const filteredApplications = jobApplications.filter(application => {
            return application._id.toLowerCase().includes(searchQuery);
        });

        const totalPages = Math.ceil(filteredApplications.length / itemsPerPage);
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
</script>
<?= $this->endSection('content') ?>
