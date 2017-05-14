@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Poll Index</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('admin/polls') }}">View All Polls</a></li>
                            <li><a href="{{ URL::to('admin/polls/create') }}">Create a Poll</a>
                        </ul>
                    </nav>

                    <h1>All the Polls</h1>

                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Title</td>
                            <td>Active</td>
                            <td>Public</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($polls as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->active }}</td>
                                <td>{{ $value->public }}</td>

                                <!-- we will also add show, edit, and delete buttons -->
                                <td>

                                    <!-- delete the poll (uses the destroy method DESTROY /polls/{id} -->
                                    {{ Form::open(array('url' => 'admin/polls/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete this Poll', array('class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}

                                    <!-- show the poll (uses the show method found at GET /polls/{id} -->
                                    <a class="btn btn-small btn-success" href="{{ URL::to('admin/polls/' . $value->id) }}">Show this Poll</a>

                                    <!-- edit this poll (uses the edit method found at GET /polls/{id}/edit -->
                                    <a class="btn btn-small btn-info" href="{{ URL::to('admin/polls/' . $value->id . '/edit') }}">Edit this Poll</a>

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
