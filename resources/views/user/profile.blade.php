@extends('layouts.app')

@section('header')
    <style>
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
                    <h2 class="mdl-card__title-text">Profile</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <p>
                        Excepteur reprehenderit sint exercitation ipsum consequat qui sit id velit elit. Velit anim eiusmod labore sit amet.
                    </p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('user/profile') }}">
                        {{ csrf_field() }}
                                <!-- name -->
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="name" name="name" id="name" required value="{{ $user->name }}">
                            <label class="mdl-textfield__label" for="name">your name</label>
                            <span class="mdl-textfield__error">required</span>
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

                        <!-- email -->
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="email" name="email" id="email" required value="{{ $user->email }}">
                            <label class="mdl-textfield__label" for="email">your mail address</label>
                            <span class="mdl-textfield__error">a valid mail</span>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
<!--
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                            Update
                        </button>
                        -->
                    </form>
                </div>
        </div>
    </main>
@endsection
