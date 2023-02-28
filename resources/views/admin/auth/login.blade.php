<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('backend/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Effects Tech">
    <title>Admin Login</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="login">
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <div class="my-auto">
                <x-logo width="400" height="135" class="-intro-x w-1/2 -mt-16"></x-logo>
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                    Sign in to Dashboard.
                </div>
            </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div
                class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Sign In
                </h2>
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="intro-x mt-8">
                        <input type="email" name="email" class="intro-x login__input input input--lg border border-gray-300 block"
                               placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="border cols-3 rounded-md mt-4">
                            <input type="password" name="password" id="password" placeholder="Enter Password"
                                   class="text-black focus:outline-none input w-10/12 is-minimal input--lg text-sm">
                            <button onclick="showPassword()" type="button"
                                    class="ml-2 focus:outline-none text-2xs font-bold text-grey">Show
                            </button>
                        </div>
{{--                        <input type="password" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4"--}}
{{--                               placeholder="Password">--}}
                    </div>
                    <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input type="checkbox" class="input border mr-2" id="remember-me">
                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <a href="{{ route('admin.password.request') }}">Reset Password</a>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<!-- BEGIN: JS Assets-->
<script src="{{ asset('backend/js/main.js') }}"></script>
<!-- END: JS Assets-->
</body>
</html>
