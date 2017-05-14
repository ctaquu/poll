<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

class ResultController extends Controller
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
            ->select(['polls.*', DB::raw('COUNT(answers.id) AS answer_count')])
            ->groupBy('polls.id')
            ->orderBy('answer_count', 'DESC')
            ->get();

        return view('results.index')
            ->with('polls', $polls);
    }

    /**
     * Display the specified resource.
     *
     * @param $poll_id
     * @return \Illuminate\Http\Response
     */
    public function show($poll_id)
    {
        $results = DB::select(
            "  SELECT
                  polls.id              AS poll_id,
                  polls.title           AS poll_title,
                  questions.id          AS question_id,
                  questions.text        AS question_text,
                  possible_answers.id   AS possible_answer_id,
                  possible_answers.text AS possible_answer_text,
                  COUNT(answers.id)     AS answer_count
                FROM
                  polls
                  RIGHT JOIN
                  questions ON questions.poll_id = polls.id
                  RIGHT JOIN
                  possible_answers ON possible_answers.question_id = questions.id
                  LEFT JOIN
                  answers ON answers.possible_answer_id = possible_answers.id
                WHERE
                  polls.id = :poll_id
                  AND polls.active = 1
                  AND polls.public = 1
                GROUP BY
                  polls.id
                , polls.title
                , questions.id
                , questions.text
                , possible_answers.id
                , possible_answers.text
                ORDER BY
                  answer_count DESC
                ;",
            [
                'poll_id' => $poll_id,
            ]
        );

        if (count($results) < 1) {
            Session::flash('message', 'You shall not pass!!!');
            return redirect('results');
        }

        return view('results.show')
            ->with([
                'results' => $results,
            ]);
    }
}
