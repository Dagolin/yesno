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
        $select = ['id', 'title', 'due_date', 'image', 'created_by', DB::raw('false as voted')];

        /*
         * 1. Pick a vote event with order due_date desc
         * 2. Pick 6 last votes
         * 3. prevent redundant pulling if login
         */
        $userId = empty(\Auth::User()) ? null : \Auth::User()->id;

        $popVotes = Vote::whereDate('due_date', '>=', Carbon::today()->toDateString())
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get($select);

        $popVoteIds = $popVotes->pluck('id')->all();

        $votes = Vote::whereDate('due_date', '>=', Carbon::today()->toDateString())
            ->where('status', 1)
            ->whereNotIn('id', $popVoteIds)
            ->orderBy('created_at')
            ->take(10)
            ->get($select);

        // prevent redundant pulling
        if (!empty($userId))
        {
            $voteHistories = VoteHistory::where('user_id', $userId)->lists('vote_id')->toArray();

            $voteHistories = array_unique($voteHistories);

            $voteIds = $votes->pluck('id')->all();

            foreach(array_intersect($popVoteIds, $voteHistories) as $key => $value) {
                $popVotes[$key]->voted = 1;
            }

            foreach(array_intersect($voteIds, $voteHistories) as $key => $value) {
                $votes[$key]->voted = 1;
            }

            foreach ($popVotes as $vote)
            {
                $vote->voted = $vote->created_by == $userId ? 1 : $vote->voted;
            }

            foreach ($votes as $vote)
            {
                $vote->voted = $vote->created_by == $userId ? 1 : $vote->voted;
            }
        }

        return ['popVotes' => $popVotes->toArray(), 'votes' => $votes->toArray()];
    }
}
