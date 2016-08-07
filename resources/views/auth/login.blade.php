@extends('layouts.app')

@section('header')
    <style>
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
    </style>
@endsection

@section('content')
    <div class="mdl-grid portfolio-max-width portfolio-contact">
        <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Sign in</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <p>
                    Sign in to make new votes, see if the others agree with you.
                </p>
            </div>
            <div class="mdl-grid mdl-typography--text-center">
                <!-- facebook -->

                <div class="mdl-cell mdl-cell--7-col mdl-card mdl-shadow--4dp">
                    <a href="/redirect">
                        <img src="{!! asset('images/FB-f-Logo__blue_512.png') !!}"
                             style="height: 100%; width: 100%;">
                    </a>
                    <div class="mdl-card__title">
                        Sign in with Facebook
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
