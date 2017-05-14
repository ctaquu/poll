@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Show</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('admin/users') }}">View All Users</a></li>
                            <li><a href="{{ URL::to('admin/users/create') }}">Create a !!ADMIN!! User</a>
                        </ul>
                    </nav>

                    <h1>Showing {{ $user->name }}</h1>

                    <div class="jumbotron text-center">
                        <h2>{{ $user->name }}</h2>
                        <p>
                            <strong>Name:</strong> {{ $user->name }}<br/>
                            <strong>Email:</strong> {{ $user->email }}<br/>
                            <strong>Activated:</strong> {{ $user->activated }}<br/>
                            <strong>Role:</strong> {{ $user->role}}<br/>
                            <strong>Ban:</strong> {{ $user->ban}}<br/>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
