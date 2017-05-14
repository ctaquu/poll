<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;

class PollController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role.user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = DB::table('polls')
            ->leftJoin('answers', 'polls.id', '=', 'answers.poll_id')
            ->where('polls.active', '=', 1)
            ->where('polls.public', '=', 1)
            ->where(function ($query) {
                $query->whereNull('answers.user_id')
                    ->orWhere('answers.user_id', '!=', Auth::user()->id);
            })
            ->select('polls.*')
            ->get();

        // load the view and pass the polls
        return view('polls.index')
            ->with('polls', $polls);
    }

    /**
     * Store an answered poll
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'possible_answer_id' => 'required',
            'poll_id' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('polls')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $answer = new Answer();
            $answer->user_id = Auth::user()->id;
            $answer->poll_id = Input::get('poll_id');
            $answer->possible_answer_id = Input::get('possible_answer_id');
            $answer->save();

            // redirect
            Session::flash('message', 'Successfully Answered the poll!');
            return redirect('polls');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poll $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        // show the view and pass the poll to it
        return view('polls.show')
            ->with('poll', $poll);
    }
}
