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
                        </ul>
                    </nav>

                    <h1>All the Polls</h1>

                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <tbody>
                        @forelse($polls as $key => $value)
                            <tr>
                                <td><a href="{{ URL::to('polls/' . $value->id) }}">{{ $value->title }}</a></td>
                            </tr>
                        @empty
                            <tr><td>no new polls...</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
