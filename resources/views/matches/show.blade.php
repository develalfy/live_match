@extends('layouts.admin_template')


@section('title', 'View Match')

@section('description', 'View match details')

@section('content')

    <div class="container">
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

                        <form class="form-horizontal" method="POST" action="{{ route('comment.store', $match->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_team_score') ? ' has-error' : '' }}">
                                <label for="first_team_score"
                                       class="col-md-2 control-label">{{ $match->first_team }}</label>

                                <div class="col-md-2">
                                    <input id="first_team_score" type="text" class="form-control"
                                           name="first_team_score"
                                           value="{{ $match->first_team_score }}" required autofocus>

                                    @if ($errors->has('first_team_score'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_team_score') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="second_team_score"
                                       class="col-md-2 control-label">{{ $match->second_team }}</label>

                                <div class="col-md-2">
                                    <input id="second_team_score" type="text" class="form-control"
                                           name="second_team_score"
                                           value="{{ $match->second_team_score }}" required autofocus>

                                    @if ($errors->has('second_team_score'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('second_team_score') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-2 control-label">Comment Type</label>

                                <div class="col-md-6">
                                    <select id="type" class="form-control" name="type">
                                        <option value="">--Select team--</option>
                                        @foreach($commentTypes as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                                <label for="desc" class="col-md-2 control-label">Description</label>

                                <div class="col-md-8">
                                    <textarea id="desc" class="form-control" name="desc"></textarea>
                                    @if ($errors->has('desc'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>

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