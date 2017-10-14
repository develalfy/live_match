@extends('layouts.app')


@section('title', 'Home')

@section('description', 'Home page')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th class="text-center">{{ $match->first_team }}</th>
                            <th class="text-center">{{ $match->second_team }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td align="center">
                                {{ $match->first_team_score }}
                            </td>
                            <td align="center">
                                {{ $match->second_team_score }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    @foreach($comments as $comment)
                        <div class="highlight highlight-source-shell">
                            <code>{{ $comment->type }}</code>
                            <pre>{{ $comment->desc }}</pre>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection