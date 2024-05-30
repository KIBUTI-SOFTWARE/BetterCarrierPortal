<?php
$session = session();
$user = $session->get("user");
$user_id = $user["_id"];
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Content -->
<div class="mt-8 flex items-center">
    <h2 class="intro-y mr-auto text-lg font-medium">Profile</h2>
</div>
<div>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box mt-5 px-5 pt-5">
        <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
            <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                <div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                    <img class="rounded-full" src="dist/images/fakers/profile-15.jpg"
                         alt="Midone - Tailwind Admin Dashboard Template">
                </div>
                <div class="ml-5">
                    <div class="w-24 truncate text-lg font-medium sm:w-40 sm:whitespace-normal">
                        Denzel Washington
                    </div>
                    <div class="text-slate-500">DevOps Engineer</div>
                </div>
            </div>
            <div class="mt-6 flex-1 border-l border-r border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                <div class="text-center font-medium lg:mt-3 lg:text-left">
                    Contact Details
                </div>
                <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                    <div class="flex items-center truncate sm:whitespace-normal">
                        <i data-tw-merge="" data-lucide="mail" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        denzelwashington@left4code.com
                    </div>
                    <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                        <i data-tw-merge="" data-lucide="instagram" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Instagram
                        Denzel Washington
                    </div>
                    <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                        <i data-tw-merge="" data-lucide="twitter" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Twitter
                        Denzel Washington
                    </div>
                </div>
            </div>
            <div class="mt-6 flex flex-1 items-center justify-center border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-0 lg:pt-0">
                <div class="w-20 rounded-md py-3 text-center">
                    <div class="text-xl font-medium text-primary">201</div>
                    <div class="text-slate-500">Posts</div>
                </div>
                <div class="w-20 rounded-md py-3 text-center">
                    <div class="text-xl font-medium text-primary">1k</div>
                    <div class="text-slate-500">Applications</div>
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
            <li id="account-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none">
                <a data-tw-merge="" data-tw-target="#update-profile" role="tab"
                   class="cursor-pointer appearance-none px-5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white border-b-2 dark:border-transparent [&.active]:border-b-primary [&.active]:font-medium [&.active]:dark:border-b-primary flex items-center py-4"><i
                            data-tw-merge="" data-lucide="shield" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Update Profile</a>
            </li>
            <li id="change-password-tab" data-tw-merge="" role="presentation"
                class="focus-visible:outline-none">
                <a data-tw-merge="" data-tw-target="#change-password" role="tab"
                   class="cursor-pointer appearance-none px-5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white border-b-2 dark:border-transparent [&.active]:border-b-primary [&.active]:font-medium [&.active]:dark:border-b-primary flex items-center py-4"><i
                            data-tw-merge="" data-lucide="lock" class="stroke-1.5 mr-2 h-4 w-4"></i>
                    Change Password</a>
            </li>
        </ul>
    </div>
    <!-- END: Profile Info -->
    <!-- BEGIN: Personal Information -->
    <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane active leading-relaxed">
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
                            <label data-tw-merge="" for="update-profile-form-6" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                Email
                            </label>
                            <input data-tw-merge="" id="update-profile-form-6" type="text" value="johnnydepp@left4code.com" placeholder="Input text" disabled="disabled" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                        </div>
                        <div class="mt-3">
                            <label data-tw-merge="" for="update-profile-form-7" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                Name
                            </label>
                            <input data-tw-merge="" id="update-profile-form-7" type="text" value="Johnny Depp" placeholder="Input text" disabled="disabled" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                        </div>
                        <div class="mt-3">
                            <label data-tw-merge="" for="update-profile-form-8" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                ID Type
                            </label>
                            <select data-tw-merge="" id="update-profile-form-8" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1">
                                <option>IC</option>
                                <option>FIN</option>
                                <option>Passport</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label data-tw-merge="" for="update-profile-form-9" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                ID Number
                            </label>
                            <input data-tw-merge="" id="update-profile-form-9" type="text" value="357821204950001" placeholder="Input text" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-6">
                        <div class="mt-3 xl:mt-0">
                            <label data-tw-merge="" for="update-profile-form-10" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                Phone Number
                            </label>
                            <input data-tw-merge="" id="update-profile-form-10" type="text" value="65570828" placeholder="Input text" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                        </div>
                        <div class="mt-3">
                            <label data-tw-merge="" for="update-profile-form-11" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                Address
                            </label>
                            <input data-tw-merge="" id="update-profile-form-11" type="text" value="10 Anson Road, International Plaza, #10-11, 079903 Singapore, Singapore" placeholder="Input text" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                        </div>
                        <div class="mt-3">
                            <label data-tw-merge="" for="update-profile-form-12" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                Bank Name
                            </label>
                            <select id="update-profile-form-12" class="tom-select w-full">
                                <option value="1">SBI - STATE BANK OF INDIA</option>
                                <option value="2">CITI BANK - CITI BANK</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label data-tw-merge="" for="update-profile-form-13" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                Bank Account
                            </label>
                            <input data-tw-merge="" id="update-profile-form-13" type="text" value="DBS Current 011-903573-0" placeholder="Input text" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button data-tw-merge="" type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-auto w-20">Save</button>
                    <a class="flex items-center text-danger" href="#">
                        <i data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-1 h-4 w-4"></i>
                        Delete
                        Account
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Personal Information -->
</div>
<!-- END: Content -->
<?= $this->endSection('content') ?>

