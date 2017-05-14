@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Results Show</div>

                    <div class="panel-body">
                        <nav class="navbar navbar-inverse">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ URL::to('results') }}">View All Results</a></li>
                            </ul>
                        </nav>

                        <h1>Poll:: {{ $results[0]->poll_title }}</h1>
                        <h2>Question: {{ $results[0]->question_text }}</h2>

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>Answer Text</td>
                                <td>Times Answered</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $result->possible_answer_text }}</td>
                                    <td>{{ $result->answer_count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
