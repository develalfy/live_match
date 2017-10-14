@extends('layouts.admin_template')


@section('title', 'Edit Match')

@section('description', 'Edit match')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">Matches</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{ route('match.update', $match->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_team') ? ' has-error' : '' }}">
                                <label for="first_team" class="col-md-4 control-label">First team</label>

                                <div class="col-md-6">
                                    <select id="first_team" class="form-control" name="first_team" required autofocus>
                                        <option value="">--Select team--</option>
                                        @foreach($teams as $team)
                                            <option value="{{ ($team->id) }}" {{ ($team->id == $match->first_team_id) ? 'selected' : '' }}>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('first_team'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_team') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('second_team') ? ' has-error' : '' }}">
                                <label for="second_team" class="col-md-4 control-label">Second team</label>

                                <div class="col-md-6">
                                    <select id="second_team" class="form-control" name="second_team" required autofocus>
                                        <option value="">--Select team--</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ ($team->id == $match->second_team_id) ? 'selected' : '' }}>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('second_team'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('second_team') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection