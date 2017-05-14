@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Create</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('admin/users') }}">View All Users</a></li>
                            <li><a href="{{ URL::to('admin/users/create') }}">Create a !!ADMIN!! User</a>
                        </ul>
                    </nav>

                    <h1>Create a User</h1>

                    {{--<!-- if there are creation errors, they will show here -->--}}
                    {{ HTML::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'admin/users')) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::password('password', Input::old('password'), array('class' => 'form-control')) }}
                    </div>

                    {{ Form::submit('Create the User!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
