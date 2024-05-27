<?php
$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="opacity-0" lang="en">
<!-- BEGIN: Head -->

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="ceKdwoQjZ4VuoGqoSQaSREwB7MD9sjwFnfhlp7MH">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="LEFT4CODE">
    <title>Carrier Portal</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="dist/css/vendors/tippy.css">
    <link rel="stylesheet" href="dist/css/vendors/litepicker.css">
    <link rel="stylesheet" href="dist/css/vendors/tiny-slider.css">
    <link rel="stylesheet" href="dist/css/themes/tinker/side-nav.css">
    <link rel="stylesheet" href="dist/css/vendors/leaflet.css">
    <link rel="stylesheet" href="dist/css/vendors/simplebar.css">
    <link rel="stylesheet" href="dist/css/components/mobile-menu.css">
    <link rel="stylesheet" href="dist/css/app.css">
    <link rel="stylesheet" href="dist/css/vendors/tom-select.css">
    <link rel="stylesheet" href="dist/css/vendors/ckeditor.css">
    <link rel="stylesheet" href="dist/css/vendors/dropzone.css">
    <link rel="stylesheet" href="dist/css/vendors/highlight.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css"
          integrity="sha512-OQDNdI5rpnZ0BRhhJc+btbbtnxaj+LdQFeh0V9/igiEPDiWE2fG+ZsXl0JEH+bjXKPJ3zcXqNyP4/F/NegVdZg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css " rel="stylesheet">
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js "></script>
    <style>
        .invalid {
            border-color: red;
        }

    </style>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body>
<div class="tinker md:bg-black/[0.15] dark:bg-transparent relative py-5 px-5 md:py-0 sm:px-8 md:px-0 after:content-[''] after:bg-gradient-to-b after:from-theme-1 after:to-theme-2 dark:after:from-darkmode-800 dark:after:to-darkmode-800 after:fixed after:inset-0 after:z-[-2]">
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu group top-0 inset-x-0 fixed bg-theme-1/90 z-[60] border-b border-white/[0.08] dark:bg-darkmode-800/90 md:hidden before:content-[''] before:w-full before:h-screen before:z-10 before:fixed before:inset-x-0 before:bg-black/90 before:transition-opacity before:duration-200 before:ease-in-out before:invisible before:opacity-0 [&.mobile-menu--active]:before:visible [&.mobile-menu--active]:before:opacity-100">
        <div class="flex h-[70px] items-center px-3 sm:px-8">
            <a class="mr-auto flex" href="#">
                <img class="w-6" src="dist/images/logo.svg" alt="Carrier Portal">
            </a>
            <a class="mobile-menu-toggler" href="#">
                <i data-tw-merge="" data-lucide="bar-chart2"
                   class="stroke-1.5 h-8 w-8 -rotate-90 transform text-white"></i>
            </a>
        </div>
        <div class="scrollable h-screen z-20 top-0 left-0 w-[270px] -ml-[100%] bg-primary transition-all duration-300 ease-in-out dark:bg-darkmode-800 [&[data-simplebar]]:fixed [&_.simplebar-scrollbar]:before:bg-black/50 group-[.mobile-menu--active]:ml-0">
            <a href="#"
               class="fixed top-0 right-0 mt-4 mr-4 transition-opacity duration-200 ease-in-out invisible opacity-0 group-[.mobile-menu--active]:visible group-[.mobile-menu--active]:opacity-100">
                <i data-tw-merge="" data-lucide="x-circle"
                   class="stroke-1.5 mobile-menu-toggler h-8 w-8 -rotate-90 transform text-white"></i>
            </a>
            <ul class="py-2">
                <!-- BEGIN: First Child -->
                <li>
                    <a class="menu
                    <?php if ($_SERVER["REQUEST_URI"] === "dashboard" || str_contains($_SERVER["REQUEST_URI"], "dashboard")) {
                        ?>menu--active<?php
                    }
                    ?>"
                       href="/dashboard">
                        <div class="menu__icon">
                            <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                        <div class="menu__title">
                            Dashboard
                        </div>
                    </a>
                </li>
                <?php
                if ($user_level < "3" && !empty($user_profile)) {
                    ?>
                    <li>
                        <a class="menu
                    <?php if ($_SERVER["REQUEST_URI"] === "employment-posts" || $_SERVER["REQUEST_URI"] === "internship-posts" || str_contains($_SERVER["REQUEST_URI"], "post")) {
                            ?>menu--active<?php
                        }
                        ?>" href="javascript:;">
                            <div class="menu__icon">
                                <i data-tw-merge="" data-lucide="trello" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="menu__title">
                                Job Posts
                                <div class="menu__sub-icon ">
                                    <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a class="menu" href="/employment-posts">
                                    <div class="menu__icon">
                                        <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                    </div>
                                    <div class="menu__title">
                                        Employment Posts
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="menu" href="/internship-posts">
                                    <div class="menu__icon">
                                        <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                    </div>
                                    <div class="menu__title">
                                        Internship Posts
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if ($user_level < "3") {
                        ?>
                        <li>
                            <a class="menu
                        <?php if ($_SERVER["REQUEST_URI"] === "view-users-employees" || $_SERVER["REQUEST_URI"] === "view-users-job-seekers" || $_SERVER["REQUEST_URI"] === "view-users" || str_contains($_SERVER["REQUEST_URI"], "user")) {
                                ?>menu--active<?php
                            } ?>" href="javascript:;">
                                <div class="menu__icon">
                                    <i data-tw-merge="" data-lucide="users" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="menu__title">
                                    Users
                                    <div class="menu__sub-icon ">
                                        <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                                    </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a class="menu" href="/view-employees">
                                        <div class="menu__icon">
                                            <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                        </div>
                                        <div class="menu__title">
                                            Employees
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="menu" href="/view-job-seekers">
                                        <div class="menu__icon">
                                            <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                        </div>
                                        <div class="menu__title">
                                            Job Seekers
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="menu" href="/view-users">
                                        <div class="menu__icon">
                                            <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                        </div>
                                        <div class="menu__title">
                                            Others
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <li>
                        <a class="menu
                    <?php if ($_SERVER["REQUEST_URI"] === "feedback" || str_contains($_SERVER["REQUEST_URI"], "feedback")) {
                            ?>menu--active<?php
                        } ?>" href="/feedback">
                            <div class="menu__icon">
                                <i data-tw-merge="" data-lucide="message-square" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="menu__title">
                                Feedback
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="menu
                    <?php if ($_SERVER["REQUEST_URI"] === "view-applications" || str_contains($_SERVER["REQUEST_URI"], "application")) {
                            ?>menu--active<?php
                        } ?>" href="/view-applications">
                            <div class="menu__icon">
                                <i data-tw-merge="" data-lucide="file-text" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="menu__title">
                                Applications
                            </div>
                        </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <a class="menu
                    <?php if ($_SERVER["REQUEST_URI"] === "profile-setup") {
                            ?>menu--active<?php
                        } ?>" href="/profile-setup">
                            <div class="menu__icon">
                                <i data-tw-merge="" data-lucide="user" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="menu__title">
                                Profile Setup
                            </div>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="menu__divider my-6"></li>
                <li>
                    <a class="menu
                    <?php if ($_SERVER["REQUEST_URI"] === "view-profile" || $_SERVER["REQUEST_URI"] === "change-password" || str_contains($_SERVER["REQUEST_URI"], "profile")) {
                        ?>menu--active<?php
                    } ?>" href="javascript:;">
                        <div class="menu__icon">
                            <i data-tw-merge="" data-lucide="user" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                        <div class="menu__title">
                            Profile
                            <div class="menu__sub-icon ">
                                <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a class="menu" href="/view-profile">
                                <div class="menu__icon">
                                    <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="menu__title">
                                    My Profile
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="menu" href="/change-password">
                                <div class="menu__icon">
                                    <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="menu__title">
                                    Change Password
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="menu menu--active" href="/logout">
                        <div class="menu__icon">
                            <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                        <div class="menu__title">
                            Logout
                        </div>
                    </a>
                </li>
                <!-- END: First Child -->
            </ul>
        </div>
    </div>
    <!-- END: Mobile Menu -->
    <div class="mt-[4.7rem] flex overflow-hidden md:mt-0">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav z-10 hidden overflow-x-hidden px-5 pb-16 md:block md:w-[100px] xl:w-[250px]">
            <a class="intro-x mt-3 flex items-center pl-5 pt-4" href="#">
                <img class="w-6" src="dist/images/logo.svg" alt="Career Portal">
                <span class="ml-3 hidden text-lg text-white xl:block">
                        Career Portal
                    </span>
            </a>
            <div class="side-nav__divider my-6"></div>
            <ul>
                <li>
                    <a href="/dashboard" class="side-menu
                    <?php if ($_SERVER["REQUEST_URI"] === "dashboard" || str_contains($_SERVER["REQUEST_URI"], "dashboard")) {
                        ?>side-menu--active<?php
                    } ?>">
                        <div class="side-menu__icon">
                            <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                        <div class="side-menu__title">
                            Dashboard
                        </div>
                    </a>
                </li>
                <?php
                if ($user_level < "3" && !empty($user_profile)) {
                    ?>
                    <li>
                        <a href="javascript:;" class="side-menu
                    <?php if ($_SERVER["REQUEST_URI"] === "employment-posts" || $_SERVER["REQUEST_URI"] === "internship-posts" || str_contains($_SERVER["REQUEST_URI"], "post")) {
                            ?>side-menu--active<?php
                        }
                        ?>">
                            <div class="side-menu__icon">
                                <i data-tw-merge="" data-lucide="trello" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="side-menu__title">
                                Job Posts
                                <div class="side-menu__sub-icon ">
                                    <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="/employment-posts" class="side-menu">
                                    <div class="side-menu__icon">
                                        <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                    </div>
                                    <div class="side-menu__title">
                                        Employment Posts
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="/internship-posts" class="side-menu">
                                    <div class="side-menu__icon">
                                        <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                    </div>
                                    <div class="side-menu__title">
                                        Internship Posts
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if ($user_level < "3") {
                        ?>
                        <li>
                            <a href="javascript:;" class="side-menu
                        <?php if ($_SERVER["REQUEST_URI"] === "view-users-employees" || $_SERVER["REQUEST_URI"] === "view-users-job-seekers" || $_SERVER["REQUEST_URI"] === "view-users" || str_contains($_SERVER["REQUEST_URI"], "user")) {
                                ?>side-menu--active<?php
                            } ?>">
                                <div class="side-menu__icon">
                                    <i data-tw-merge="" data-lucide="users" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="side-menu__title">
                                    Users
                                    <div class="side-menu__sub-icon ">
                                        <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                                    </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="/view-employers" class="side-menu">
                                        <div class="side-menu__icon">
                                            <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                        </div>
                                        <div class="side-menu__title">
                                            Employers
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/view-job-seekers" class="side-menu">
                                        <div class="side-menu__icon">
                                            <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                        </div>
                                        <div class="side-menu__title">
                                            Job Seekers
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/view-users" class="side-menu">
                                        <div class="side-menu__icon">
                                            <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                        </div>
                                        <div class="side-menu__title">
                                            Others
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <li>
                        <a href="/feedback" class="side-menu
                    <?php if ($_SERVER["REQUEST_URI"] === "feedback" || str_contains($_SERVER["REQUEST_URI"], "feedback")) {
                            ?>side-menu--active<?php
                        } ?>">
                            <div class="side-menu__icon">
                                <i data-tw-merge="" data-lucide="message-square" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="side-menu__title">
                                Feedback
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/view-applications" class="side-menu
                    <?php if ($_SERVER["REQUEST_URI"] === "view-applications" || str_contains($_SERVER["REQUEST_URI"], "application")) {
                            ?>side-menu--active<?php
                        } ?>">
                            <div class="side-menu__icon">
                                <i data-tw-merge="" data-lucide="file-text" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="side-menu__title">
                                Applications
                            </div>
                        </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <a href="/profile-setup" class="side-menu
                        <?php if ($_SERVER["REQUEST_URI"] === "profile-setup") {
                            ?>side-menu--active<?php
                        } ?>">
                            <div class="side-menu__icon">
                                <i data-tw-merge="" data-lucide="user" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="side-menu__title">
                                Profile Setup
                            </div>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="side-nav__divider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu
                    <?php if ($_SERVER["REQUEST_URI"] === "view-profile" || $_SERVER["REQUEST_URI"] === "change-password" || str_contains($_SERVER["REQUEST_URI"], "profile")) {
                        ?>side-menu--active<?php
                    } ?>">
                        <div class="side-menu__icon">
                            <i data-tw-merge="" data-lucide="user" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                        <div class="side-menu__title">
                            Profile
                            <div class="side-menu__sub-icon ">
                                <i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="/view-profile" class="side-menu">
                                <div class="side-menu__icon">
                                    <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="side-menu__title">
                                    My Profile
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/change-password" class="side-menu">
                                <div class="side-menu__icon">
                                    <i data-tw-merge="" data-lucide="activity" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="side-menu__title">
                                    Change Password
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/logout" class="side-menu">
                        <div class="side-menu__icon">
                            <i data-tw-merge="" data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                        </div>
                        <div class="side-menu__title">
                            Logout
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="rounded-[30px] md:rounded-[35px/50px_0px_0px_0px] min-w-0 min-h-screen max-w-full md:max-w-none bg-slate-100 flex-1 pb-10 px-4 md:px-6 relative md:ml-4 dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block after:content-[''] after:z-[-1] after:rounded-[40px_0px_0px_0px] after:w-full after:inset-y-0 after:absolute after:left-0 after:bg-white/10 after:mt-8 after:-ml-4 after:dark:bg-darkmode-400/50 after:hidden md:after:block">
            <?php include 'alerts.php'; ?>
            <!-- BEGIN: Top Bar -->
            <div class="relative z-[51] flex h-[67px] items-center border-b border-slate-200">
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="flex -intro-x mr-auto hidden sm:flex">
                    <ol class="flex items-center text-theme-1 dark:text-slate-300">
                        <li class="">
                            <a href="#">Application</a>
                        </li>
                        <li class="relative ml-5 pl-0.5 before:content-[''] before:w-[14px] before:h-[14px] before:bg-chevron-black before:transform before:rotate-[-90deg] before:bg-[length:100%] before:-ml-[1.125rem] before:absolute before:my-auto before:inset-y-0 dark:before:bg-chevron-white text-slate-800 cursor-text dark:text-slate-400">
                            <a href="#"><?= ucwords(str_replace(["/", "-"], " ", $_SERVER["REQUEST_URI"])) ?></a>
                        </li>
                    </ol>
                </nav>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Notifications -->
                <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative intro-x mr-auto sm:mr-6">
                    <div data-tw-toggle="dropdown" aria-expanded="false"
                         class="cursor-pointer relative block text-slate-600 outline-none before:absolute before:right-0 before:top-[-2px] before:h-[8px] before:w-[8px] before:rounded-full before:bg-danger before:content-['']">
                        <i data-tw-merge="" data-lucide="bell" class="stroke-1.5 w-5 h-5 dark:text-slate-500"></i></div>
                    <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150"
                         data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1"
                         data-enter-to="!mt-1 visible opacity-100 translate-y-0"
                         data-leave="transition-all ease-linear duration-150"
                         data-leave-from="!mt-1 visible opacity-100 translate-y-0"
                         data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1"
                         class="dropdown-menu absolute z-[9999] hidden">
                        <div data-tw-merge=""
                             class="dropdown-content rounded-md border-transparent bg-white shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 mt-2 w-[280px] p-5 sm:w-[350px]">
                            <div class="mb-5 font-medium">Notifications</div>
                            <div class="cursor-pointer relative flex items-center">
                                <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                                    <img class="rounded-full" src="dist/images/fakers/profile-5.jpg"
                                         alt="Better Career Platform">
                                    <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a class="mr-5 truncate font-medium" href="#">
                                            Al Pacino
                                        </a>
                                        <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                            01:10 PM
                                        </div>
                                    </div>
                                    <div class="mt-0.5 w-full truncate text-slate-500">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500
                                    </div>
                                </div>
                            </div>
                            <div class="cursor-pointer relative flex items-center mt-5">
                                <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                                    <img class="rounded-full" src="dist/images/fakers/profile-9.jpg"
                                         alt="Better Career Platform">
                                    <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a class="mr-5 truncate font-medium" href="#">
                                            Arnold Schwarzenegger
                                        </a>
                                        <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                            01:10 PM
                                        </div>
                                    </div>
                                    <div class="mt-0.5 w-full truncate text-slate-500">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Notifications  -->
                <!-- BEGIN: Account Menu -->
                <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative">
                    <button data-tw-toggle="dropdown" aria-expanded="false"
                            class="cursor-pointer image-fit zoom-in intro-x block h-8 w-8 overflow-hidden rounded-full shadow-lg">
                        <img src="dist/images/fakers/profile-9.jpg" alt="Better Career Platform">
                    </button>
                    <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150"
                         data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1"
                         data-enter-to="!mt-1 visible opacity-100 translate-y-0"
                         data-leave="transition-all ease-linear duration-150"
                         data-leave-from="!mt-1 visible opacity-100 translate-y-0"
                         data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1"
                         class="dropdown-menu absolute z-[9999] hidden">
                        <div data-tw-merge=""
                             class="dropdown-content rounded-md border-transparent p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 mt-px w-56 bg-theme-1 text-white">
                            <div class="p-2 font-medium font-normal">
                                <div class="font-medium">Al Pacino</div>
                                <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">
                                    Backend Engineer
                                </div>
                            </div>
                            <div class="h-px my-2 -mx-2 bg-slate-200/60 dark:bg-darkmode-400 bg-white/[0.08]">
                            </div>
                            <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i
                                        data-tw-merge="" data-lucide="user" class="stroke-1.5 mr-2 h-4 w-4"></i>
                                Profile</a>
                            <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i
                                        data-tw-merge="" data-lucide="lock" class="stroke-1.5 mr-2 h-4 w-4"></i>
                                Change Password</a>
                            <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i
                                        data-tw-merge="" data-lucide="help-circle" class="stroke-1.5 mr-2 h-4 w-4"></i>
                                Help</a>
                            <div class="h-px my-2 -mx-2 bg-slate-200/60 dark:bg-darkmode-400 bg-white/[0.08]">
                            </div>
                            <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i
                                        data-tw-merge="" data-lucide="toggle-right" class="stroke-1.5 mr-2 h-4 w-4"></i>
                                Logout</a>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
            <?= $this->renderSection("content") ?>
        </div>
        <!-- END: Content -->
    </div>
</div>
<script>
    document.getElementById('form').addEventListener('submit', function () {
        const submitButton = document.getElementById('submit');
        submitButton.innerHTML = 'Submitting...';
        submitButton.disabled = true;
    });
</script>
<!-- BEGIN: Vendor JS Assets-->
<script src="dist/js/vendors/dom.js"></script>
<script src="dist/js/vendors/tailwind-merge.js"></script>
<script src="dist/js/vendors/dropzone.js"></script>
<script src="dist/js/vendors/tom-select.js"></script>
<script src="dist/js/vendors/ckeditor/inline.js"></script>
<script src="dist/js/vendors/highlight.js"></script>
<script src="dist/js/vendors/lucide.js"></script>
<script src="dist/js/vendors/tippy.js"></script>
<script src="dist/js/vendors/dayjs.js"></script>
<script src="dist/js/vendors/litepicker.js"></script>
<script src="dist/js/vendors/popper.js"></script>
<script src="dist/js/vendors/dropdown.js"></script>
<script src="dist/js/vendors/tiny-slider.js"></script>
<script src="dist/js/vendors/transition.js"></script>
<script src="dist/js/vendors/chartjs.js"></script>
<script src="dist/js/vendors/leaflet-map.js"></script>
<script src="dist/js/vendors/axios.js"></script>
<script src="dist/js/utils/colors.js"></script>
<script src="dist/js/utils/helper.js"></script>
<script src="dist/js/vendors/simplebar.js"></script>
<script src="dist/js/vendors/modal.js"></script>
<script src="dist/js/components/base/inline-editor.js"></script>
<script src="dist/js/components/base/tom-select.js"></script>
<script src="dist/js/components/base/dropzone.js"></script>
<script src="dist/js/components/base/theme-color.js"></script>
<script src="dist/js/components/base/lucide.js"></script>
<script src="dist/js/components/base/tippy.js"></script>
<script src="dist/js/components/base/litepicker.js"></script>
<script src="dist/js/components/report-line-chart.js"></script>
<script src="dist/js/components/report-pie-chart.js"></script>
<script src="dist/js/components/report-donut-chart.js"></script>
<script src="dist/js/components/report-donut-chart-1.js"></script>
<script src="dist/js/components/simple-line-chart-1.js"></script>
<script src="dist/js/components/base/tiny-slider.js"></script>
<script src="dist/js/themes/tinker.js"></script>
<script src="dist/js/components/base/leaflet-map-loader.js"></script>
<script src="dist/js/components/mobile-menu.js"></script>
<script src="dist/js/components/themes/tinker/top-bar.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css " rel="stylesheet">
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js "></script>
<!-- END: Vendor JS Assets-->
<!-- BEGIN: Pages, layouts, components JS Assets-->
<!-- END: Pages, layouts, components JS Assets-->
</body>
</html>