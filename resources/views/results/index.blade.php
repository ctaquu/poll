@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Results Index</div>

                <div class="panel-body">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to('results') }}">View All Results</a></li>
                        </ul>
                    </nav>

                    <h1>All the Results</h1>

                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>Name</td>
                            <td>Answers Count</td>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($polls as $key => $value)
                            <tr>
                                <td><a href="{{ URL::to('results/' . $value->id) }}">{{ $value->title }}</a></td>
                                <td>{{ $value->answer_count }}</td>
                            </tr>
                        @empty
                            <tr><td>no poll results...</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
