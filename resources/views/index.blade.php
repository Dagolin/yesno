@extends('layouts.app')

@section('dialogs')
    @foreach(array_merge($popVotes, $votes) as $vote)
    <dialog class="mdl-dialog" id="dialog-{!! $vote['id'] !!}" data-id="{!! $vote['id'] !!}">
        <h4 class="mdl-dialog__title">The question is ...</h4>
        <div class="mdl-dialog__content">
            <p>
                {{ $vote['title'] }}
            </p>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col mdl-typography--text-center">
                <!--<button type="button" class="mdl-button mdl-js-button mdl-button--icon"><i class="material-icons">thumb_up</i></button>-->
                <button type="button" class="mdl-button mdl-js-button mdl-button-yes">YES</button>
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-typography--text-center">
                <button type="button" class="mdl-button mdl-js-button mdl-button-no">NO</button>
            </div>
            <div class="mdl-cell mdl-cell--4-col mdl-typography--text-center">
                <button type="button" class="mdl-button mdl-js-button mdl-button-maybe">MAYBE</button>
            </div>
        </div>

        <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
            <button type="button" class="mdl-button mdl-js-button close">Close</button>
        </div>
    </dialog>
    @endforeach
@endsection

@section('content')
        <a name="top"></a>
        <a href="{{ url('vote/create') }}">
        <button id="mdl-add-button" class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-color--accent">
                <i class="material-icons mdl-color-text--white" role="presentation">add</i>
                <span class="visuallyhidden">add</span>
        </button>
        </a>

        <div class="android-banner-section mdl-typography--text-center">
            <div class="mdl-grid portfolio-max-width">
                @if (count($popVotes) > 0 )
                <div id="show-dialog-{!! $popVotes[0]['id'] !!}" class="mdl-cell mdl-cell--12-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp mdl-card-450-height"
                style="background: url({{ $popVotes[0]['image'] }}) top / cover;">
                    <div class="mdl-card__title mdl-card--expand"></div>
                    <div class="mdl-card__actions">
                        <h4 class="mdl-subtitle">{!! $popVotes[0]['title'] !!}</h4>
                    </div>
                    <div id="mark-{!! $popVotes[0]['id'] !!}" class="voteMark big-stamp {{ ( true === (bool) $popVotes[0]['voted'] ) ? 'show' : 'hidden' }}"></div>
                </div>
                @endif

                @foreach($votes as $vote)
                <div id="show-dialog-{!! $vote['id'] !!}" class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp mdl-card-400-height"
                style="background: url({!! $vote['image'] !!}) left / cover;">
                    <div class="mdl-card__title mdl-card--expand"></div>
                    <div class="mdl-card__actions">
                        <h5 class="mdl-subtitle">{!! $vote['title'] !!}</h5>
                    </div>
                    <div id="mark-{!! $vote['id'] !!}" class="voteMark small-stamp {{ ( true === (bool) $vote['voted'] ) ? 'show' : 'hidden' }}"></div>
                </div>
                @endforeach
            </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            @foreach(array_merge($popVotes, $votes) as $vote)
            if ($('#show-dialog-{!! $vote['id'] !!}').length > 0
                && $('#dialog-{!! $vote['id'] !!}').length > 0
                && ( false === Boolean({!! $vote['voted'] !!})))
                registerDialog(document.querySelector('#dialog-{!! $vote['id'] !!}'), document.querySelector('#show-dialog-{!! $vote['id'] !!}'));
            @endforeach
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {

        });
    </script>
    <script>
        function voteSubmit(event){
            var id = $(event.data.dialog).data('id');
            var url = 'vote/giveVote';

            jQuery.post({
                url: url,
                data: {vote_id: id, answer: event.data.answer, fingerprint: $('#finger').html()}
            }).fail(function(xhr) {
                alert(xhr.getResponseHeader('message'));
            }).done(function(data, textStatus, jqXHR ){
                unregisterDialog(data.voteId);
            });

            event.data.dialog.close();
        }

        function registerDialog(dialog, showDialogButton){
            if (! dialog.showModal) {
                dialogPolyfill.registerDialog(dialog);
            }

            $(showDialogButton).on('click', function(){
                dialog.showModal();
            });

            $(dialog).find('.close').on('click', function(){
                dialog.close();
            });

            // ajax onclick event
            $(dialog).find('.mdl-button-yes').on('click', {dialog: dialog, answer: 'yes'}, voteSubmit);
            $(dialog).find('.mdl-button-no').on('click', {dialog: dialog, answer: 'no'}, voteSubmit);
            $(dialog).find('.mdl-button-maybe').on('click', {dialog: dialog, answer: 'maybe'}, voteSubmit);
        }

        function unregisterDialog(id){
            $('#show-dialog-' + id).off('click');
            $('#mark-' + id).removeClass('hidden');
        }
    </script>
@endsection
