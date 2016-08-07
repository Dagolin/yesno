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

        .portfolio-profile-content {
            max-width: 700px;
        }
    </style>
@endsection

@section('content')
        <div class="mdl-grid portfolio-max-width portfolio-contact">
            <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Profile</h2>
                </div>
                <div class="mdl-grid portfolio-profile-content">
                    <h3 class="mdl-cell mdl-cell--12-col mdl-typography--headline">I am from :</h3>
                    <div class="mdl-cell mdl-cell--8-col mdl-card__supporting-text no-padding ">
                            Facebook
                    </div>

                    <h3 class="mdl-cell mdl-cell--12-col mdl-typography--headline">My name : </h3>
                    <div class="mdl-cell mdl-cell--8-col mdl-card__supporting-text no-padding ">
                            <span>{{ $user->name }}</span>
                    </div>

                    <h3 class="mdl-cell mdl-cell--12-col mdl-typography--headline">My mail address : </h3>
                    <div class="mdl-cell mdl-cell--8-col mdl-card__supporting-text no-padding ">
                            <span>{{ $user->email }}</span>
                    </div>
                    <a href="">Hey wait! It's not me!</a>
                </div>
            </div>
        </div>
@endsection
