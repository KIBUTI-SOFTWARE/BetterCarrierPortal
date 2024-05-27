<?php
$session = session();
$user = $session->get("user");
$user_profile = json_decode($user["user_profile"], true);
$user_level = $user["user_level"];
?>
<?= $this->extend('Layouts/main_dashboard.php') ?>
<?= $this->section('content') ?>
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box mt-5 py-10 sm:py-20">
    <div class="relative flex flex-col justify-center px-5 before:absolute before:bottom-0 before:top-0 before:mt-4 before:hidden before:h-[3px] before:w-[69%] before:bg-slate-100 before:dark:bg-darkmode-400 sm:px-20 lg:flex-row before:lg:block">
        <!-- Step 1 -->
        <div class="intro-x z-10 flex flex-1 items-center lg:block lg:text-center">
            <button data-tw-merge=""
                    class="step-indicator active transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary h-10 w-10 rounded-full">
                1
            </button>
            <div class="step-label ml-3 text-base font-medium lg:mx-auto lg:mt-3 lg:w-32">
                Personal Information
            </div>
        </div>
        <?php
        if ($user_level === "3") {
            ?>
            <!-- Step 2 -->
            <div class="intro-x z-10 mt-5 flex flex-1 items-center lg:mt-0 lg:block lg:text-center">
                <button data-tw-merge=""
                        class="step-indicator transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 h-10 w-10 rounded-full">
                    2
                </button>
                <div class="step-label ml-3 text-base text-slate-600 dark:text-slate-400 lg:mx-auto lg:mt-3 lg:w-32">
                    Professional Information
                </div>
            </div>
            <!-- Step 3 -->
            <div class="intro-x z-10 mt-5 flex flex-1 items-center lg:mt-0 lg:block lg:text-center">
                <button data-tw-merge=""
                        class="step-indicator transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 h-10 w-10 rounded-full">
                    3
                </button>
                <div class="step-label ml-3 text-base text-slate-600 dark:text-slate-400 lg:mx-auto lg:mt-3 lg:w-32">
                    Company Information
                </div>
            </div>
            <!-- Step 4 -->
            <div class="intro-x z-10 mt-5 flex flex-1 items-center lg:mt-0 lg:block lg:text-center">
                <button data-tw-merge=""
                        class="step-indicator transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 h-10 w-10 rounded-full">
                    4
                </button>
                <div class="step-label ml-3 text-base text-slate-600 dark:text-slate-400 lg:mx-auto lg:mt-3 lg:w-32">
                    Finalizing
                </div>
            </div>
            <?php
        } else if ($user_level === "4") {
            ?>
            <!-- Step 2 -->
            <div class="intro-x z-10 mt-5 flex flex-1 items-center lg:mt-0 lg:block lg:text-center">
                <button data-tw-merge=""
                        class="step-indicator transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 h-10 w-10 rounded-full">
                    2
                </button>
                <div class="step-label ml-3 text-base text-slate-600 dark:text-slate-400 lg:mx-auto lg:mt-3 lg:w-32">
                    Professional Information
                </div>
            </div>
            <!-- Step 3 -->
            <div class="intro-x z-10 mt-5 flex flex-1 items-center lg:mt-0 lg:block lg:text-center">
                <button data-tw-merge=""
                        class="step-indicator transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 h-10 w-10 rounded-full">
                    3
                </button>
                <div class="step-label ml-3 text-base text-slate-600 dark:text-slate-400 lg:mx-auto lg:mt-3 lg:w-32">
                    Finalizing
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <!-- Form Parts -->
    <div class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20">
        <form name="profile-setup" class="" action="/" method="post">
            <!-- Step 1 Form Part -->
            <div class="form-part" id="form-part-1">
                <div class="text-base font-medium">Your Personal Profile</div>
                <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-1"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            First Name
                        </label>
                        <input data-tw-merge="" required id="input-wizard-1" type="text"
                               placeholder="Your Firstname"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-1"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Last Name
                        </label>
                        <input data-tw-merge="" required id="input-wizard-1" type="text"
                               placeholder="Your Last Name"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-1"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Sur Name
                        </label>
                        <input data-tw-merge="" required id="input-wizard-1" type="text"
                               placeholder="Your Surname"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-1"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Email
                        </label>
                        <input data-tw-merge="" required id="input-wizard-1" type="email"
                               placeholder="example@gmail.com"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-2"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Phone
                        </label>
                        <input data-tw-merge="" id="input-wizard-2" type="text" placeholder="07xxxxxxxx"
                               required maxlength="10" minlength="10"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-3"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Date of Birth
                        </label>
                        <input data-tw-merge type="text" data-single-mode="true"
                               id="input-wizard-3" required
                               class="form-input w-full disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 datepicker "/>
                    </div>
                </div>
            </div>
            <!-- Step 2 Form Part -->
            <div class="form-part hidden" id="form-part-2">
                <div class="text-base font-medium">Professional Details</div>
                <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-5"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            What is your working experience (Highlight your Key Achievements)?
                        </label>
                        <textarea data-tw-merge="" id="input-wizard-5" type="text" placeholder="Business Name"
                                  class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                        </textarea>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-6"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Business Address
                        </label>
                        <input data-tw-merge="" id="input-wizard-6" type="text" placeholder="Business Address"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                </div>
            </div>
            <!-- Step 3 Form Part -->
            <div class="form-part hidden" id="form-part-3">
                <div class="text-base font-medium">Business Details</div>
                <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-5"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Business Name
                        </label>
                        <input data-tw-merge="" id="input-wizard-5" type="text" placeholder="Business Name"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label data-tw-merge="" for="input-wizard-6"
                               class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                            Business Address
                        </label>
                        <input data-tw-merge="" id="input-wizard-6" type="text" placeholder="Business Address"
                               class="form-input transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                </div>
            </div>
            <!-- Additional Form Parts can be added here -->
            <div class="intro-y col-span-12 mt-5 flex items-center justify-center sm:justify-end">
                <button data-tw-merge="" type="button"
                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 dark:bg-darkmode-400 dark:text-slate-300 [&:hover:not(:disabled)]:bg-slate-100 [&:hover:not(:disabled)]:border-slate-100 [&:hover:not(:disabled)]:dark:border-darkmode-300/80 [&:hover:not(:disabled)]:dark:bg-darkmode-300/80 w-24"
                        id="back">
                    Back
                </button>
                <button data-tw-merge="" type="button"
                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary ml-2 w-24"
                        id="next">
                    Next
                </button>
            </div>
        </form>
    </div>
</div>
<!-- END: Wizard Layout -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const steps = document.querySelectorAll('.step-indicator');
        const labels = document.querySelectorAll('.step-label');
        const formParts = document.querySelectorAll('.form-part');
        const backBtn = document.getElementById('back');
        const nextBtn = document.getElementById('next');
        let currentStep = 0;

        const passedStepClasses = '[&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary';

        function updateStep(step) {
            steps.forEach((indicator, index) => {
                if (index <= step) {
                    indicator.classList.add('active');
                    labels[index].classList.add('active');
                    indicator.classList.add(...passedStepClasses.split(' '));
                } else {
                    indicator.classList.remove('active');
                    labels[index].classList.remove('active');
                    indicator.classList.remove(...passedStepClasses.split(' '));
                }
            });
            formParts.forEach((part, index) => {
                if (index === step) {
                    part.classList.remove('hidden');
                } else {
                    part.classList.add('hidden');
                }
            });

            if (step === steps.length - 1) {
                nextBtn.textContent = 'Submit';
            } else {
                nextBtn.textContent = 'Next';
            }
        }

        function validateFormPart() {
            const currentFormPart = formParts[currentStep];
            const inputs = currentFormPart.querySelectorAll('input[required], input:not([required])');
            let valid = true;

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.classList.add('invalid');
                    valid = false;
                } else {
                    input.classList.remove('invalid');
                }
            });

            return valid;
        }

        backBtn.addEventListener('click', function (event) {
            event.preventDefault();
            if (currentStep > 0) {
                currentStep--;
                updateStep(currentStep);
            }
        });

        nextBtn.addEventListener('click', function (event) {
            event.preventDefault();
            if (currentStep < steps.length - 1) {
                if (validateFormPart()) {
                    currentStep++;
                    updateStep(currentStep);
                }
            } else {
                if (validateFormPart()) {
                    // Handle form submission
                    document.querySelector('form').submit();
                }
            }
        });

        updateStep(currentStep);
    });

</script>
<?= $this->endSection('content') ?>

