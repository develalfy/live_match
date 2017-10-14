@extends('layouts.admin_template')


@section('title', 'Create Match')

@section('description', 'Create new match')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">Create Match</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ route('match.create') }}" type="button"
                                   class="btn btn-sm btn-primary btn-create">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('match.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_team') ? ' has-error' : '' }}">
                                <label for="first_team" class="col-md-4 control-label">First team</label>

                                <div class="col-md-6">
                                    <select id="first_team" class="form-control" name="first_team" required autofocus>
                                        <option value="">--Select team--</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
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
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
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
                                        Add
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