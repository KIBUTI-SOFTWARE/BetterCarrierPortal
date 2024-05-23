<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex h-10 items-center">
                    <h2 class="mr-5 truncate text-lg font-medium">General Report</h2>
                    <a class="ml-auto flex items-center text-primary" href="#">
                        <i data-tw-merge="" data-lucide="refresh-ccw" class="stroke-1.5 mr-3 h-4 w-4"></i>
                        Reload Data
                    </a>
                </div>
                <div class="mt-5 grid grid-cols-12 gap-6">
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-tw-merge="" data-lucide="users"
                                       class="stroke-1.5 h-[28px] w-[28px] text-primary"></i>
                                    <div class="ml-auto">
                                        <div data-placement="top" title="33% Higher than last month"
                                             class="tooltip cursor-pointer flex items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white">
                                            33%
                                            <i data-tw-merge="" data-lucide="chevron-up"
                                               class="stroke-1.5 ml-0.5 h-4 w-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 text-3xl font-medium leading-8">4,710</div>
                                <div class="mt-1 text-base text-slate-500">Employers</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-tw-merge="" data-lucide="user"
                                       class="stroke-1.5 h-[28px] w-[28px] text-pending"></i>
                                    <div class="ml-auto">
                                        <div data-placement="top" title="2% Lower than last month"
                                             class="tooltip cursor-pointer flex items-center rounded-full bg-danger py-[3px] pl-2 pr-1 text-xs font-medium text-white">
                                            2%
                                            <i data-tw-merge="" data-lucide="chevron-down"
                                               class="stroke-1.5 ml-0.5 h-4 w-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 text-3xl font-medium leading-8">3,721</div>
                                <div class="mt-1 text-base text-slate-500">Job Seekers</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-tw-merge="" data-lucide="file-text"
                                       class="stroke-1.5 h-[28px] w-[28px] text-warning"></i>
                                    <div class="ml-auto">
                                        <div data-placement="top" title="12% Higher than last month"
                                             class="tooltip cursor-pointer flex items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white">
                                            12%
                                            <i data-tw-merge="" data-lucide="chevron-up"
                                               class="stroke-1.5 ml-0.5 h-4 w-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 text-3xl font-medium leading-8">2,149</div>
                                <div class="mt-1 text-base text-slate-500">
                                    Job Posts
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-tw-merge="" data-lucide="edit"
                                       class="stroke-1.5 h-[28px] w-[28px] text-success"></i>
                                    <div class="ml-auto">
                                        <div data-placement="top" title="22% Higher than last month"
                                             class="tooltip cursor-pointer flex items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white">
                                            22%
                                            <i data-tw-merge="" data-lucide="chevron-up"
                                               class="stroke-1.5 ml-0.5 h-4 w-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 text-3xl font-medium leading-8">152,040</div>
                                <div class="mt-1 text-base text-slate-500">
                                    Job Applications
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Report -->
            <div class="col-span-12 mt-8 lg:col-span-12">
                <div class="intro-y block h-10 items-center sm:flex">
                    <h2 class="mr-5 truncate text-lg font-medium">Applications Report</h2>
                </div>
                <div class="intro-y box mt-12 p-5 sm:mt-5">
                    <div class="flex flex-col md:flex-row md:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-lg font-medium text-primary dark:text-slate-300 xl:text-xl">
                                    15,000
                                </div>
                                <div class="mt-0.5 text-slate-500">This Month</div>
                            </div>
                            <div class="mx-4 h-12 w-px border border-r border-dashed border-slate-200 dark:border-darkmode-300 xl:mx-5">
                            </div>
                            <div>
                                <div class="text-lg font-medium text-slate-500 xl:text-xl">
                                    10,000
                                </div>
                                <div class="mt-0.5 text-slate-500">Last Month</div>
                            </div>
                        </div>
                    </div>
                    <div class="relative before:content-[''] before:block before:absolute before:w-16 before:left-0 before:top-0 before:bottom-0 before:ml-10 before:mb-7 before:bg-gradient-to-r before:from-white before:via-white/80 before:to-transparent before:dark:from-darkmode-600 after:content-[''] after:block after:absolute after:w-16 after:right-0 after:top-0 after:bottom-0 after:mb-7 after:bg-gradient-to-l after:from-white after:via-white/80 after:to-transparent after:dark:from-darkmode-600">
                        <div class="w-auto h-[275px]">
                            <canvas id="report-line-chart" class="chart -mb-6 mt-6"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Report -->
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>

