<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds
        $polls = Poll::all();

        // load the view and pass the nerds
        return view('polls.index')
            ->with('polls', $polls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polls.create');
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
            return redirect('nerds/create')
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
            return redirect('polls');
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
        // show the view and pass the nerd to it
        return view('polls.show')
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
        return view('polls.edit')
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
            return redirect('nerds/' . $poll->getId() . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $poll->title = Input::get('title');
            $poll->save();

            // redirect
            Session::flash('message', 'Successfully updated polls!');
            return redirect('polls');
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

        return redirect('polls');
    }
}
