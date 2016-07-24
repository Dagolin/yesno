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
    </style>
@endsection

@section('content')
    <main class="mdl-layout__content">
        <div class="mdl-grid portfolio-max-width portfolio-contact">
            <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Login</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <p>
                        Excepteur reprehenderit sint exercitation ipsum consequat qui sit id velit elit. Velit anim eiusmod labore sit amet.
                    </p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                                <!-- email -->
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="email" name="email" id="email" required value="{{ old('email') }}">
                            <label class="mdl-textfield__label" for="email">your mail address</label>
                            <span class="mdl-textfield__error">a valid mail</span>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif

                                    <!-- password -->
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" name="password" id="password" required>
                                <label class="mdl-textfield__label" for="password">your pass ( at least 6 words)</label>
                                <span class="mdl-textfield__error">Required</span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif


                                        <!-- remember me -->
                                <div class="mdl-textfield">
                                    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="remember">
                                        <input type="checkbox" name="remember" id="remember" class="mdl-switch__input">
                                        <span class="mdl-switch__label">Remember me</span>
                                    </label>
                                </div>



                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--1-col">
                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                                        Login
                                    </button>
                                </div>
                                <div class="mdl-layout-spacer"></div>
                                <div class="mdl-cell mdl-cell--2-col">
                                    <a href="register">
                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary" type="button">
                                            Sign up
                                        </button>
                                    </a>
                                </div>
                            </div>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
