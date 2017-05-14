@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Index</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('admin/users') }}">View All Users</a></li>
                            <li><a href="{{ URL::to('admin/users/create') }}">Create a !!ADMIN!! User</a>
                        </ul>
                    </nav>

                    <h1>All the Users</h1>

                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Activated</td>
                            <td>Role</td>
                            <td>Ban</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->activated }}</td>
                                <td>{{ $value->role }}</td>
                                <td>{{ $value->ban }}</td>

                                <!-- we will also add show, edit, and delete buttons -->
                                <td>

                                    <!-- delete the user (uses the destroy method DESTROY /users/{id} -->
                                    {{ Form::open(array('url' => 'admin/users/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete this User', array('class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}

                                    <!-- show the user (uses the show method found at GET /admin/users/{id} -->
                                    <a class="btn btn-small btn-success" href="{{ URL::to('admin/users/' . $value->id) }}">Show this User</a>

                                    <!-- edit this user (uses the edit method found at GET /admin/users/{id}/edit -->
                                    <a class="btn btn-small btn-info" href="{{ URL::to('admin/users/' . $value->id . '/edit') }}">Edit this User</a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
