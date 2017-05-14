@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Poll Edit</div>

                    <div class="panel-body">
                        <nav class="navbar navbar-inverse">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ URL::to('admin/polls') }}">View All Polls</a></li>
                                <li><a href="{{ URL::to('admin/polls/create') }}">Create a Poll</a>
                            </ul>
                        </nav>

                        <h1>Edit {{ $poll->name }}</h1>

                        <!-- if there are creation errors, they will show here -->
                        {{ HTML::ul($errors->all()) }}

                        {{ Form::model($poll, ['url' => "admin/polls/$poll->id", 'method' => 'PUT']) }}

                        <div class="form-group">
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            @php
                                $possibleAnswersString = '';
                                foreach ($poll->question->possibleAnswers as $possibleAnswer) {
                                    $possibleAnswersString .= ($possibleAnswer->text . ',');
                                }
                                $possibleAnswersString = substr($possibleAnswersString, 0, strlen($possibleAnswersString)-1);
                            @endphp
                            {{ Form::label('question', 'Question') }}
                            {{ Form::text('question', $poll->question->text, array('class' => 'form-control')) }}
                            {{ Form::label('possible_answers', 'Possible Answers for Question (separated by commas aka: , )') }}
                            {{ Form::text('possible_answers', $possibleAnswersString, array('class' => 'form-control')) }}
                            {{ Form::label('active', 'Active') }}
                            {{ Form::checkbox('active') }}
                            {{ Form::label('public', 'Public') }}
                            {{ Form::checkbox('public') }}
                        </div>

                        {{ Form::submit('Edit the Poll!', array('class' => 'btn btn-primary')) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
