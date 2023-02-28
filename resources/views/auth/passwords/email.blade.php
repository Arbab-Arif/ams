<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('backend/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Effects Tech">
    <title>Employee Login</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}"/>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="login">
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="" class="-intro-x flex items-center pt-5">
                <img alt="AMS Dashboard" class="w-6" src="{{ asset('backend/images/logo.svg') }}">
                <span class="text-white text-lg ml-3"> Mid<span class="font-medium">One</span> </span>
            </a>
            <div class="my-auto">
                <img alt="AMS Dashboard" class="-intro-x w-1/2 -mt-16" src="{{ asset('backend/images/logo.svg') }}">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                    Sign in to Employee Dashboard.
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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="intro-x mt-8">
                        <input type="email" name="email" class="intro-x login__input input input--lg border border-gray-300 block"
                               placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="button button--lg w-full text-white bg-theme-1 xl:mr-3 align-top">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>

<!-- BEGIN: JS Assets-->
<script src="{{ asset('backend/js/main.js') }}"></script>
<!-- END: JS Assets-->
</body>
</html>
