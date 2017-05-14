<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\PossibleAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'question' => 'required',
            'possible_answers' => 'required', //TODO: create custom validation to do all checks
        ];
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/polls/create')
                ->withInput()
                ->withErrors($validator);
        }

        $possibleAnswers = explode(',', Input::get('possible_answers'));

        if (count($possibleAnswers) < 2) {
            return redirect('admin/polls/create')
                ->withInput()
                ->withErrors('Need at least two possible answers!!!');
        }

        // store poll
        $poll = new Poll();
        $poll->title = Input::get('title');$poll->active = !empty(Input::get('active')) ? Input::get('active') : 0;
        $poll->public = !empty(Input::get('public')) ? Input::get('public') : 0;
        $poll->save();

        // store question
        $question = new Question();
        $question->text = Input::get('question');
        $poll->question()->save($question);

        // store possible answers
        foreach ($possibleAnswers as $possibleAnswerText) {
            $possibleAnswer = new PossibleAnswer();
            $possibleAnswer->text = $possibleAnswerText;
            $question->possibleAnswers()->save($possibleAnswer);
        }

        // redirect
        Session::flash('message', 'Successfully created poll!');
        return redirect('admin/polls');

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
        return view('admin.polls.show')
            ->with('poll', $poll);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poll $poll
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
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Poll $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $rules = array(
            'title' => 'required',
            'question' => 'required',
            'possible_answers' => 'required', //TODO: create custom validation to do all checks
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect("admin/polls/{$poll->id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $possibleAnswers = explode(',', Input::get('possible_answers'));

        if (count($possibleAnswers) < 2) {
            return redirect("admin/polls/{$poll->id}/edit")
                ->withInput()
                ->withErrors('Need at least two possible answers!!!');
        }

        $answers = DB::table('answers')
            ->where('poll_id', '=', $poll->id)
            ->get();

        if (count($answers) === 0) {

            // store poll
            $poll->title = Input::get('title');
            $poll->save();

            // store question
            $poll->question->text = Input::get('question');
            $poll->question->save();

            // delete old possible answers
            foreach ($poll->question->possibleAnswers as $possibleAnswer) {
                $possibleAnswer->delete();
            }

            // store possible answers
            foreach ($possibleAnswers as $possibleAnswerText) {
                $possibleAnswer = new PossibleAnswer();
                $possibleAnswer->text = $possibleAnswerText;
                $poll->question->possibleAnswers()->save($possibleAnswer);
            }

            Session::flash('message', 'Successfully updated polls!');

        } else {
            Session::flash('message', 'Poll has been answered by one or more users already, updated only active and public statuses!');
        }

        $poll->active = !empty(Input::get('active')) ? Input::get('active') : 0;
        $poll->public = !empty(Input::get('public')) ? Input::get('public') : 0;
        $poll->save();

        return redirect('admin/polls');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poll $poll
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
