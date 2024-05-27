<?php
$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<h2 class="intro-y mt-10 text-lg font-medium">Job Posts (250)</h2>
<br>
<div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
    <button data-tw-merge="" data-tw-toggle="modal" data-tw-target="#new-job-post"
            class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
        Add New Post
    </button>
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
                <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                            data-tw-merge="" data-lucide="activity" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Internship</a>
                <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                            data-tw-merge="" data-lucide="activity" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Employment</a>
            </div>
        </div>
    </div>
    <div class="mx-auto hidden text-slate-500 md:block">
        Showing 1 to 10 of 150 entries
    </div>
    <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
        <div class="relative w-56 text-slate-500">
            <input data-tw-merge="" type="text" placeholder="Search..."
                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box w-56 pr-10">
            <i data-tw-merge="" data-lucide="search"
               class="stroke-1.5 absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4"></i>
        </div>
    </div>
</div>
<div class="intro-y mt-5 grid grid-cols-12 gap-6">
    <!-- BEGIN: Blog Layout -->
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <div class="intro-y box col-span-12 md:col-span-6 xl:col-span-4">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-4 dark:border-darkmode-400">
            <div class="image-fit h-10 w-10 flex-none">
                <img class="rounded-full" src="dist/images/fakers/profile-7.jpg"
                     alt="Post">
            </div>
            <div class="ml-3 mr-auto">
                <a class="font-medium" href="#">
                    Leonardo DiCaprio
                </a>
                <div class="mt-0.5 flex truncate text-xs text-slate-500">
                    <a class="inline-block truncate text-primary" href="#">
                        Internship
                    </a>
                    <span class="mx-1">•</span> 13 seconds ago
                </div>
            </div>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-3">
                <button data-tw-toggle="dropdown" aria-expanded="false"
                        class="cursor-pointer h-5 w-5 text-slate-500" tag="a"><i data-tw-merge=""
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
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Edit Post</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i
                                    data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete Post</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="image-fit h-40 2xl:h-56">
                <img class="rounded-md" src="dist/images/fakers/preview-2.jpg"
                     alt="Post">
            </div>
            <a class="mt-5 block text-base font-medium" href="#">
                Post Title
            </a>
            <div class="mt-2 text-slate-600 dark:text-slate-500">
                Post Description: Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                roots in a piece
                of classical Latin literature from 45 BC, making it over 20
            </div>
        </div>
        <div class="flex items-center border-t border-slate-200/60 px-5 py-3 dark:border-darkmode-400">
            Applications: <span class="font-medium">75k</span>
            <a data-placement="top" title="Share" href="#"
               class="tooltip cursor-pointer intro-x ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-darkmode-300 dark:text-slate-300"><i
                        data-tw-merge="" data-lucide="share" class="stroke-1.5 h-3 w-3"></i></a>
            <a data-placement="top" title="Apply Now" href="#"
               class="tooltip cursor-pointer intro-x ml-2 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white"><i
                        data-tw-merge="" data-lucide="file-text" class="stroke-1.5 h-3 w-3"></i></a>
        </div>
    </div>
    <!-- END: Blog Layout -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
        <nav class="w-full sm:mr-auto sm:w-auto">
            <ul class="flex w-full mr-0 sm:mr-auto sm:w-auto">
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3"><i
                                data-tw-merge="" data-lucide="chevron-left" class="stroke-1.5 h-4 w-4"></i></a>
                </li>
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3">1</a>
                </li>
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3 !box dark:bg-darkmode-400">2</a>
                </li>
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3">3</a>
                </li>
                <li class="flex-1 sm:flex-initial">
                    <a data-tw-merge=""
                       class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3"><i
                                data-tw-merge="" data-lucide="chevron-right" class="stroke-1.5 h-4 w-4"></i></a>
                </li>
            </ul>
        </nav>
        <select data-tw-merge=""
                class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 w-20 sm:mt-0">
            <option>10</option>
            <option>20</option>
            <option>50</option>
            <option>100</option>
        </select>
    </div>
    <!-- END: Pagination -->
</div>
<?php include "Modals/job-posts.php"; ?>
<!-- END: Content -->
<?= $this->endSection('content') ?>

