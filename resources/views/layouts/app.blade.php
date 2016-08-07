<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Yes no Maybe</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ URL::asset('css/material.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    @yield('header')
    <style>
        #mdl-add-button {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 40px;
            margin-bottom: 40px;
            z-index: 900;
        }
    </style>
</head>
<body id="app-layout">
@yield('dialogs')

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    @include('layouts.navbar')

    <main class="mdl-layout__content">
        @yield('content')
        @include('layouts.contentfooter')
    </main>
</div>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/material.min.js') }}"></script>
    <script src="{{ URL::asset('js/fingerprintjs2/fingerprint2.js') }}"></script>
    <script src="{{ URL::asset('js/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('js/yesno.js') }}"></script>
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-material-datetimepicker.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
        $(document).ready(function () {

            new Fingerprint2().get(function(result, components){
                // this will use all available fingerprinting sources
                $('#finger').html(result);

                @if ( empty(\Auth::User()) )
                voteRefresh(result);
                @endif
            });
        });

        function voteRefresh(fingerprint){
            var url = 'vote/history/' + fingerprint;

            jQuery.getJSON({
                url: url
            }).fail(function() {
                alert( "error" );
            }).done(function(voteIds){
                for (var i = 0; i < voteIds.length; i++){
                    unregisterDialog(voteIds[i]);
                }
            });
        }
    </script>
    @yield('footer')
<span style="display: none" id="finger"></span>
</body>
</html>
