@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Poll Show</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="{{ URL::to('polls') }}">Poll Alert</a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('polls') }}">View All Polls</a></li>
                            <li><a href="{{ URL::to('polls/create') }}">Create a Poll</a>
                        </ul>
                    </nav>

                    <h1>Showing {{ $poll->name }}</h1>

                    <div class="jumbotron text-center">
                        <h2>{{ $poll->title }}</h2>
                        <p>
                            <strong>Active:</strong> {{ $poll->active }}<br>
                            <strong>Public:</strong> {{ $poll->public }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
