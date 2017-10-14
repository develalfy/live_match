@extends('layouts.app')


@section('title', 'Home')

@section('description', 'Home page')

@section('content')
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
                    <table class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th><em class="fa fa-cog"></em></th>
                            <th>First Team</th>
                            <th>Second Team</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($matches as $match)
                            <tr>
                                <td align="center">
                                    <a href="{{ route('user.match', $match->id) }}" class="btn btn-success"><em
                                                class="fa fa-eye"></em></a>
                                </td>
                                <td>{{ $match->first_team }}</td>
                                <td>{{ $match->second_team }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-xs-8">
                            {{ $matches->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection