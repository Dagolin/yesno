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
                <h2 class="mdl-card__title-text">Start a Y/N question</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <p>
                    {{ $tip }}

                </p>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('vote') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                            <!-- title -->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name="title" id="title" required>
                        <label class="mdl-textfield__label" for="title">Topic...must be a Y/N question</label>
                        <span class="mdl-textfield__error">Required</span>
                    </div>
                    <!-- image -->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <p>
                            Recommend size : 1350 x 450 (1 : 3)<br/>
                            Your image must related to your topic
                        </p>

                        <input class="mdl-textfield__input" placeholder="Cover picture" type="text" id="imageTitle" required/>
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i><input type="file" id="image" name="image">
                        </div>
                    </div>
                    <!-- publish date -->
                    <p>
                        When do you want the topic available for voting.
                    </p>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name="publish_at" id="publish_at" required>
                        <label class="mdl-textfield__label" for="publish_at">Publish date...</label>
                        <span class="mdl-textfield__error">Required</span>
                    </div>
                    <p>
                        *Your question will expire in 14 days after last given vote from anyone, you can find it in <a href="{{ url('user/history') }}">"My votes"</a>.
                    </p>
                    <!-- submit -->
                    <p>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                            Submit
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        document.getElementById("image").onchange = function () {
            document.getElementById("imageTitle").value = this.files[0].name;
        };

        $(document).ready(function(){
            $( function() {
                $( "#publish_at" ).bootstrapMaterialDatePicker({
                    time : false,
                    format : 'YYYY-MM-DD'
                });
            } );
        });
    </script>
@endsection
