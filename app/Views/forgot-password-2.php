<?= $this->extend('Layouts/main_welcome.php') ?>
<?= $this->section('content') ?>
<div class="p-3 sm:px-8 relative h-screen lg:overflow-hidden bg-primary xl:bg-white dark:bg-darkmode-800 xl:dark:bg-darkmode-600 before:hidden before:xl:block before:content-[''] before:w-[57%] before:-mt-[28%] before:-mb-[16%] before:-ml-[13%] before:absolute before:inset-y-0 before:left-0 before:transform before:rotate-[-4.5deg] before:bg-primary/20 before:rounded-[100%] before:dark:bg-darkmode-400 after:hidden after:xl:block after:content-[''] after:w-[57%] after:-mt-[20%] after:-mb-[13%] after:-ml-[13%] after:absolute after:inset-y-0 after:left-0 after:transform after:rotate-[-4.5deg] after:bg-primary after:rounded-[100%] after:dark:bg-darkmode-700">
    <div class="container relative z-10 sm:px-10">
        <div class="block grid-cols-2 gap-4 xl:grid">
            <!-- BEGIN: Recover password 2 Info -->
            <div class="hidden min-h-screen flex-col xl:flex">
                <a class="-intro-x flex items-center pt-5" href="#">
                    <img class="w-6" src="dist/images/logo.svg" alt="carrier portal">
                    <span class="ml-3 text-lg text-white"> Carrier Portal </span>
                </a>
                <div class="my-auto">
                    <img class="-intro-x -mt-16 w-1/2" src="dist/images/phone-illustration.svg"
                         alt="Midone - Tailwind Admin Dashboard Template">
                    <div class="-intro-x mt-10 text-4xl font-medium leading-tight text-white">
                        A few more clicks to <br>
                        recover your password.
                    </div>
                </div>
            </div>
            <!-- END: Recover password 2 Info -->
            <!-- BEGIN: Recover password 2 Form -->
            <div class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
                <div class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                    <h2 class="intro-x text-center text-2xl font-bold xl:text-left xl:text-3xl">
                        Password Recovery (Step 2/3)
                    </h2>
                    <div class="intro-x mt-2 text-center text-slate-400 ">
                        <p>Please Enter the OTP sent to +255745377504.</p>
                    </div>
                    <form name="password-recovery-2" action="/password-recovery-2" method="post" enctype="multipart/form-data">
                        <div class="intro-x mt-8">
                            <label for="otp"></label>
                            <input data-tw-merge="" id="otp" name="otp" type="text" required
                                   placeholder="OTP" maxlength="6" minlength="6"
                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x block min-w-full px-4 py-3 xl:min-w-[350px]">
                        </div>
                        <div class="intro-x mt-5 text-center xl:mt-8 xl:text-left">
                            <button data-tw-merge="" type="submit"
                                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary w-full px-4 py-3 align-top xl:mr-3 xl:w-32">
                                Continue
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Recover password 2 Form -->
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>
