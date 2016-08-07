@extends('layouts.app')
@section('header')
    <style>
        blockquote {
            padding: 6px 16px;
            border: none;
            quotes: "\201C" "\201D";
            display: inline-block;
            font-size: 20px !important;
        }

        blockquote p:before {
            content: open-quote;
            font-weight: bold;
        }

        blockquote p:after {
            content: close-quote;
            font-weight: bold;
        }

        .quote footer {
            display: block;
            font-size: 80%;
            line-height: 1.42857143;
            color: #777;
        }

        .quote footer:before {
            /*
            content: '\2014 \00A0';
            */
        }

        .about-us-section{
            background-color: #f3f3f3;
        }

        .mdl-about-us {
            margin: 5% 0 0 25%;
            padding-bottom: 2%;
        }

    </style>
    @endsection
@section('content')
    <div class="about-us-section">
        <div class="logo-font android-sub-slogan quote mdl-typography--text-center">
            <blockquote>
                That all our knowledge begins with experience there can be no doubt.
            </blockquote>
            <footer>Immanuel Kant, Critique of Pure Reason</footer>
        </div>
        <div class="mdl-about-us">
            <p>It is the democracy that is the fundamental of our society and cannot be taken away, we agreed.</p>
            <p>Majority rules with minority rights, we said.</p>
            <p>Listen to your own heart, which part you think you are in the society?</p>
            <p>We are selfish by nature, and no doubt the greatest productive force is human selfishness.</p>
            <p>The question is, how we balance the biggest benefits of a person and the society?</p>
            <p>Or maybe, just maybe, we pretend we are the majority of the society, we convince ourselves WE ARE the society.</p>
            <p>FOR REAL?</p>
            <p><a href="/"><h3>Let's find out.  > </h3></a></p>
        </div>
    </div>

@stop
