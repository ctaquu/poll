@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Poll Create</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('admin/polls') }}">View All Polls</a></li>
                            <li><a href="{{ URL::to('admin/polls/create') }}">Create a Poll</a>
                        </ul>
                    </nav>

                    <h1>Create a Poll</h1>

                    {{--<!-- if there are creation errors, they will show here -->--}}
                    {{ HTML::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'admin/polls')) }}

                    <div class="form-group">
                        {{ Form::label('title', 'Title') }}
                        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('question', 'Question') }}
                        {{ Form::text('question', Input::old('question'), array('class' => 'form-control')) }}
                        {{ Form::label('possible_answers', 'Possible Answers for Question (separated by commas aka: , )') }}
                        {{ Form::text('possible_answers', Input::old('possible_answers'), array('class' => 'form-control')) }}
                        {{ Form::label('active', 'Active') }}
                        {{ Form::checkbox('active') }}
                        {{ Form::label('public', 'Public') }}
                        {{ Form::checkbox('public') }}
                    </div>

                    {{ Form::submit('Create the Poll!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
