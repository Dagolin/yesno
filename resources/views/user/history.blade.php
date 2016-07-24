@extends('layouts.app')

@section('header')
    <style>
        .portfolio-max-width {
            max-width: 900px;
            margin: auto;
        }
        .mdl-list__item-primary-content:hover{
            cursor:pointer;
        }
    </style>
@endsection

@section('content')
    <main class="mdl-layout__content">
        <div class="mdl-grid portfolio-max-width portfolio-contact">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">My Ideas</h2>
                </div>
                <div class="mdl-grid">
                    @foreach($createdVotes as $vote)
                        <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp"
                             style="max-height: 400px;">
                            <div class="mdl-card__title mdl-card--expand more" style="cursor:pointer; background: url({!! $vote->image !!}) center / cover;" data-id="{{ $vote->id }}">
                                <h2 class="mdl-card__title-text mdl-color-text--grey">{!! $vote->title !!}</h2>
                            </div>
                            <div id="canvas-{{ $vote->id }}" class="mdl-card__supporting-text mdl-card--border more hidden" data-id="{{ $vote->id }}">
                                <canvas id="myChart-{{ $vote->id }}" width="100" height="100"></canvas>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">My opinions</h2>
                </div>
                <div class="mdl-grid">

                    @foreach($givenHistories as $history)
                        <?php $vote = $history->vote; ?>
                        <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp"
                             style="max-height: 400px;">
                            <div class="mdl-card__title mdl-card--expand more" style="cursor:pointer; background: url({!! $vote->image !!}) center / cover;" data-id="{{ $vote->id }}">
                                <h2 class="mdl-card__title-text mdl-color-text--grey">{!! $vote->title !!}</h2>
                            </div>
                            <div id="canvas-{{ $vote->id }}" class="mdl-card__supporting-text mdl-card--border more hidden" data-id="{{ $vote->id }}">
                                <canvas id="myChart-{{ $vote->id }}" width="100" height="100"></canvas>
                            </div>
                        </div>
                    @endforeach
                    </div>
            </div>
    </main>

@endsection
@section('footer')
    <script>
        var myPieChart;

        $(document).ready(function () {

            Chart.defaults.global.legend.display = false;

            $('.more').on('click', function(){
                var voteId = $(this).data('id');
                var $canvas = $('#canvas-' + voteId);

                if ($canvas.hasClass('hidden')){
                    getVoteSummary(voteId);
                }
                else
                    $canvas.addClass('hidden');
            });

        });

        function getVoteSummary(voteId)
        {
            var url = '/vote/summary/' + voteId;

            jQuery.get({
                url: url
            }).fail(function(xhr) {
                alert(xhr.getResponseHeader('message'));
            }).done(function(data, textStatus, jqXHR ){

                $('#canvas-' + voteId).removeClass('hidden');

                var dataFeed = {
                    labels: [
                        "YES",
                        "NO",
                        "MAYBE"
                    ],
                    datasets: [
                        {
                            data: [data.yes, data.no, data.maybe],
                            backgroundColor: [
                                "rgb(233, 30, 99)",
                                "rgb(63, 81, 181)",
                                "rgb(0, 188, 212)"
                            ],
                            hoverBackgroundColor: [
                                "rgb(233, 30, 99)",
                                "rgb(63, 81, 181)",
                                "rgb(0, 188, 212)"
                            ]
                        }]
                };

                var ctx = $('#myChart-' + voteId);

                myPieChart = new Chart(ctx,{
                    type: 'pie',
                    data: dataFeed,
                    options: {
                        scales: {
                            position: 'right'
                        }
                    },
                    animation:{
                        animateScale:true
                    }
                });
            });
        }


    </script>
    @endsection
