<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Vote;
use App\VoteHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VoteController extends Controller
{

    protected $request;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('vote.createVote');
    }


    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Store a newly created vote history record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function vote()
    {
        $response = [];

        $userId = empty(\Auth::User()) ? : \Auth::User()->id;

        $request = $this->request;

        if ($request->has('fingerprint') && $request->has('vote_id')) {

            $voteId = $request->get('vote_id');
            $fingerprint = $request->get('fingerprint');

            // if vote not exists or out of date
            if (!(Vote::where('id', $voteId)
                    ->whereDate('due_date', '>=', Carbon::today()->toDateString())
                    ->count() > 0))
            {

                return (new Response())->header('message', 'Vote not exists or out of date')->setStatusCode(406);
            }

            // if already voted
            if (empty($userId))
                $isVoted = (VoteHistory::where('fingerprint', $fingerprint)->where('id', $voteId)->count() > 0);
            else
                $isVoted = (VoteHistory::where('user_id', $userId)->where('id', $voteId)->count() > 0);

            if ($isVoted){
                return (new Response())->header('message', 'Opps, no spam votes sorry')->setStatusCode(406);
            }

            $newVoteHistory = $request->all();

            if (!empty($userId))
                $newVoteHistory['user_id'] = $userId;

            VoteHistory::create($newVoteHistory);

            // increase counter
            $answer = $request->get('answer');

            Vote::query()
                ->where('id', $voteId)
                ->update([
                    $answer => DB::raw($answer . ' + 1'),
                    'due_date' => DB::raw('DATE_ADD(`due_date`, INTERVAL 1 DAY)')
                ]);

            // return success message
            $response['voteId'] = $voteId;
        }

        // no fingerprint, vote_id, illegal call
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $request = $this->request;

        $newVote = \Request::all();

        if ($request->hasFile('image')) {

            $imagePath = '/public/images/votes/';
            $publicPath = '/images/votes/';

            $imageName =  substr(Hash::make(time()), 0, 10). '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(base_path() .$imagePath, $imageName);

            $newVote['image'] = $publicPath . $imageName;
        }

        $newVote['due_date'] = Carbon::createFromFormat('Y-m-d', $newVote['publish_at'])->addDays(7);
        $newVote['created_by'] = $newVote['updated_by'] = \Auth::User()->id;

        Vote::create($newVote);

        return redirect('vote/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Get vote summary date by id
     *
     * @return \Illuminate\Http\Response
     */
    public function summary($id)
    {
       return Vote::find($id);
    }

    /**
     * Get vote history with fingerprint
     *
     * @return \Illuminate\Http\Response
     */
    public function history($fingerprint)
    {
        $history = [];

        $votes = VoteHistory::select('vote_id')
            ->where('fingerprint', $fingerprint)
            ->get();

        foreach ($votes as $vote)
        {
            $history[] = $vote->vote_id;
        }

        return $history;
    }

    /**
     * Get next vote info by id
     *
     * @return \Illuminate\Http\Response
     */
    public function next($id, $date)
    {
        $next = false;

        // Get all votes with dueDate after the date
        $votes = \App\Vote::where('created_at', '<=', $date)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        // Loop to fetch next with id
        foreach ($votes as $vote)
        {
            if ($next)
            {
                return $vote->toArray();
            }

            if($vote->id == $id)
            {
                $next = true;
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
