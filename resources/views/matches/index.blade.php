@extends('layouts.admin_template')


@section('title', 'List Matches')

@section('description', 'List all matches')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1">

                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">Matches</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ route('match.create') }}" type="button"
                                   class="btn btn-sm btn-primary btn-create">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa fa-cog"></em></th>
                                <th class="hidden-xs">ID</th>
                                <th>First Team</th>
                                <th>Second Team</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($matches as $match)
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('match.edit', $match->id) }}" class="btn btn-default"><em
                                                    class="fa fa-pencil"></em></a>

                                        <a href="{{ route('match.destroy', $match->id) }}"
                                           class="btn btn-danger"
                                           onclick="event.preventDefault();
                                                   document.getElementById('delete-form-{{ $match->id }}').submit();">
                                            <em class="fa fa-trash"></em>
                                        </a>

                                        {{--TO send a delete request--}}
                                        <form id="delete-form-{{ $match->id }}"
                                              action="{{ route('match.destroy', $match->id) }}"
                                              method="POST">
                                            <input name="_method" type="hidden" value="DELETE">
                                            {{ csrf_field() }}
                                        </form>

                                    </td>
                                    <td class="hidden-xs">{{ $match->id }}</td>
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
    </div>

@endsection