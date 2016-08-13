<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vote;
use App\VoteHistory;

class UserController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

	/**
     * show user's vote history
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        // Get all votes created by user
        $createdVotes = Vote::where('created_by', \Auth::User()->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all votes given by user
        $givenHistories = VoteHistory::where('user_id', \Auth::User()->id)
            ->orderBy('created_at', 'desc')
            ->groupBy('vote_id')
            ->get();

        return view('user.history', compact('createdVotes', 'givenHistories'));
    }

	/**
     * register
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {

        return view('user.login');
    }

	/**
     * show profile
     *
     * @param $request
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        // Get and return current user, otherwise return error
        return view('user.profile', ['user' => \Auth::user()]);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.register');
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
