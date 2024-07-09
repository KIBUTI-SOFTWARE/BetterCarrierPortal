<?= $this->extend('Layouts/main_welcome.php') ?>
<?= $this->section('content') ?>
<div class="p-3 sm:px-8 relative h-screen lg:overflow-hidden bg-primary xl:bg-white dark:bg-darkmode-800 xl:dark:bg-darkmode-600 before:hidden before:xl:block before:content-[''] before:w-[57%] before:-mt-[28%] before:-mb-[16%] before:-ml-[13%] before:absolute before:inset-y-0 before:left-0 before:transform before:rotate-[-4.5deg] before:bg-primary/20 before:rounded-[100%] before:dark:bg-darkmode-400 after:hidden after:xl:block after:content-[''] after:w-[57%] after:-mt-[20%] after:-mb-[13%] after:-ml-[13%] after:absolute after:inset-y-0 after:left-0 after:transform after:rotate-[-4.5deg] after:bg-primary after:rounded-[100%] after:dark:bg-darkmode-700">
    <?php include 'Layouts/alerts.php'; ?>
    <div class="container relative z-10 sm:px-10">
        <div class="block grid-cols-2 gap-4 xl:grid">
            <!-- BEGIN: Register Info -->
            <div class="hidden min-h-screen flex-col xl:flex">
                <a class="-intro-x flex items-center pt-5" href="#">
                    <img class="w-6" src="dist/images/logo.svg" alt="carrier portal">
                    <span class="ml-3 text-lg text-white"><?=$_ENV["system_name"]?> </span>
                </a>
                <div class="my-auto">
                    <img class="-intro-x -mt-16 w-1/2" src="dist/images/phone-illustration.svg"
                         alt="Midone - Tailwind Admin Dashboard Template">
                    <div class="-intro-x mt-10 text-4xl font-medium leading-tight text-white">
                        A few more clicks to <br>
                        create your account.
                    </div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->

            <div class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
                <div class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                    <h2 class="intro-x text-center text-2xl font-bold xl:text-left xl:text-3xl">
                        Sign Up
                    </h2>
                    <div class="intro-x mt-2 text-center text-slate-400 dark:text-slate-400 xl:hidden">
                        A few more clicks to create your account.
                    </div>
                    <form name="register" action="/register" method="post" enctype="multipart/form-data">
                        <?php
                        $session = session();
                        $form_data = $session->getFlashdata('form_data');
                        ?>
                        <div class="intro-x mt-8">
                            <label for="user-firstname"></label>
                            <input data-tw-merge="" type="text" id="user-firstname" name="user_firstname" required
                                   placeholder="First Name"
                                   value="<?= $form_data['user_firstname'] ?? '' ?>"
                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x block min-w-full px-4 py-3 xl:min-w-[350px]">
                            <label for="user_lastname"></label>
                            <input data-tw-merge="" type="text" id="user_lastname" name="user_lastname" required
                                   placeholder="Last Name"
                                   value="<?= $form_data['user_lastname'] ?? '' ?>"
                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]">
                            <label for="user_email"></label>
                            <input data-tw-merge="" type="email" id="user_email" name="user_email" required
                                   placeholder="Email"
                                   value="<?= $form_data['user_email'] ?? '' ?>"
                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]">
                            <label for="user_phone"></label>
                            <input data-tw-merge="" type="text" id="user_phone" name="user_phone" required
                                   maxlength="10"
                                   minlength="10" placeholder="Phone"
                                   value="<?= $form_data['user_phone'] ?? '' ?>"
                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]">
                            <label>
                                <select data-placeholder="Please Select Your Account Type"
                                        name="user_level"
                                        required
                                        class="tom-select w-full disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]">>
                                    <option disabled>Please Select Your Account Type</option>
                                    <option value="4">Job Seeker</option>
                                    <option value="3">Employer</option>
                                </select>
                            </label>
                            <label for="password"></label>
                            <input data-tw-merge="" type="password" id="password" name="user_password" required
                                   placeholder="Password"
                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]">
                            <label for="confirmPassword"></label>
                            <input data-tw-merge="" type="password" id="confirmPassword" name="confirm_password"
                                   required
                                   placeholder="Password Confirmation"
                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]">
                            <br>
                            <div id="errorMessages" class="text-danger text-center"></div>
                        </div>
                        <div class="intro-x mt-4 flex items-center text-xs text-slate-600 dark:text-slate-500 sm:text-sm">
                            <input data-tw-merge="" type="checkbox"
                                   class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50 mr-2 border"
                                   id="remember-me"
                                   required>
                            <label class="cursor-pointer select-none" for="remember-me">
                                I agree to the Better Carrier Portal's
                            </label>
                            <a class="ml-1 text-primary dark:text-slate-200" href="#">
                                Terms of use &amp;</a>
                            <a class="ml-1 text-primary dark:text-slate-200"> Privacy Policy</a>.
                        </div>
                        <div class="intro-x mt-5 text-center xl:mt-8 xl:text-left">
                            <button data-tw-merge="" type="submit"
                                    id="submit"
                                    onclick="validatePassword()"
                                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary w-full px-4 py-3 align-top xl:mr-3 xl:w-32">
                                Register
                            </button>
                        </div>
                    </form>
                    <p class="text-center cursor-pointer select-none">Already have an account? <a
                                class="ml-1 text-primary dark:text-slate-200" href="/login">Login Here!</a></p>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('submit').disabled = true; // Disable the button by default
    });

    function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

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
    document.getElementById('password').addEventListener('input', validatePassword);
    document.getElementById('confirmPassword').addEventListener('input', validatePassword);
</script>
<?= $this->endSection('content') ?>
