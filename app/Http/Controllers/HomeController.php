<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\VoteHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Vote;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', $this->getVoteList());
    }

    /**
     * getVoteList
     *
     * @return  array
     */
    protected function getVoteList(){
        $select = ['id', 'title', 'due_date', 'image', DB::raw('false as voted')];

        /*
         * 1. Pick a vote event with order due_date desc
         * 2. Pick 6 last votes
         * 3. prevent redundant pulling if login
         */
        $userId = empty(\Auth::User()) ? : \Auth::User()->id;

        $popVotes = Vote::whereDate('due_date', '>=', Carbon::today()->toDateString())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get($select);

        $popVoteIds = $popVotes->pluck('id')->all();

        $votes = Vote::whereDate('due_date', '>=', Carbon::today()->toDateString())
            ->whereNotIn('id', $popVoteIds)
            ->orderBy('created_at')
            ->take(10)
            ->get($select);

        // prevent redundant pulling
        if (!empty($userId)){

            $voteHistories = VoteHistory::where('user_id', $userId)->lists('vote_id')->toArray();

            $voteHistories = array_unique($voteHistories);

            $voteIds = $votes->pluck('id')->all();

            foreach(array_intersect($popVoteIds, $voteHistories) as $key => $value) {
                $popVotes[$key]->voted = 1;
            }

            foreach(array_intersect($voteIds, $voteHistories) as $key => $value) {
                $votes[$key]->voted = 1;
            }
        }

        return ['popVotes' => $popVotes->toArray(), 'votes' => $votes->toArray()];
    }
}
