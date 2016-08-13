@extends('layouts.app')

@section('header')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .mdl-login-card {
            max-width: 400px;
            margin: auto;
        }
        .mdl-button--file input {
            cursor: pointer;
            height: 100%;
            right: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 300px;
            z-index: 4;
        }

        .mdl-textfield--file .mdl-textfield__input {
            box-sizing: border-box;
            width: calc(100% - 32px);
        }
        .mdl-textfield--file .mdl-button--file {
            right: 0;
        }

        .portfolio-max-width {
            max-width: 900px;
            margin: auto;
        }

        .portfolio-contact .mdl-textfield {
            width: 100%;
        }
        .login-fb {
            background: url({!! asset('images/FB-f-Logo__blue_512.png') !!}) center / cover;";
        max-width: 350px;
            max-height: 350px;
        }

        .mdl-button-login {
            width: 200px;
        }
    </style>
@endsection

@section('content')
    <div class="mdl-grid portfolio-max-width portfolio-contact">
        <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp mdl-login-card">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Sign in</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <p>
                    Sign in to make new votes, see if the others agree with you.
                </p>
            </div>
            <div class="mdl-typography--text-center">
                <!-- Facebook -->
                <p>
                    <a href="/redirect/facebook" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button-login"
                       style="background-color: #3b5998; color:rgb(255, 255, 255)">
                        <i class="fa fa-facebook fa-fw"></i> Sign in with Facebook
                    </a>
                </p>
                <p>
                    <!-- Google+ -->
                    <a href="/redirect/google"
                       class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button-login"
                       style="background-color: #e93f2e; color:rgb(255, 255, 255)">
                        <i class="fa fa-google-plus fa-fw"></i> Sign in with Google
                    </a>
                </p>
                <p></p>
                <p></p>
            </div>
        </div>
    </div>
@endsection
