<?php

use App\Controllers\Roles;

$session = session();
$user = $session->get("user");
if (empty($user)) {
    redirect()->to("/login");
}
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];

$user_account_data = $user_data ?? array();
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<div class="mt-8 flex items-center">
    <h2 class="intro-y mr-auto text-lg font-medium">User Profile</h2>
</div>
<div>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box mt-5 px-5 pt-5">
        <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
            <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                <div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                    <img class="rounded-full" src="<?= $user_profile['user_photo'] ?? "" ?>"
                         onerror="this.onerror=null; this.src='dist/images/fakers/profile-9.jpg';"
                         alt="User">
                </div>
                <div class="ml-5">
                    <div class="w-24 truncate text-lg font-medium sm:w-40 sm:whitespace-normal">
                        <?= ucwords($user_account_data['user_firstname'] . " " . $user_account_data['user_lastname']) ?>
                    </div>
                    <div class="text-slate-500"><?= \Config\MyFunctions::getUserLevel($user_account_data["user_level"]) ?></div>
                </div>
            </div>
            <div class="mt-6 flex-1 border-l border-r border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                <div class="text-center font-medium lg:mt-3 lg:text-left">
                    Contact Details
                </div>
                <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                    <div class="flex items-center truncate sm:whitespace-normal">
                        <i data-tw-merge="" data-lucide="mail" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        <?= $user_account_data['user_email'] ?>
                    </div>
                    <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                        <i data-tw-merge="" data-lucide="phone" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        <?= $user_account_data['user_phone'] ?>
                    </div>
                </div>
            </div>
        </div>
        <ul data-tw-merge="" role="tablist"
            class="w-full flex flex-col justify-center text-center sm:flex-row">
            <li id="profile-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none">
                <a data-tw-merge="" data-tw-target="#profile" role="tab"
                   class="cursor-pointer appearance-none px-5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white border-b-2 dark:border-transparent [&.active]:border-b-primary [&.active]:font-medium [&.active]:dark:border-b-primary active flex items-center py-4"><i
                            data-tw-merge="" data-lucide="user" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Profile</a>
            </li>
            <?php
            if (!empty($user_permissions['edit_user'])) {
                ?>
                <li id="update-profile-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none">
                    <button data-tw-merge="" data-tw-target="#update-profile" role="tab"
                            class="cursor-pointer appearance-none px-5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white border-b-2 dark:border-transparent [&.active]:border-b-primary [&.active]:font-medium [&.active]:dark:border-b-primary flex items-center py-4">
                        <i data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Update Profile
                    </button>
                </li>
                <?php
            }
            ?>
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
             id="profile" role="tabpanel" aria-labelledby="profile-tab"
             class="tab-pane active leading-relaxed">
            <div class="intro-y col-span-12 lg:col-span-8 xl:col-span-9">
                <div class="intro-y box mt-5">
                    <div class="flex items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400">
                        <h2 class="mr-auto text-base font-medium">
                            Personal Information
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div>
                                    <label data-tw-merge="" for="update-profile-form-7"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Fullname
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-7" type="text"
                                           value="<?= $user_account_data['user_firstname'] . " " . $user_account_data['user_lastname'] ?>"
                                           placeholder="Input text" disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                                <div class="mt-3">
                                    <label data-tw-merge="" for="update-profile-form-6"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Email
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-6" type="text"
                                           value="<?= $user_account_data['user_email'] ?>" placeholder="Input text"
                                           disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                                <div class="mt-3">
                                    <label data-tw-merge="" for="update-profile-form-6"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Account Type
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-6" type="text"
                                           value="<?= \Config\MyFunctions::getUserLevel($user_account_data['user_level']) ?>"
                                           placeholder="Input text" disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3 xl:mt-0">
                                    <label data-tw-merge="" for="update-profile-form-7"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Surname
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-7" type="text"
                                           value="<?= $user_account_profile['user_surname'] ?? "Not Set" ?>"
                                           placeholder="Input text"
                                           disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                                <div class="mt-3">
                                    <label data-tw-merge="" for="update-profile-form-10"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Phone Number
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-10" type="text"
                                           value="<?= $user_account_data['user_phone'] ?>" disabled="disabled"
                                           placeholder="Input text"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                                <div class="mt-3">
                                    <label data-tw-merge="" for="update-profile-form-10"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Joined On
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-10" type="text"
                                           value="<?= \Config\MyFunctions::timeAgo($user_account_data['user_created_on']) ?>"
                                           disabled="disabled" placeholder="Input text"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro-y box mt-5">
                    <div class="flex items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400">
                        <h2 class="mr-auto text-base font-medium">
                            Other Information
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div>
                                    <label data-tw-merge="" for="update-profile-form-7"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Fullname
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-7" type="text"
                                           value="<?= $user_account_data['user_firstname'] . " " . $user_account_data['user_lastname'] ?>"
                                           placeholder="Input text" disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3 xl:mt-0">
                                    <label data-tw-merge="" for="update-profile-form-7"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Date of Birth
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-7" type="text"
                                           value="<?= date('Y-m-d', strtotime($user_account_profile['user_dob'] ?? "")) ?>"
                                           placeholder="Input text" disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
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
             id="update-profile" role="tabpanel" aria-labelledby="update-profile-tab"
             class="tab-pane leading-relaxed">
            <div class="intro-y box mt-5">
                <div class="flex items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400">
                    <h2 class="mr-auto text-base font-medium">
                        Updating Profile
                    </h2>
                </div>
                <form name="update-profile" action="/users/update-user" method="post"
                      enctype="multipart/form-data">
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <input type="hidden"
                                   value="<?= $user_account_data['_id'] ?? "" ?>"
                                   name="user_id">
                            <div class="col-span-12 xl:col-span-6">
                                <div>
                                    <label data-tw-merge="" for="update-profile-form-7"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        First Name
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-7" type="text"
                                           value="<?= $user_account_data['user_firstname'] ?? "" ?>"
                                           name="user_firstname" disabled="disabled"
                                           placeholder="Input text"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                                <div class="mt-3">
                                    <label data-tw-merge="" for="update-profile-form-7"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Surname
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-7"
                                           type="text"
                                           value="<?= $user_account_profile['user_surname'] ?? "" ?>"
                                           placeholder="Input text"
                                           name="user_surname" disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                                <div class="mt-3">
                                    <label data-tw-merge="" for="update-profile-form-6"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Email
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-6" type="text"
                                           value="<?= $user_account_data['user_email'] ?>"
                                           name="user_email"
                                           placeholder="Input text" disabled="disabled"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>

                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3 xl:mt-0">
                                    <label data-tw-merge="" for="update-profile-form-7"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Last Name
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-7" type="text"
                                           value="<?= $user_account_data['user_lastname'] ?? "" ?>"
                                           name="user_lastname" disabled="disabled"
                                           placeholder="Input text"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                </div>
                                <div class="mt-3">
                                    <label data-tw-merge="" for="update-profile-form-10"
                                           class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                        Phone Number
                                    </label>
                                    <input data-tw-merge="" id="update-profile-form-10" type="text"
                                           value="<?= $user_account_data['user_phone'] ?>"
                                           name="user_phone"
                                           disabled="disabled" placeholder="Input text"
                                           class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
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
        </div>

    </div>
    <!-- END: Personal Information -->
</div>
<?php include "Modals/users.php"; ?>
<!-- END: Content -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('submit').disabled = true; // Disable the button by default
    });

    function validatePassword() {
        const password = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        // Get the error message container
        const errorMessages = document.getElementById('errorMessages');

        // Reset previous error messages
        errorMessages.innerHTML = '';

        // Check if password and confirm password match
        if (password === '' || confirmPassword === '') {
            document.getElementById('submit').disabled = true;
            errorMessages.innerHTML = 'Please enter both password and confirm password.';
        } else if (password !== confirmPassword) {
            document.getElementById('submit').disabled = true;
            errorMessages.innerHTML = 'Password and Confirm Password do not match.';
        } else {
            document.getElementById('submit').disabled = false;
        }
    }

    // Attach the validatePassword function to the input events of password and confirm password fields
    document.getElementById('new_password').addEventListener('input', validatePassword);
    document.getElementById('confirm_password').addEventListener('input', validatePassword);
</script>
<?= $this->endSection('content') ?>