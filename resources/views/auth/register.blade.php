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
        <div class="mdl-grid portfolio-max-width portfolio-contact">
            <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Register</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <p>
                        Excepteur reprehenderit sint exercitation ipsum consequat qui sit id velit elit. Velit anim eiusmod labore sit amet.
                    </p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                                <!-- name -->
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="name" id="name" required>
                            <label class="mdl-textfield__label" for="name">Name...</label>
                            <span class="mdl-textfield__error">Required</span>
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

                                    <!-- email -->
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email" name="email" id="email" required>
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

                                            <!-- password confirm-->
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="password" name="password_confirmation" id="password_confirmation" required>
                                        <label class="mdl-textfield__label" for="password_confirmation">your pass again</label>
                                        <span class="mdl-textfield__error">Required</span>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                    @endif

                                    <p>
                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                                            Register
                                        </button>
                                    </p>
                    </form>
                </div>
            </div>
        </div>
@endsection
