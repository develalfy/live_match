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
                            <td align="center" id="first_team_score">
                                {{ $match->first_team_score }}
                            </td>
                            <td align="center" id="second_team_score">
                                {{ $match->second_team_score }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div id="highlights">
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
    </div>
@endsection

@section('scripts')

    {{-- User live session with Moderators --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

    <script>
        var socket = io.connect('http://localhost:3000');

        socket.on('test-channel:App\\Events\\CommentInserted', function (data) {
            $('#first_team_score').text(data.liveData.first_team_score);
            $('#second_team_score').text(data.liveData.second_team_score);
            $('#highlights').append('<div class="highlight highlight-source-shell">\n' +
                '                                <code>'+data.liveData.type+'</code>\n' +
                '                                <pre>'+data.liveData.desc+'</pre>\n' +
                '                            </div>');
        });
    </script>

@endsection