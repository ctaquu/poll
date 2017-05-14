<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Poll;
use Illuminate\Http\Request;
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
        $this->middleware('role.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the polls
        $polls = Poll::all();

        // load the view and pass the polls
        return view('admin.polls.index')
            ->with('polls', $polls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.polls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/polls/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $poll = new Poll();
            $poll->title = Input::get('title');
            $poll->active = 1;
            $poll->public = 1;
            $poll->save();

            // redirect
            Session::flash('message', 'Successfully created poll!');
            return redirect('admin/polls');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        // show the view and pass the poll to it
        return view('admin.polls.show')
            ->with('poll', $poll);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        return view('admin.polls.edit')
            ->with('poll', $poll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/polls/' . $poll->getId() . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $poll->title = Input::get('title');
            $poll->save();

            // redirect
            Session::flash('message', 'Successfully updated polls!');
            return redirect('admin/polls');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        $poll->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the poll!');

        return redirect('admin/polls');
    }
}
