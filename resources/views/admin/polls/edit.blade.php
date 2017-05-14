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

                    {{ Form::submit('Edit the Poll!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
