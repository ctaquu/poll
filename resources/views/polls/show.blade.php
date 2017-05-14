@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Poll Show</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('polls') }}">One Poll</a></li>
                        </ul>
                    </nav>

                    <h1>Showing {{ $poll->name }}</h1>

                    {{ HTML::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'polls')) }}

                    @if (Session::has('message'))
                        <div class="alert alert-info red-text">{{ Session::get('message') }}</div>
                    @endif

                    <p>
                        <strong>Question:</strong> {{ $poll->question->text }}<br>
                        <strong>PossibleAnswers: </strong>
                        @foreach ($poll->question->possibleAnswers as $possibleAnswer)
                            {{ $possibleAnswer->text }}&nbsp;{{ Form::radio('possible_answer_id', $possibleAnswer->id ) }}&nbsp;&nbsp;
                        @endforeach
                        <br/>
                    </p>

                    {{ Form::hidden('poll_id', $poll->id) }}

                    {{ Form::submit('Answer the Poll!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
